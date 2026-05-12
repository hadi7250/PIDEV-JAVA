<?php

namespace App\Service;

use App\Entity\ForumDiscussion;
use App\Entity\ForumMessage;
use App\Entity\Notification;
use App\Entity\User;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private NotificationRepository $notificationRepository
    ) {
    }

    /**
     * Create notification when someone replies to a discussion
     */
    public function createReplyToDiscussionNotification(ForumDiscussion $discussion, ForumMessage $reply): void
    {
        $discussionAuthorName = $discussion->getAuthorName();
        $replyAuthorName = $reply->getAuthorName();

        // Don't notify if user replies to their own discussion
        if ($discussionAuthorName === $replyAuthorName || !$discussionAuthorName) {
            return;
        }

        // Find the discussion author user by name
        $discussionAuthorUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'firstName' => explode(' ', $discussionAuthorName)[0] ?? '',
            'lastName' => explode(' ', $discussionAuthorName)[1] ?? ''
        ]);

        // Check if notification already exists for this reply
        $existingNotification = $this->notificationRepository->findOneBy([
            'user' => $discussionAuthorUser,
            'type' => Notification::TYPE_REPLY_TO_DISCUSSION,
            'relatedDiscussion' => $discussion,
            'relatedMessage' => $reply,
        ]);

        if ($existingNotification) {
            return;
        }

        $notification = new Notification();
        $notification->setUser($discussionAuthorUser);
        $notification->setType(Notification::TYPE_REPLY_TO_DISCUSSION);
        $notification->setMessage('Someone replied to your discussion');
        $notification->setRelatedDiscussion($discussion);
        $notification->setRelatedMessage($reply);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    /**
     * Create notification when someone replies to a message
     */
    public function createReplyToMessageNotification(ForumMessage $parentMessage, ForumMessage $reply): void
    {
        $messageAuthorName = $parentMessage->getAuthorName();
        $replyAuthorName = $reply->getAuthorName();

        // Don't notify if user replies to their own message
        if ($messageAuthorName === $replyAuthorName || !$messageAuthorName) {
            return;
        }

        // Find the message author user by name
        $messageAuthorUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'firstName' => explode(' ', $messageAuthorName)[0] ?? '',
            'lastName' => explode(' ', $messageAuthorName)[1] ?? ''
        ]);

        // Check if notification already exists for this reply
        $existingNotification = $this->notificationRepository->findOneBy([
            'user' => $messageAuthorUser,
            'type' => Notification::TYPE_REPLY_TO_MESSAGE,
            'relatedDiscussion' => $parentMessage->getDiscussion(),
            'relatedMessage' => $reply,
        ]);

        if ($existingNotification) {
            return;
        }

        $notification = new Notification();
        $notification->setUser($messageAuthorUser);
        $notification->setType(Notification::TYPE_REPLY_TO_MESSAGE);
        $notification->setMessage('Someone replied to your message');
        $notification->setRelatedDiscussion($parentMessage->getDiscussion());
        $notification->setRelatedMessage($reply);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    /**
     * Create notification for discussion solved
     */
    public function createDiscussionSolvedNotification(ForumDiscussion $discussion, User $solver): void
    {
        $authorName = $discussion->getAuthorName();
        $solverName = trim($solver->getFirstName() . ' ' . $solver->getLastName());

        if (!$authorName || $authorName === $solverName) {
            return;
        }

        // Find the discussion author user by name
        $authorUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'firstName' => explode(' ', $authorName)[0] ?? '',
            'lastName' => explode(' ', $authorName)[1] ?? ''
        ]);

        if (!$authorUser) {
            return;
        }

        $notification = new Notification();
        $notification->setUser($authorUser);
        $notification->setType(Notification::TYPE_DISCUSSION_SOLVED);
        $notification->setMessage('Your discussion was marked as solved');
        $notification->setRelatedDiscussion($discussion);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    /**
     * Create notification for discussion locked
     */
    public function createDiscussionLockedNotification(ForumDiscussion $discussion, User $locker): void
    {
        $authorName = $discussion->getAuthorName();
        $lockerName = trim($locker->getFirstName() . ' ' . $locker->getLastName());

        if (!$authorName || $authorName === $lockerName) {
            return;
        }

        // Find the discussion author user by name
        $authorUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'firstName' => explode(' ', $authorName)[0] ?? '',
            'lastName' => explode(' ', $authorName)[1] ?? ''
        ]);

        if (!$authorUser) {
            return;
        }

        $notification = new Notification();
        $notification->setUser($authorUser);
        $notification->setType(Notification::TYPE_DISCUSSION_LOCKED);
        $notification->setMessage('Your discussion was locked');
        $notification->setRelatedDiscussion($discussion);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    /**
     * Create notification for message upvote
     */
    public function createMessageUpvoteNotification(ForumMessage $message, User $voter): void
    {
        $authorName = $message->getAuthorName();
        $voterName = trim($voter->getFirstName() . ' ' . $voter->getLastName());

        if (!$authorName || $authorName === $voterName) {
            return;
        }

        // Find the message author user by name
        $authorUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'firstName' => explode(' ', $authorName)[0] ?? '',
            'lastName' => explode(' ', $authorName)[1] ?? ''
        ]);

        if (!$authorUser) {
            return;
        }

        $notification = new Notification();
        $notification->setUser($authorUser);
        $notification->setType(Notification::TYPE_MESSAGE_UPVOTE);
        $notification->setMessage('Your message received an upvote');
        $notification->setRelatedDiscussion($message->getDiscussion());
        $notification->setRelatedMessage($message);

        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification): void
    {
        $notification->markAsRead();
        $this->entityManager->flush();
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsReadForUser(User $user): void
    {
        $this->notificationRepository->markAllAsReadForUser($user);
    }

    /**
     * Get unread notifications for a user
     * @return Notification[]
     */
    public function getUnreadNotifications(User $user): array
    {
        return $this->notificationRepository->findUnreadByUser($user);
    }

    /**
     * Get unread notification count for a user
     */
    public function getUnreadCount(User $user): int
    {
        return $this->notificationRepository->getUnreadCount($user);
    }

    /**
     * Clean up old read notifications
     */
    public function cleanupOldNotifications(int $days = 30): int
    {
        return $this->notificationRepository->deleteOldReadNotifications($days);
    }
}
