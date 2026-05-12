<?php

namespace App\Repository;

use App\Entity\ForumView;
use App\Entity\ForumDiscussion;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumView>
 */
class ForumViewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumView::class);
    }

    public function findByUserAndDiscussion(User $user, ForumDiscussion $discussion): ?ForumView
    {
        return $this->createQueryBuilder('fv')
            ->where('fv.user = :user')
            ->andWhere('fv.discussion = :discussion')
            ->setParameter('user', $user)
            ->setParameter('discussion', $discussion)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function hasUserViewed(User $user, ForumDiscussion $discussion): bool
    {
        return null !== $this->findByUserAndDiscussion($user, $discussion);
    }

    public function countByDiscussion(ForumDiscussion $discussion): int
    {
        return (int) $this->createQueryBuilder('fv')
            ->select('COUNT(fv.id)')
            ->where('fv.discussion = :discussion')
            ->setParameter('discussion', $discussion)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countUniqueViews(int $discussionId): int
    {
        return (int) $this->createQueryBuilder('fv')
            ->select('COUNT(DISTINCT fv.user)')
            ->where('fv.discussion = :discussionId')
            ->setParameter('discussionId', $discussionId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
