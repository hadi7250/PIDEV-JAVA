<?php

namespace App\Repository;

use App\Entity\ForumVote;
use App\Entity\ForumMessage;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumVote>
 */
class ForumVoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumVote::class);
    }

    public function findByUserAndMessage(User $user, ForumMessage $message): ?ForumVote
    {
        return $this->createQueryBuilder('fv')
            ->where('fv.user = :user')
            ->andWhere('fv.message = :message')
            ->setParameter('user', $user)
            ->setParameter('message', $message)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByMessage(ForumMessage $message): array
    {
        return $this->createQueryBuilder('fv')
            ->where('fv.message = :message')
            ->setParameter('message', $message)
            ->getQuery()
            ->getResult();
    }

    public function countUpvotes(ForumMessage $message): int
    {
        return (int) $this->createQueryBuilder('fv')
            ->select('COUNT(fv.id)')
            ->where('fv.message = :message')
            ->andWhere('fv.voteType = :type')
            ->setParameter('message', $message)
            ->setParameter('type', ForumVote::TYPE_UPVOTE)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countDownvotes(ForumMessage $message): int
    {
        return (int) $this->createQueryBuilder('fv')
            ->select('COUNT(fv.id)')
            ->where('fv.message = :message')
            ->andWhere('fv.voteType = :type')
            ->setParameter('message', $message)
            ->setParameter('type', ForumVote::TYPE_DOWNVOTE)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function hasUserVoted(User $user, ForumMessage $message): bool
    {
        return null !== $this->findByUserAndMessage($user, $message);
    }
}
