<?php

namespace App\Repository;

use App\Entity\ForumCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumCategory>
 */
class ForumCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumCategory::class);
    }

    /**
     * @return array Returns an array of category data with discussion counts
     */
    public function findAllWithDiscussionCount(): array
    {
        $sql = 'SELECT c.id_forum_category,
                       c.forum_category_name,
                       c.forum_category_description,
                       c.forum_category_color,
                       c.forum_category_created_at,
                       c.forum_category_updated_at,
                       COUNT(d.id_forum_discussion) AS discussion_count
                FROM forum_category c
                LEFT JOIN forum_discussion d ON c.id_forum_category = d.id_forum_category
                GROUP BY c.id_forum_category
                ORDER BY c.forum_category_name ASC';

        $stmt = $this->getEntityManager()->getConnection()->executeQuery($sql);
        $results = $stmt->fetchAllAssociative();

        $categories = [];
        foreach ($results as $row) {
            $categories[] = [
                'id' => $row['id_forum_category'],
                'name' => $row['forum_category_name'],
                'description' => $row['forum_category_description'],
                'color' => $row['forum_category_color'],
                'createdAt' => $row['forum_category_created_at'],
                'updatedAt' => $row['forum_category_updated_at'],
                'discussionCount' => (int)$row['discussion_count'],
            ];
        }

        return $categories;
    }

    /**
     * Find all categories ordered by name
     * @return ForumCategory[]
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('fc')
            ->orderBy('fc.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find category by name
     */
    public function findByName(string $name): ?ForumCategory
    {
        return $this->createQueryBuilder('fc')
            ->where('fc.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
