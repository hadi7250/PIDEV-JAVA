<?php

namespace App\Controller\Api;

use App\Entity\ForumCategory;
use App\Entity\ForumDiscussion;
use App\Entity\ForumMessage;
use App\Entity\ForumVote;
use App\Entity\ForumView;
use App\Form\ForumDiscussionType;
use App\Form\ForumMessageType;
use App\Repository\ForumCategoryRepository;
use App\Repository\ForumDiscussionRepository;
use App\Repository\ForumMessageRepository;
use App\Repository\ForumVoteRepository;
use App\Repository\ForumViewRepository;
use App\Service\NotificationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api')]
class ForumApiController extends AbstractController
{
    #[Route('/discussions', methods: ['GET'])]
    public function listDiscussions(
        Request $request,
        ForumDiscussionRepository $discussionRepository
    ): JsonResponse {
        $categoryId = $request->query->get('category');
        $search = $request->query->get('search');
        $sort = $request->query->get('sort', 'updated');
        $page = (int) $request->query->get('page', 1);
        $limit = (int) $request->query->get('limit', 20);

        if ($search) {
            $discussions = $discussionRepository->search($search);
        } elseif ($categoryId) {
            $discussions = $discussionRepository->findByCategory((int) $categoryId);
        } else {
            $discussions = $discussionRepository->findRecent($limit);
        }

        $data = [];
        foreach ($discussions as $discussion) {
            $data[] = $this->serializeDiscussion($discussion);
        }

        return $this->json([
            'discussions' => $data,
            'total' => count($data),
            'page' => $page,
        ]);
    }

    #[Route('/discussions', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function createDiscussion(
        Request $request,
        EntityManagerInterface $entityManager,
        ForumCategoryRepository $categoryRepository
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        
        if (!$data) {
            return $this->json(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $discussion = new ForumDiscussion();
        $discussion->setTitle($data['title'] ?? '');
        $discussion->setContent($data['content'] ?? '');
        
        $user = $this->getUser();
        $authorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        $discussion->setAuthorName($authorName);

        if (isset($data['categoryId'])) {
            $category = $categoryRepository->find($data['categoryId']);
            if ($category) {
                $discussion->setCategory($category);
            }
        }

        $errors = [];
        if (empty($data['title'])) {
            $errors['title'] = 'Title is required';
        }
        if (empty($data['content'])) {
            $errors['content'] = 'Content is required';
        }
        if (!$discussion->getCategory()) {
            $errors['category'] = 'Category is required';
        }

        if (!empty($errors)) {
            return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($discussion);
        $entityManager->flush();

        return $this->json([
            'discussion' => $this->serializeDiscussion($discussion),
            'message' => 'Discussion created successfully'
        ], Response::HTTP_CREATED);
    }

    #[Route('/discussions/{id}', methods: ['GET'])]
    public function getDiscussion(
        int $id,
        ForumDiscussionRepository $discussionRepository,
        ForumViewRepository $viewRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        // Record view if user is logged in
        $user = $this->getUser();
        if ($user && !$viewRepository->hasUserViewed($user, $discussion)) {
            $view = new ForumView();
            $view->setUser($user);
            $view->setDiscussion($discussion);
            $entityManager->persist($view);
            $entityManager->flush();
        }

        return $this->json([
            'discussion' => $this->serializeDiscussion($discussion, true)
        ]);
    }

    #[Route('/discussions/{id}', methods: ['PUT'])]
    #[IsGranted('ROLE_USER')]
    public function updateDiscussion(
        int $id,
        Request $request,
        ForumDiscussionRepository $discussionRepository,
        ForumCategoryRepository $categoryRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        // Check authorization
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($discussion->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['title'])) {
            $discussion->setTitle($data['title']);
        }
        if (isset($data['content'])) {
            $discussion->setContent($data['content']);
        }
        if (isset($data['categoryId'])) {
            $category = $categoryRepository->find($data['categoryId']);
            if ($category) {
                $discussion->setCategory($category);
            }
        }

        $entityManager->flush();

        return $this->json([
            'discussion' => $this->serializeDiscussion($discussion),
            'message' => 'Discussion updated successfully'
        ]);
    }

    #[Route('/discussions/{id}', methods: ['DELETE'])]
    #[IsGranted('ROLE_USER')]
    public function deleteDiscussion(
        int $id,
        ForumDiscussionRepository $discussionRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        // Check authorization
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($discussion->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $entityManager->remove($discussion);
        $entityManager->flush();

        return $this->json(['message' => 'Discussion deleted successfully']);
    }

    #[Route('/discussions/{id}/pin', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function pinDiscussion(
        int $id,
        ForumDiscussionRepository $discussionRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        $discussion->setIsPinned(!$discussion->isPinned());
        $entityManager->flush();

        return $this->json([
            'discussion' => $this->serializeDiscussion($discussion),
            'message' => $discussion->isPinned() ? 'Discussion pinned' : 'Discussion unpinned'
        ]);
    }

    #[Route('/discussions/{id}/solve', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function solveDiscussion(
        int $id,
        ForumDiscussionRepository $discussionRepository,
        EntityManagerInterface $entityManager,
        NotificationService $notificationService
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        // Check authorization
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($discussion->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $discussion->setIsSolved(!$discussion->isSolved());
        $entityManager->flush();

        if ($discussion->isSolved()) {
            $notificationService->createDiscussionSolvedNotification($discussion, $user);
        }

        return $this->json([
            'discussion' => $this->serializeDiscussion($discussion),
            'message' => $discussion->isSolved() ? 'Discussion marked as solved' : 'Discussion marked as unsolved'
        ]);
    }

    #[Route('/discussions/{id}/lock', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function lockDiscussion(
        int $id,
        ForumDiscussionRepository $discussionRepository,
        EntityManagerInterface $entityManager,
        NotificationService $notificationService
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        $discussion->setIsLocked(!$discussion->isLocked());
        $entityManager->flush();

        if ($discussion->isLocked()) {
            $notificationService->createDiscussionLockedNotification($discussion, $this->getUser());
        }

        return $this->json([
            'discussion' => $this->serializeDiscussion($discussion),
            'message' => $discussion->isLocked() ? 'Discussion locked' : 'Discussion unlocked'
        ]);
    }

