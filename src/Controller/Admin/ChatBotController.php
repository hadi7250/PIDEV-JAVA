<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/chatbot')]
class ChatBotController extends AbstractController
{
    private string $groqApiKey;

    public function __construct()
    {
        $this->groqApiKey = $_ENV['GROQ_API_KEY'] 
                         ?? getenv('GROQ_API_KEY') 
                         ?? '';
    }

    #[Route('/query', name: 'admin_chatbot_query', methods: ['POST'])]
    public function query(Request $request, UserRepository $userRepo): JsonResponse
    {
        $data      = json_decode($request->getContent(), true);
        $userQuery = trim($data['query'] ?? '');

        if ($userQuery === '') {
            return new JsonResponse(['response' => 'Posez-moi une question !']);
        }

        // ── Real DB stats ────────────────────────────────────────────────
        $totalUsers   = $userRepo->count([]);
        $activeUsers  = $userRepo->count(['status' => 'active']);
        $pendingUsers = $userRepo->count(['status' => 'pending']);
        $adminUsers   = count($userRepo->findByRole('ROLE_ADMIN'));
        $regularUsers = count($userRepo->findByRole('ROLE_USER'));

        $dbContext = "
Current real-time database statistics:
- Total users: $totalUsers
- Active users: $activeUsers
- Pending users: $pendingUsers
- Admins (ROLE_ADMIN): $adminUsers
- Regular users (ROLE_USER): $regularUsers
";

        // ── Messages for Groq ────────────────────────────────────────────
        $messages = [
            [
                'role'    => 'system',
                'content' => "You are a friendly and helpful admin assistant for the EduConnect platform.
You have access to real-time user statistics from the database shown below.
IMPORTANT RULES:
- Always respond in the same language the user writes in (French if French, English if English, Arabic if Arabic).
- Be conversational and warm. If someone greets you, greet them back naturally.
- When asked about user statistics, use the real data provided below.
- Keep responses concise, friendly and helpful.
- Never say you cannot answer general questions — you are a full assistant.

$dbContext",
            ],
            [
                'role'    => 'user',
                'content' => $userQuery,
            ],
        ];

        // ── Call Groq API ────────────────────────────────────────────────
        try {
            $payload = json_encode([
                'model'       => 'llama-3.1-8b-instant',
                'messages'    => $messages,
                'max_tokens'  => 500,
                'temperature' => 0.7,
            ]);

            $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_HTTPHEADER     => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $this->groqApiKey,
                ],
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_TIMEOUT    => 15,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $result = json_decode($response, true);
                $answer = $result['choices'][0]['message']['content'] 
                       ?? 'No response from AI.';
            } else {
                $errorBody = json_decode($response, true);
                $errorMsg  = $errorBody['error']['message'] ?? $response;
                $answer    = 'Groq Error ' . $httpCode . ': ' . $errorMsg;
            }

        } catch (\Exception $e) {
            $answer = 'Exception: ' . $e->getMessage();
        }

        return new JsonResponse(['response' => $answer]);
    }
}