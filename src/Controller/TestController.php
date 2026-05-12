<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test-login-page', name: 'test_login_page')]
    public function testLogin(): Response
    {
        return new Response('
            <html>
                <body>
                    <h1>Test Login Page</h1>
                    <p>Si tu vois cette page, Symfony fonctionne.</p>
                    <p>Le problème est ailleurs.</p>
                    <a href="/login">Essayer /login normal</a>
                </body>
            </html>
        ');
    }
}