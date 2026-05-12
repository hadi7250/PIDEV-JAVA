<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class GoogleAuthenticator extends OAuth2Authenticator
{
    private $clientRegistry;
    private $entityManager;
    private $passwordHasher;
    private $mailer;

    public function __construct(
        ClientRegistry $clientRegistry,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        MailerInterface $mailer
    ) {
        $this->clientRegistry = $clientRegistry;
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->mailer = $mailer;
    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'connect_google_check';
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function() use ($accessToken, $client) {
                $googleUser = $client->fetchUserFromToken($accessToken);

                $email = $googleUser->getEmail();
                $googleId = $googleUser->getId();
                $name = $googleUser->getName();

                $user = $this->entityManager->getRepository(User::class)->findOneBy(['googleId' => $googleId]);

                if (!$user) {
                    $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
                    
                    if (!$user) {
                        $user = new User();
                        $user->setEmail($email);
                        $nameParts = explode(' ', $name, 2);
                        $user->setFirstName($nameParts[0] ?? $name);
                        $user->setLastName($nameParts[1] ?? '');
                        $user->setRole('USER');
                        $user->setStatus('pending');
                        $user->setGoogleId($googleId);
                        
                        // Générer un mot de passe aléatoire
                        $randomPlainPassword = bin2hex(random_bytes(16));
                        $user->setPassword($randomPlainPassword);
                        
                        $this->entityManager->persist($user);
                    } else {
                        $user->setGoogleId($googleId);
                    }
                }

                $this->entityManager->flush();

                // Envoi de l'email avec le mot de passe aléatoire
                if ($user->getStatus() === 'pending' && isset($randomPlainPassword)) {
                    $emailMessage = (new Email())
                        ->from('no-reply@braine.com')
                        ->to($user->getEmail())
                        ->subject('Bienvenue sur Braine ! Vos identifiants Google')
                        ->text("Bonjour " . $user->getFirstName() . ' ' . $user->getLastName() . ",\n\n" .
                               "Votre compte a été créé avec succès via Google.\n\n" .
                               "Voici votre mot de passe temporaire pour connexion classique :\n" .
                               "Mot de passe : " . $randomPlainPassword . "\n\n" .
                               "Changez-le dès que possible dans votre profil.\n" .
                               "Vous pouvez vous connecter ici : http://127.0.0.1:8000/login\n\n" .
                               "Bienvenue sur Braine !\n" .
                               "L'équipe");
                    
                    try {
                    $this->mailer->send($emailMessage);
                } catch (\Exception $e) {
                    // email failed silently, user is already created and can login
                    error_log('Email sending failed: ' . $e->getMessage());
                }
                }

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $token->getUser();
        
        // Rediriger selon le statut de l'utilisateur
        if ($user instanceof User && $user->getStatus() === 'pending') {
            // Pour les utilisateurs pending, on ne redirige PAS vers login car ils sont déjà authentifiés
            // On les redirige vers une page d'attente ou on les laisse accéder au site mais avec un message
            $session = $request->getSession();
            if ($session instanceof \Symfony\Component\HttpFoundation\Session\Session) {
                $session->getFlashBag()->add('info', 'Votre compte est en attente d\'approbation par l\'administrateur. Vous avez reçu un email avec vos identifiants de connexion.');
            }
            return new \Symfony\Component\HttpFoundation\RedirectResponse('/');
        }
        
        if ($user instanceof User && $user->getStatus() === 'inactive') {
            $session = $request->getSession();
            if ($session instanceof \Symfony\Component\HttpFoundation\Session\Session) {
                $session->getFlashBag()->add('error', 'Votre compte est désactivé. Contactez l\'administrateur.');
            }
            return new \Symfony\Component\HttpFoundation\RedirectResponse('/login');
        }
        
        // Utilisateur actif - rediriger vers le dashboard admin si admin, sinon page d'accueil
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return new \Symfony\Component\HttpFoundation\RedirectResponse('/dashboard');
        }
        
        return new \Symfony\Component\HttpFoundation\RedirectResponse('/');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $request->getSession()->getFlashBag()->add('error', 'Authentication failed: ' . $exception->getMessage());
        return new \Symfony\Component\HttpFoundation\RedirectResponse('/login');
    }
}
