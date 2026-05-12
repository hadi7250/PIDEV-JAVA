<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EmailVerificationService
{
    private MailerInterface $mailer;
    private EntityManagerInterface $entityManager;
    private UrlGeneratorInterface $urlGenerator;
    private string $fromEmail;

    public function __construct(
        MailerInterface $mailer,
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $urlGenerator,
        string $fromEmail = 'noreply@pidev-education.com'
    ) {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Generate a 6-digit verification code
     */
    public function generateVerificationCode(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Generate a secure reset token
     */
    public function generateResetToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Send verification code to user email
     */
    public function sendVerificationCode(User $user, string $code): bool
    {
        try {
            // Store verification code and expiry in user entity
            $user->setResetToken($code);
            $expiryTime = new \DateTime('+15 minutes');
            
            // Use reflection to set protected resetTokenExpiry
            $reflection = new \ReflectionClass($user);
            $property = $reflection->getProperty('resetTokenExpiry');
            $property->setAccessible(true);
            $property->setValue($user, $expiryTime);
            
            $this->entityManager->flush();

            // Send email
            $userName = trim($user->getFirstName() . ' ' . $user->getLastName());
            $email = (new Email())
                ->from($this->fromEmail)
                ->to($user->getEmail())
                ->subject('PIDEV Education - Password Reset Verification Code')
                ->html($this->generateVerificationEmailTemplate($userName ?: 'User', $code));

            $this->mailer->send($email);
            
            return true;
        } catch (\Exception $e) {
            // Log error here if needed
            return false;
        }
    }

    /**
     * Verify the code and generate reset token
     */
    public function verifyCodeAndGenerateToken(User $user, string $code): ?string
    {
        // Check if code matches
        if ($user->getResetToken() !== $code) {
            return null;
        }

        // Check if code has expired
        $expiryTime = $user->getResetTokenExpiry();
        if (!$expiryTime || $expiryTime < new \DateTime()) {
            return null;
        }

        // Generate new reset token
        $resetToken = $this->generateResetToken();
        
        // Update user with reset token and new expiry
        $user->setResetToken($resetToken);
        $newExpiryTime = new \DateTime('+15 minutes');
        
        // Use reflection to set protected resetTokenExpiry
        $reflection = new \ReflectionClass($user);
        $property = $reflection->getProperty('resetTokenExpiry');
        $property->setAccessible(true);
        $property->setValue($user, $newExpiryTime);
        
        $this->entityManager->flush();

        return $resetToken;
    }

    /**
     * Generate email template for verification code
     */
    private function generateVerificationEmailTemplate(string $userName, string $code): string
    {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <title>Password Reset Verification</title>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
                .code-box { background: white; border: 2px solid #667eea; border-radius: 8px; padding: 20px; text-align: center; margin: 20px 0; }
                .code { font-size: 32px; font-weight: bold; color: #667eea; letter-spacing: 5px; margin: 10px 0; }
                .footer { text-align: center; color: #666; margin-top: 30px; font-size: 14px; }
                .btn { display: inline-block; padding: 12px 24px; background: #667eea; color: white; text-decoration: none; border-radius: 6px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🔐 Password Reset Verification</h1>
                </div>
                <div class='content'>
                    <p>Hello <strong>{$userName}</strong>,</p>
                    <p>You requested to reset your password. To proceed, please use the following verification code:</p>
                    
                    <div class='code-box'>
                        <p>Your verification code is:</p>
                        <div class='code'>{$code}</div>
                        <p><small>This code will expire in 15 minutes.</small></p>
                    </div>
                    
                    <p><strong>Important:</strong></p>
                    <ul>
                        <li>Never share this code with anyone</li>
                        <li>Enter it exactly as shown (6 digits)</li>
                        <li>The code expires after 15 minutes for security</li>
                    </ul>
                    
                    <p>If you didn't request this password reset, please ignore this email. Your account remains secure.</p>
                    
                    <div class='footer'>
                        <p>Best regards,<br>PIDEV Education Team</p>
                        <p><small>This is an automated message. Please do not reply to this email.</small></p>
                    </div>
                </div>
            </div>
        </body>
        </html>";
    }
}
