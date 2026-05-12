<?php

namespace App\Repository;

use App\Entity\ForumMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumMessage>
 */
class ForumMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumMessage::class);
    }

    /**
     * @return ForumMessage[] Returns an array of ForumMessage objects for a discussion
     */
    public function findByDiscussion(int $discussionId): array
    {
        return $this->createQueryBuilder('fm')
            ->where('fm.discussion = :discussionId')
            ->setParameter('discussionId', $discussionId)
            ->orderBy('fm.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumMessage[] Returns an array of root ForumMessage objects (no parent) for a discussion
     */
    public function findRootMessages(int $discussionId): array
    {
        return $this->createQueryBuilder('fm')
            ->leftJoin('fm.votes', 'fv')
            ->where('fm.discussion = :discussionId')
            ->andWhere('fm.parent IS NULL')
            ->setParameter('discussionId', $discussionId)
            ->orderBy('fm.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumMessage[] Returns all messages organized in hierarchical structure
     */
    public function findMessagesHierarchy(int $discussionId): array
    {
        $allMessages = $this->createQueryBuilder('fm')
            ->leftJoin('fm.votes', 'fv')
            ->leftJoin('fm.parent', 'parent')
            ->where('fm.discussion = :discussionId')
            ->setParameter('discussionId', $discussionId)
            ->orderBy('fm.createdAt', 'ASC')
            ->getQuery()
            ->getResult();

        $rootMessages = [];
        $messagesById = [];

        foreach ($allMessages as $message) {
            $messagesById[$message->getId()] = $message;
        }

        foreach ($allMessages as $message) {
            if ($message->getParent() === null) {
                $rootMessages[] = $message;
            } else {
                $parentId = $message->getParent()->getId();
                if (isset($messagesById[$parentId])) {
                    $messagesById[$parentId]->addReply($message);
                }
            }
        }

        return $rootMessages;
    }

    /**
     * @return ForumMessage[] Returns an array of ForumMessage objects by author name
     */
    public function findByAuthorName(string $authorName, int $limit = 50): array
    {
        return $this->createQueryBuilder('fm')
            ->leftJoin('fm.discussion', 'fd')
            ->where('fm.authorName = :authorName')
            ->setParameter('authorName', $authorName)
            ->orderBy('fm.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumMessage[] Returns an array of most upvoted ForumMessage objects
     */
    public function findMostUpvoted(int $limit = 10): array
    {
        return $this->createQueryBuilder('fm')
            ->leftJoin('fm.discussion', 'fd')
            ->leftJoin('fm.votes', 'fv')
            ->groupBy('fm.id')
            ->orderBy('SUM(CASE WHEN fv.voteType = :upvote THEN 1 ELSE 0 END)', 'DESC')
            ->setParameter('upvote', 'UPVOTE')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumMessage[] Returns an array of highest scored ForumMessage objects
     */
    public function findHighestScored(int $limit = 10): array
    {
        return $this->createQueryBuilder('fm')
            ->leftJoin('fm.discussion', 'fd')
            ->leftJoin('fm.votes', 'fv')
            ->groupBy('fm.id')
            ->orderBy(
                '(SUM(CASE WHEN fv.voteType = :upvote THEN 1 ELSE 0 END) - SUM(CASE WHEN fv.voteType = :downvote THEN 1 ELSE 0 END))',
                'DESC'
            )
            ->setParameter('upvote', 'UPVOTE')
            ->setParameter('downvote', 'DOWNVOTE')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Search messages by content
     * @return ForumMessage[]
     */
    public function search(string $query, int $limit = 50): array
    {
        return $this->createQueryBuilder('fm')
            ->leftJoin('fm.discussion', 'fd')
            ->where('fm.content LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('fm.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Check if a message can be replied to (prevent deep nesting)
     */
    public function canReplyToMessage(int $messageId, int $maxDepth = 3): bool
    {
        $message = $this->find($messageId);
        if (!$message) {
            return false;
        }

        $depth = 0;
        $current = $message;

        while ($current->getParent() !== null && $depth < $maxDepth) {
            $current = $current->getParent();
            $depth++;
        }

        return $depth < $maxDepth;
    }

    /**
     * Get message statistics for a discussion
     */
    public function getDiscussionStats(int $discussionId): array
    {
        $result = $this->createQueryBuilder('fm')
            ->select(
                'COUNT(fm.id) as totalMessages',
                'SUM(CASE WHEN fv.voteType = :upvote THEN 1 ELSE 0 END) as totalUpvotes',
                'SUM(CASE WHEN fv.voteType = :downvote THEN 1 ELSE 0 END) as totalDownvotes'
            )
            ->leftJoin('fm.votes', 'fv')
            ->where('fm.discussion = :discussionId')
            ->setParameter('discussionId', $discussionId)
            ->setParameter('upvote', 'UPVOTE')
            ->setParameter('downvote', 'DOWNVOTE')
            ->getQuery()
            ->getSingleResult();

        return [
            'totalMessages' => (int) $result['totalMessages'],
            'totalUpvotes' => (int) ($result['totalUpvotes'] ?? 0),
            'totalDownvotes' => (int) ($result['totalDownvotes'] ?? 0),
        ];
    }
}
