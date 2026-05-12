<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\EmailVerificationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Removed redirect check to allow login page access even when logged in

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function forgotPassword(Request $request, UserRepository $userRepository, EmailVerificationService $emailService): Response
    {
        $error = null;
        $success = null;
        $email = null;

        if ($request->isMethod('POST')) {
            $action = $request->request->get('action');
            
            if ($action === 'send_code') {
                // Step 1: Send verification code
                $email = $request->request->get('email');
                
                // Validate email
                if (!$email) {
                    return new JsonResponse(['error' => 'Email is required'], 400);
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return new JsonResponse(['error' => 'Please enter a valid email address'], 400);
                }
                
                // Check if user exists
                $user = $userRepository->findOneBy(['email' => $email]);
                
                if (!$user) {
                    // Don't reveal if email exists or not for security
                    return new JsonResponse(['success' => 'If an account with this email exists, you will receive a verification code.']);
                }
                
                // Generate and send verification code
                $verificationCode = $emailService->generateVerificationCode();
                
                if ($emailService->sendVerificationCode($user, $verificationCode)) {
                    return new JsonResponse([
                        'success' => 'Verification code sent to your email. Please check your inbox.',
                        'step' => 'verify_code',
                        'email' => $email
                    ]);
                } else {
                    return new JsonResponse(['error' => 'Failed to send verification code. Please try again.'], 500);
                }
                
            } elseif ($action === 'verify_code') {
                // Step 2: Verify code and generate reset token
                $email = $request->request->get('email');
                $code = $request->request->get('code');
                
                if (!$email || !$code) {
                    return new JsonResponse(['error' => 'Email and verification code are required'], 400);
                }
                
                $user = $userRepository->findOneBy(['email' => $email]);
                
                if (!$user) {
                    return new JsonResponse(['error' => 'Invalid email or code'], 400);
                }
                
                $resetToken = $emailService->verifyCodeAndGenerateToken($user, $code);
                
                if (!$resetToken) {
                    return new JsonResponse(['error' => 'Invalid or expired verification code'], 400);
                }
                
                // Redirect to reset password page with token
                $resetUrl = $this->generateUrl('app_reset_password', ['token' => $resetToken]);
                return new JsonResponse([
                    'success' => 'Code verified successfully. Redirecting to reset password page...',
                    'redirect' => $resetUrl
                ]);
            }
        }

        return $this->render('security/forgot_password.html.twig', [
            'error' => $error,
            'success' => $success,
        ]);
    }

    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function resetPassword(Request $request, string $token, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $error = null;
        $success = null;
        
        // Find user by reset token
        $user = $userRepository->findOneBy(['resetToken' => $token]);
        
        if (!$user) {
            $error = 'Invalid or expired reset token';
        } elseif ($user->getResetTokenExpiry() && $user->getResetTokenExpiry() < new \DateTime()) {
            $error = 'Reset token has expired';
        } elseif ($request->isMethod('POST')) {
            $password = $request->request->get('password');
            $confirmPassword = $request->request->get('confirm_password');
            
            // Validate passwords
            if (!$password) {
                $error = 'Password is required';
            } elseif (strlen($password) < 6) {
                $error = 'Password must be at least 6 characters';
            } elseif ($password !== $confirmPassword) {
                $error = 'Passwords do not match';
            } else {
                // Update password (plaintext for Java compatibility)
                $user->setPassword($password);
                $user->setResetToken(null);
                // Note: setResetTokenExpiry is protected, will be handled automatically
                
                $entityManager->flush();
                
                $success = 'Password has been reset successfully! You can now login with your new password.';
            }
        }

        return $this->render('security/reset_password.html.twig', [
            'error' => $error,
            'success' => $success,
            'token' => $token
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        // Removed redirect check to allow registration even when logged in

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set username to lowercase email if not provided
            $username = $user->getUsername() ?: strtolower($user->getEmail());
            $user->setUsername($username);
            
            // Set default role and status
            $user->setRole('USER');
            $user->setStatus('active');
            
            // Set created and updated timestamps
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());
            
            // Store password as plaintext for Java compatibility
            $user->setPassword($form->get('plainPassword')->getData());

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Account created successfully! You can now log in.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/app/emailbox', name: 'app_emailbox')]
    public function emailbox(): Response
    {
        return $this->render('security/emailbox.html.twig');
    }

    #[Route('/app/emailread', name: 'app_emailread')]
    public function emailread(): Response
    {
        return $this->render('security/emailread.html.twig');
    }

    #[Route('/app/chat_box', name: 'app_chat_box')]
    public function chatBox(): Response
    {
        return $this->render('security/chat_box.html.twig');
    }
}