    #[Route('/discussions/{id}/messages', methods: ['GET'])]
    public function listMessages(
        int $id,
        ForumDiscussionRepository $discussionRepository,
        ForumMessageRepository $messageRepository
    ): JsonResponse {
        $discussion = $discussionRepository->find($id);

        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        $messages = $messageRepository->findMessagesHierarchy($id);
        $data = [];
        foreach ($messages as $message) {
            $data[] = $this->serializeMessage($message, true);
        }

        return $this->json([
            'messages' => $data,
            'total' => count($data)
        ]);
    }

    #[Route('/messages', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function createMessage(
        Request $request,
        ForumDiscussionRepository $discussionRepository,
        ForumMessageRepository $messageRepository,
        EntityManagerInterface $entityManager,
        NotificationService $notificationService
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $discussionId = $data['discussionId'] ?? null;
        $parentMessageId = $data['parentMessageId'] ?? null;

        if (!$discussionId) {
            return $this->json(['error' => 'Discussion ID is required'], Response::HTTP_BAD_REQUEST);
        }

        $discussion = $discussionRepository->find($discussionId);
        if (!$discussion) {
            return $this->json(['error' => 'Discussion not found'], Response::HTTP_NOT_FOUND);
        }

        if ($discussion->isLocked()) {
            return $this->json(['error' => 'Discussion is locked'], Response::HTTP_FORBIDDEN);
        }

        $message = new ForumMessage();
        $message->setContent($data['content'] ?? '');
        
        $user = $this->getUser();
        $authorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        $message->setAuthorName($authorName);
        $message->setDiscussion($discussion);

        if (empty($data['content'])) {
            return $this->json(['error' => 'Content is required'], Response::HTTP_BAD_REQUEST);
        }

        // Handle nested reply
        if ($parentMessageId) {
            $parentMessage = $messageRepository->find($parentMessageId);
            if (!$parentMessage) {
                return $this->json(['error' => 'Parent message not found'], Response::HTTP_NOT_FOUND);
            }
            if (!$messageRepository->canReplyToMessage($parentMessageId)) {
                return $this->json(['error' => 'Maximum nesting depth reached'], Response::HTTP_BAD_REQUEST);
            }
            $message->setParent($parentMessage);
        }

        $entityManager->persist($message);
        $entityManager->flush();

        // Create notifications
        if ($parentMessageId) {
            $notificationService->createReplyToMessageNotification($parentMessage, $message);
        } else {
            $notificationService->createReplyToDiscussionNotification($discussion, $message);
        }

