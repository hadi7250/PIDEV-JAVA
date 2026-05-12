<?php

namespace App\Repository;

use App\Entity\ForumReport;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumReport>
 */
class ForumReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumReport::class);
    }

    /**
     * @return ForumReport[]
     */
    public function findPending(): array
    {
        return $this->createQueryBuilder('fr')
            ->where('fr.status = :status')
            ->setParameter('status', ForumReport::STATUS_PENDING)
            ->orderBy('fr.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumReport[]
     */
    public function findByStatus(string $status): array
    {
        return $this->createQueryBuilder('fr')
            ->where('fr.status = :status')
            ->setParameter('status', $status)
            ->orderBy('fr.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumReport[]
     */
    public function findByReporter(User $reporter): array
    {
        return $this->createQueryBuilder('fr')
            ->where('fr.reporter = :reporter')
            ->setParameter('reporter', $reporter)
            ->orderBy('fr.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countPending(): int
    {
        return (int) $this->createQueryBuilder('fr')
            ->select('COUNT(fr.id)')
            ->where('fr.status = :status')
            ->setParameter('status', ForumReport::STATUS_PENDING)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function hasUserReportedDiscussion(User $user, int $discussionId): bool
    {
        $result = $this->createQueryBuilder('fr')
            ->select('COUNT(fr.id)')
            ->where('fr.reporter = :user')
            ->andWhere('fr.discussion = :discussionId')
            ->andWhere('fr.type = :type')
            ->setParameter('user', $user)
            ->setParameter('discussionId', $discussionId)
            ->setParameter('type', ForumReport::TYPE_DISCUSSION)
            ->getQuery()
            ->getSingleScalarResult();

        return (int) $result > 0;
    }

    public function hasUserReportedMessage(User $user, int $messageId): bool
    {
        $result = $this->createQueryBuilder('fr')
            ->select('COUNT(fr.id)')
            ->where('fr.reporter = :user')
            ->andWhere('fr.message = :messageId')
            ->andWhere('fr.type = :type')
            ->setParameter('user', $user)
            ->setParameter('messageId', $messageId)
            ->setParameter('type', ForumReport::TYPE_MESSAGE)
            ->getQuery()
            ->getSingleScalarResult();

        return (int) $result > 0;
    }
}
