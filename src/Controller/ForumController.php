<?php

namespace App\Controller;

use App\Entity\ForumCategory;
use App\Entity\ForumDiscussion;
use App\Entity\ForumMessage;
use App\Entity\ForumView;
use App\Entity\ForumVote;
use App\Form\ForumDiscussionType;
use App\Form\ForumMessageType;
use App\Form\ReplyMessageType;
use App\Repository\ForumCategoryRepository;
use App\Repository\ForumDiscussionRepository;
use App\Repository\ForumMessageRepository;
use App\Repository\ForumViewRepository;
use App\Repository\ForumVoteRepository;
use App\Service\NotificationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/forum')]
class ForumController extends AbstractController
{
    #[Route('/', name: 'forum_index')]
    public function index(
        ForumCategoryRepository $categoryRepository,
        ForumDiscussionRepository $discussionRepository
    ): Response {
        $categories = $categoryRepository->findAllWithDiscussionCount();
        $recentDiscussions = $discussionRepository->findRecent(5);
        $pinnedDiscussions = $discussionRepository->findPinned();
        $mostViewedToday = $discussionRepository->findMostViewedToday();
        $mostDiscussedToday = $discussionRepository->findMostDiscussedToday();
        $topViewedOverall = $discussionRepository->findTopViewedOverall(5);

        return $this->render('forum/index.html.twig', [
            'categories' => $categories,
            'recentDiscussions' => $recentDiscussions,
            'pinnedDiscussions' => $pinnedDiscussions,
            'mostViewedToday' => $mostViewedToday,
            'mostDiscussedToday' => $mostDiscussedToday,
            'topViewedOverall' => $topViewedOverall,
        ]);
    }

    #[Route('/category/{id}', name: 'forum_category')]
    public function category(
        ForumCategory $category,
        ForumDiscussionRepository $discussionRepository
    ): Response {
        $discussions = $discussionRepository->findByCategory($category->getId());

        return $this->render('forum/discussion_list.html.twig', [
            'category' => $category,
            'discussions' => $discussions,
        ]);
    }

    #[Route('/discussion/{id}', name: 'forum_discussion')]
    public function discussion(
        ForumDiscussion $discussion,
        ForumMessageRepository $messageRepository,
        ForumViewRepository $viewRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        NotificationService $notificationService
    ): Response {
        // Record view if user is logged in and hasn't viewed yet
        $user = $this->getUser();
        if ($user && !$viewRepository->hasUserViewed($user, $discussion)) {
            $view = new ForumView();
            $view->setUser($user);
            $view->setDiscussion($discussion);
            $entityManager->persist($view);
            
            // Increment the discussion views counter
            $discussion->setViews($discussion->getViews() + 1);
            
            $entityManager->flush();
        }

        // Get hierarchical messages
        $rootMessages = $messageRepository->findMessagesHierarchy($discussion->getId());

        // Only logged-in users can add messages
        $message = null;
        $form = null;

        if ($user && !$discussion->isLocked()) {
            $message = new ForumMessage();
            $authorName = trim($user->getFirstName() . ' ' . $user->getLastName());
            $message->setAuthorName($authorName);
            $message->setDiscussion($discussion);

            $form = $this->createForm(ForumMessageType::class, $message);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($message);
                $entityManager->flush();

                // Create notification for discussion author
                $notificationService->createReplyToDiscussionNotification($discussion, $message);

                $this->addFlash('success', 'Your message has been added successfully.');
                return $this->redirectToRoute('forum_discussion', ['id' => $discussion->getId()]);
            }
        }

