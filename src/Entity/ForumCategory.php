<?php

namespace App\Entity;

use App\Repository\ForumCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ForumCategoryRepository::class)]
#[ORM\Table(name: 'forum_category')]
class ForumCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_forum_category', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'forum_category_name', length: 255)]
    #[Assert\NotBlank(message: 'Category name is required')]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Category name must be at least {{ limit }} characters long',
        maxMessage: 'Category name cannot exceed {{ limit }} characters'
    )]
    private ?string $name = null;

    #[ORM\Column(name: 'forum_category_description', type: 'text', nullable: true)]
    #[Assert\Length(
        max: 1000,
        maxMessage: 'Description cannot exceed {{ limit }} characters'
    )]
    private ?string $description = null;

    #[ORM\Column(name: 'forum_category_color', length: 7, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(name: 'forum_category_created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'forum_category_updated_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: ForumDiscussion::class, cascade: ['remove'])]
    private Collection $discussions;

    public function __construct()
    {
        $this->discussions = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection<int, ForumDiscussion>
     */
    public function getDiscussions(): Collection
    {
        return $this->discussions;
    }

    public function addDiscussion(ForumDiscussion $discussion): static
    {
        if (!$this->discussions->contains($discussion)) {
            $this->discussions->add($discussion);
            $discussion->setCategory($this);
        }
        return $this;
    }

    public function removeDiscussion(ForumDiscussion $discussion): static
    {
        if ($this->discussions->removeElement($discussion)) {
            if ($discussion->getCategory() === $this) {
                $discussion->setCategory(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    public function getDiscussionCount(): int
    {
        return $this->discussions->count();
    }
}