        return $this->json([
            'message' => $this->serializeMessage($message),
            'success' => true
        ], Response::HTTP_CREATED);
    }

    #[Route('/messages/{id}', methods: ['PUT'])]
    #[IsGranted('ROLE_USER')]
    public function updateMessage(
        int $id,
        Request $request,
        ForumMessageRepository $messageRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $message = $messageRepository->find($id);

        if (!$message) {
            return $this->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
        }

        // Check authorization
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($message->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['content'])) {
            $message->setContent($data['content']);
        }

        $entityManager->flush();

        return $this->json([
            'message' => $this->serializeMessage($message),
            'success' => true
        ]);
    }

    #[Route('/messages/{id}', methods: ['DELETE'])]
    #[IsGranted('ROLE_USER')]
    public function deleteMessage(
        int $id,
        ForumMessageRepository $messageRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $message = $messageRepository->find($id);

        if (!$message) {
            return $this->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
        }

        // Check authorization
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($message->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            return $this->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        $entityManager->remove($message);
        $entityManager->flush();

        return $this->json(['message' => 'Message deleted successfully']);
    }

    #[Route('/messages/{id}/vote', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function voteMessage(
        int $id,
        Request $request,
        ForumMessageRepository $messageRepository,
        ForumVoteRepository $voteRepository,
        EntityManagerInterface $entityManager,
        NotificationService $notificationService
    ): JsonResponse {
        $message = $messageRepository->find($id);

        if (!$message) {
            return $this->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
        }

        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());

        // Prevent self-voting
        if ($message->getAuthorName() === $userAuthorName) {
            return $this->json(['error' => 'Cannot vote on your own messages'], Response::HTTP_FORBIDDEN);
        }

        $data = json_decode($request->getContent(), true);
        $voteType = $data['voteType'] ?? null;

        if (!in_array($voteType, [ForumVote::TYPE_UPVOTE, ForumVote::TYPE_DOWNVOTE])) {
            return $this->json(['error' => 'Invalid vote type. Use UPVOTE or DOWNVOTE'], Response::HTTP_BAD_REQUEST);
        }

        $existingVote = $voteRepository->findByUserAndMessage($user, $message);

        if ($existingVote) {
            if ($existingVote->getVoteType() === $voteType) {
                // Remove vote (toggle off)
                $entityManager->remove($existingVote);
                $result = 'removed';
            } else {
                // Change vote type
                $existingVote->setVoteType($voteType);
                $result = 'changed';
            }
        } else {
            // Create new vote
            $vote = new ForumVote();
            $vote->setUser($user);
            $vote->setMessage($message);
            $vote->setVoteType($voteType);
            $entityManager->persist($vote);
            $result = 'added';

            // Create notification for upvote
            if ($voteType === ForumVote::TYPE_UPVOTE) {
                $notificationService->createMessageUpvoteNotification($message, $user);
            }
        }

        $entityManager->flush();

        return $this->json([
            'result' => $result,
            'upvotes' => $message->getUpvoteCount(),
            'downvotes' => $message->getDownvoteCount(),
            'score' => $message->getScore()
        ]);
    }

    private function serializeDiscussion(ForumDiscussion $discussion, bool $includeMessages = false): array
    {
        $data = [
            'id' => $discussion->getId(),
            'title' => $discussion->getTitle(),
            'content' => $discussion->getContent(),
            'authorName' => $discussion->getAuthorName(),
            'category' => [
                'id' => $discussion->getCategory()?->getId(),
                'name' => $discussion->getCategory()?->getName(),
            ],
            'isPinned' => $discussion->isPinned(),
            'isSolved' => $discussion->isSolved(),
            'isLocked' => $discussion->isLocked(),
            'messageCount' => $discussion->getMessageCount(),
            'viewCount' => $discussion->getViewCount(),
            'createdAt' => $discussion->getCreatedAt()?->format('c'),
            'updatedAt' => $discussion->getUpdatedAt()?->format('c'),
        ];

        if ($includeMessages) {
            $messages = [];
            foreach ($discussion->getMessages() as $message) {
                $messages[] = $this->serializeMessage($message, true);
            }
            $data['messages'] = $messages;
        }

        return $data;
    }

    private function serializeMessage(ForumMessage $message, bool $includeReplies = false): array
    {
        $data = [
            'id' => $message->getId(),
            'content' => $message->getContent(),
            'authorName' => $message->getAuthorName(),
            'discussionId' => $message->getDiscussion()?->getId(),
            'parentMessageId' => $message->getParent()?->getId(),
            'upvotes' => $message->getUpvoteCount(),
            'downvotes' => $message->getDownvoteCount(),
            'score' => $message->getScore(),
            'replyCount' => $message->getReplyCount(),
            'createdAt' => $message->getCreatedAt()?->format('c'),
        ];

        if ($includeReplies && $message->hasReplies()) {
            $replies = [];
            foreach ($message->getReplies() as $reply) {
                $replies[] = $this->serializeMessage($reply, true);
            }
            $data['replies'] = $replies;
        }

        return $data;
    }
}
