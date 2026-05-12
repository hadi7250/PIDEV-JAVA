<?php

namespace App\Controller\Api;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use App\Service\NotificationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api')]
class NotificationApiController extends AbstractController
{
    #[Route('/notifications', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function listNotifications(
        NotificationService $notificationService,
        NotificationRepository $notificationRepository
    ): JsonResponse {
        $user = $this->getUser();
        $notifications = $notificationRepository->findByUser($user);

        $data = [];
        foreach ($notifications as $notification) {
            $data[] = $this->serializeNotification($notification);
        }

        return $this->json([
            'notifications' => $data,
            'total' => count($data),
            'unreadCount' => $notificationService->getUnreadCount($user)
        ]);
    }

    #[Route('/notifications/unread', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function listUnreadNotifications(
        NotificationService $notificationService
    ): JsonResponse {
        $user = $this->getUser();
        $notifications = $notificationService->getUnreadNotifications($user);

        $data = [];
        foreach ($notifications as $notification) {
            $data[] = $this->serializeNotification($notification);
        }

        return $this->json([
            'notifications' => $data,
            'total' => count($data),
            'unreadCount' => count($data)
        ]);
    }

    #[Route('/notifications/{id}/read', methods: ['PUT'])]
    #[IsGranted('ROLE_USER')]
    public function markAsRead(
        int $id,
        NotificationRepository $notificationRepository,
        NotificationService $notificationService
    ): JsonResponse {
        $user = $this->getUser();
        $notification = $notificationRepository->find($id);

        if (!$notification) {
            return $this->json(['error' => 'Notification not found'], Response::HTTP_NOT_FOUND);
        }

        // Check ownership
        if ($notification->getUser() !== $user) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $notificationService->markAsRead($notification);

        return $this->json([
            'notification' => $this->serializeNotification($notification),
            'unreadCount' => $notificationService->getUnreadCount($user)
        ]);
    }

    #[Route('/notifications/mark-all-read', methods: ['PUT'])]
    #[IsGranted('ROLE_USER')]
    public function markAllAsRead(
        NotificationService $notificationService
    ): JsonResponse {
        $user = $this->getUser();
        $notificationService->markAllAsReadForUser($user);

        return $this->json([
            'message' => 'All notifications marked as read',
            'unreadCount' => 0
        ]);
    }

    #[Route('/notifications/{id}', methods: ['DELETE'])]
    #[IsGranted('ROLE_USER')]
    public function deleteNotification(
        int $id,
        NotificationRepository $notificationRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $user = $this->getUser();
        $notification = $notificationRepository->find($id);

        if (!$notification) {
            return $this->json(['error' => 'Notification not found'], Response::HTTP_NOT_FOUND);
        }

        // Check ownership
        if ($notification->getUser() !== $user) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $entityManager->remove($notification);
        $entityManager->flush();

        return $this->json(['message' => 'Notification deleted successfully']);
    }

    #[Route('/notifications/count', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function getUnreadCount(
        NotificationService $notificationService
    ): JsonResponse {
        $user = $this->getUser();
        $count = $notificationService->getUnreadCount($user);

        return $this->json(['unreadCount' => $count]);
    }

    private function serializeNotification(Notification $notification): array
    {
        return [
            'id' => $notification->getId(),
            'type' => $notification->getType(),
            'message' => $notification->getFormattedMessage(),
            'isRead' => $notification->isRead(),
            'createdAt' => $notification->getCreatedAt()?->format('c'),
            'actionUrl' => $notification->getActionUrl(),
            'discussionId' => $notification->getRelatedDiscussion()?->getId(),
            'messageId' => $notification->getRelatedMessage()?->getId(),
        ];
    }
}