        return $this->render('forum/show.html.twig', [
            'discussion' => $discussion,
            'rootMessages' => $rootMessages,
            'messageForm' => $form?->createView(),
        ]);
    }

    #[Route('/new', name: 'forum_new_discussion')]
    #[IsGranted('ROLE_USER')]
    public function newDiscussion(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $discussion = new ForumDiscussion();
        
        $user = $this->getUser();
        $authorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        $discussion->setAuthorName($authorName);

        $form = $this->createForm(ForumDiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($discussion);
            $entityManager->flush();

            $this->addFlash('success', 'Your discussion has been created successfully.');
            return $this->redirectToRoute('forum_discussion', ['id' => $discussion->getId()]);
        }

        return $this->render('forum/new_discussion.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/discussion/{id}/edit', name: 'forum_edit_discussion')]
    #[IsGranted('ROLE_USER')]
    public function editDiscussion(
        ForumDiscussion $discussion,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($discussion->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'You can only edit your own discussions.');
            return $this->redirectToRoute('forum_discussion', ['id' => $discussion->getId()]);
        }

        $form = $this->createForm(ForumDiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $discussion->setUpdatedAt(new \DateTime());
            $entityManager->flush();

            $this->addFlash('success', 'Your discussion has been updated successfully.');
            return $this->redirectToRoute('forum_discussion', ['id' => $discussion->getId()]);
        }

        return $this->render('forum/edit_discussion.html.twig', [
            'form' => $form->createView(),
            'discussion' => $discussion,
        ]);
    }

    #[Route('/message/{id}/edit', name: 'forum_edit_message')]
    #[IsGranted('ROLE_USER')]
    public function editMessage(
        ForumMessage $message,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($message->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'You can only edit your own messages.');
            return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
        }

        $form = $this->createForm(ForumMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Your message has been updated successfully.');
            return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
        }

        return $this->render('forum/edit_message.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }

    #[Route('/discussion/{id}/delete', name: 'forum_delete_discussion', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function deleteDiscussion(
        ForumDiscussion $discussion,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if (!$this->isCsrfTokenValid('delete_discussion_' . $discussion->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid CSRF token.');
            return $this->redirectToRoute('forum_discussion', ['id' => $discussion->getId()]);
        }

        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($discussion->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'You are not authorized to delete this discussion.');
            return $this->redirectToRoute('forum_discussion', ['id' => $discussion->getId()]);
        }

        $categoryId = $discussion->getCategory()->getId();

        $entityManager->remove($discussion);
        $entityManager->flush();

        $this->addFlash('success', 'Discussion deleted successfully.');
        return $this->redirectToRoute('forum_category', ['id' => $categoryId]);
    }

    #[Route('/message/{id}/delete', name: 'forum_delete_message', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function deleteMessage(
        ForumMessage $message,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if (!$this->isCsrfTokenValid('delete_message_' . $message->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid CSRF token.');
            return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
        }

        $user = $this->getUser();
        $userAuthorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        if ($message->getAuthorName() !== $userAuthorName && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'You are not authorized to delete this message.');
            return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
        }

        $discussionId = $message->getDiscussion()->getId();

        $entityManager->remove($message);
        $entityManager->flush();

        $this->addFlash('success', 'Message deleted successfully.');
        return $this->redirectToRoute('forum_discussion', ['id' => $discussionId]);
    }

    #[Route('/message/{id}/reply', name: 'forum_reply_message', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function replyToMessage(
        ForumMessage $parentMessage,
        Request $request,
        EntityManagerInterface $entityManager,
        ForumMessageRepository $messageRepository,
        NotificationService $notificationService
    ): Response {
        if ($parentMessage->getDiscussion()->isLocked()) {
            $this->addFlash('error', 'This discussion is locked.');
            return $this->redirectToRoute('forum_discussion', ['id' => $parentMessage->getDiscussion()->getId()]);
        }

        if (!$messageRepository->canReplyToMessage($parentMessage->getId())) {
            $this->addFlash('error', 'This message cannot be replied to (maximum nesting depth reached).');
            return $this->redirectToRoute('forum_discussion', ['id' => $parentMessage->getDiscussion()->getId()]);
        }

        $reply = new ForumMessage();
        $form = $this->createForm(ReplyMessageType::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
        $authorName = trim($user->getFirstName() . ' ' . $user->getLastName());
        $reply->setAuthorName($authorName);
            $reply->setDiscussion($parentMessage->getDiscussion());
            $reply->setParent($parentMessage);

            $entityManager->persist($reply);
            $entityManager->flush();

            // Create notification for parent message author
            $notificationService->createReplyToMessageNotification($parentMessage, $reply);

            $this->addFlash('success', 'Reply added successfully.');
        } else {
            foreach ($form->getErrors(true) as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        }

        return $this->redirectToRoute('forum_discussion', ['id' => $parentMessage->getDiscussion()->getId()]);
    }

    #[Route('/search', name: 'forum_search')]
    public function search(Request $request, ForumDiscussionRepository $discussionRepository): Response
    {
        $query = $request->query->get('q');

        if (empty($query)) {
            return $this->redirectToRoute('forum_index');
        }

        $discussions = $discussionRepository->search($query);

        return $this->render('forum/search_results.html.twig', [
            'discussions' => $discussions,
            'query' => $query,
        ]);
    }

    #[Route('/discussion/{id}/vote/{type}', name: 'forum_discussion_vote', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function voteDiscussion(
        int $id,
        string $type,
        ForumDiscussionRepository $discussionRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        // This is a legacy endpoint, redirect to API
        return $this->json(['message' => 'Use /api/messages/{id}/vote instead'], Response::HTTP_MOVED_PERMANENTLY);
    }

    #[Route('/vote/{type}/{id}', name: 'forum_vote', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function voteMessage(
        string $type,
        int $id,
        ForumMessageRepository $messageRepository,
        ForumVoteRepository $voteRepository,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        // Validate vote type
        if (!in_array($type, ['up', 'down'])) {
            if ($request->isXmlHttpRequest()) {
                return $this->json(['error' => 'Invalid vote type. Use "up" or "down"'], Response::HTTP_BAD_REQUEST);
            }
            $this->addFlash('error', 'Invalid vote type.');
            return $this->redirectToRoute('forum_index');
        }

        $user = $this->getUser();
        $message = $messageRepository->find($id);

        if (!$message) {
            if ($request->isXmlHttpRequest()) {
                return $this->json(['error' => 'Message not found'], Response::HTTP_NOT_FOUND);
            }
            $this->addFlash('error', 'Message not found.');
            return $this->redirectToRoute('forum_index');
        }

        // Check for existing vote
        $existingVote = $voteRepository->findByUserAndMessage($user, $message);

        if ($existingVote) {
            // If same vote type, remove it (toggle off)
            if ($existingVote->getVoteType() === $type) {
                $entityManager->remove($existingVote);
                $entityManager->flush();
                
                if ($request->isXmlHttpRequest()) {
                    return $this->json([
                        'success' => true,
                        'action' => 'removed',
                        'upvotes' => $message->getUpvoteCount(),
                        'downvotes' => $message->getDownvoteCount(),
                        'score' => $message->getScore()
                    ]);
                }
                
                $this->addFlash('success', 'Vote removed.');
                return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
            }
            
            // If opposite vote type, update it
            $existingVote->setVoteType($type);
            $entityManager->flush();
            
            if ($request->isXmlHttpRequest()) {
                return $this->json([
                    'success' => true,
                    'action' => 'updated',
                    'upvotes' => $message->getUpvoteCount(),
                    'downvotes' => $message->getDownvoteCount(),
                    'score' => $message->getScore()
                ]);
            }
            
            $this->addFlash('success', 'Vote updated.');
            return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
        }

        // No existing vote, create new one
        $vote = new ForumVote();
        $vote->setUser($user);
        $vote->setMessage($message);
        $vote->setVoteType($type);
        
        $entityManager->persist($vote);
        $entityManager->flush();
        
        if ($request->isXmlHttpRequest()) {
            return $this->json([
                'success' => true,
                'action' => 'added',
                'upvotes' => $message->getUpvoteCount(),
                'downvotes' => $message->getDownvoteCount(),
                'score' => $message->getScore()
            ]);
        }
        
        $this->addFlash('success', 'Vote added.');
        return $this->redirectToRoute('forum_discussion', ['id' => $message->getDiscussion()->getId()]);
    }
}
