<?php

namespace App\Repository;

use App\Entity\ForumDiscussion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumDiscussion>
 */
class ForumDiscussionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumDiscussion::class);
    }

    /**
     * @return ForumDiscussion[] Returns an array of ForumDiscussion objects
     */
    public function findByCategory(int $categoryId): array
    {
        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.messages', 'fm')
            ->groupBy('fd.id')
            ->where('fd.category = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->orderBy('fd.isPinned', 'DESC')
            ->addOrderBy('fd.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumDiscussion[] Returns an array of recent ForumDiscussion objects
     */
    public function findRecent(int $limit = 10): array
    {
        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.category', 'fc')
            ->orderBy('fd.updatedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumDiscussion[] Returns an array of ForumDiscussion objects by author name
     */
    public function findByAuthorName(string $authorName): array
    {
        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.category', 'fc')
            ->where('fd.authorName = :authorName')
            ->setParameter('authorName', $authorName)
            ->orderBy('fd.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return ForumDiscussion[] Returns an array of most active ForumDiscussion objects
     */
    public function findMostActive(int $limit = 10): array
    {
        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.messages', 'fm')
            ->leftJoin('fd.category', 'fc')
            ->addSelect('fc', 'COUNT(fm.id) as messageCount')
            ->groupBy('fd.id')
            ->orderBy('messageCount', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find most viewed discussion today
     */
    public function findMostViewedToday(): ?ForumDiscussion
    {
        $today = new \DateTimeImmutable('today midnight');

        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.viewsCollection', 'fv')
            ->leftJoin('fd.category', 'fc')
            ->where('fd.createdAt >= :today')
            ->setParameter('today', $today)
            ->groupBy('fd.id')
            ->orderBy('COUNT(fv.user)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Find most discussed discussion today
     */
    public function findMostDiscussedToday(): ?ForumDiscussion
    {
        $today = new \DateTime('today midnight');

        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.messages', 'fm')
            ->leftJoin('fd.category', 'fc')
            ->where('fd.createdAt >= :today')
            ->groupBy('fd.id')
            ->orderBy('COUNT(fm.id)', 'DESC')
            ->setParameter('today', $today)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Find top viewed discussions overall
     * @return ForumDiscussion[]
     */
    public function findTopViewedOverall(int $limit = 5): array
    {
        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.viewsCollection', 'fv')
            ->leftJoin('fd.category', 'fc')
            ->groupBy('fd.id')
            ->orderBy('COUNT(fv.user)', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Search discussions by title or content
     * @return ForumDiscussion[]
     */
    public function search(string $query): array
    {
        return $this->createQueryBuilder('fd')
            ->leftJoin('fd.category', 'fc')
            ->where('fd.title LIKE :query')
            ->orWhere('fd.content LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('fd.isPinned', 'DESC')
            ->addOrderBy('fd.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find pinned discussions
     * @return ForumDiscussion[]
     */
    public function findPinned(): array
    {
        return $this->createQueryBuilder('fd')
            ->where('fd.isPinned = true')
            ->orderBy('fd.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find solved discussions
     * @return ForumDiscussion[]
     */
    public function findSolved(int $limit = 10): array
    {
        return $this->createQueryBuilder('fd')
            ->where('fd.isSolved = true')
            ->orderBy('fd.updatedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
