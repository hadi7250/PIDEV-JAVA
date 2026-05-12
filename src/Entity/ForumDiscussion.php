<?php

namespace App\Entity;

use App\Repository\ForumDiscussionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumDiscussionRepository::class)]
#[ORM\Table(name: 'forum_discussion')]
class ForumDiscussion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_forum_discussion', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'forum_discussion_title', length: 255)]
    private ?string $title = null;

    #[ORM\Column(name: 'forum_discussion_content', type: 'text')]
    private ?string $content = null;

    #[ORM\Column(name: 'forum_discussion_author_name', length: 255)]
    private ?string $authorName = null;

    #[ORM\Column(name: 'forum_discussion_is_pinned', type: 'boolean', options: ['default' => 0])]
    private bool $isPinned = false;

    #[ORM\Column(name: 'forum_discussion_is_locked', type: 'boolean', options: ['default' => 0])]
    private bool $isLocked = false;

    #[ORM\Column(name: 'forum_discussion_views', type: 'integer', options: ['default' => 0])]
    private int $views = 0;

    #[ORM\Column(name: 'forum_discussion_created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'forum_discussion_updated_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(name: 'solved', type: 'boolean', options: ['default' => 0])]
    private bool $solved = false;

    #[ORM\ManyToOne(targetEntity: ForumCategory::class, inversedBy: 'discussions')]
    #[ORM\JoinColumn(name: 'id_forum_category', referencedColumnName: 'id_forum_category', nullable: true, onDelete: 'SET NULL')]
    private ?ForumCategory $category = null;

    #[ORM\OneToMany(mappedBy: 'discussion', targetEntity: ForumMessage::class, cascade: ['remove'])]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'discussion', targetEntity: ForumView::class, cascade: ['remove'])]
    private Collection $viewsCollection;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->viewsCollection = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): static
    {
        $this->authorName = $authorName;
        return $this;
    }

    public function isPinned(): bool
    {
        return $this->isPinned;
    }

    public function setIsPinned(bool $isPinned): static
    {
        $this->isPinned = $isPinned;
        return $this;
    }

    public function isLocked(): bool
    {
        return $this->isLocked;
    }

    public function setIsLocked(bool $isLocked): static
    {
        $this->isLocked = $isLocked;
        return $this;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): static
    {
        $this->views = $views;
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

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function isSolved(): bool
    {
        return $this->solved;
    }

    public function setSolved(bool $solved): static
    {
        $this->solved = $solved;
        return $this;
    }

    public function getCategory(): ?ForumCategory
    {
        return $this->category;
    }

    public function setCategory(?ForumCategory $category): static
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Collection<int, ForumMessage>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(ForumMessage $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setDiscussion($this);
        }
        return $this;
    }

    public function removeMessage(ForumMessage $message): static
    {
        if ($this->messages->removeElement($message)) {
            if ($message->getDiscussion() === $this) {
                $message->setDiscussion(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, ForumView>
     */
    public function getViewsCollection(): Collection
    {
        return $this->viewsCollection;
    }

    public function addView(ForumView $view): static
    {
        if (!$this->viewsCollection->contains($view)) {
            $this->viewsCollection->add($view);
            $view->setDiscussion($this);
        }
        return $this;
    }

    public function removeView(ForumView $view): static
    {
        if ($this->viewsCollection->removeElement($view)) {
            if ($view->getDiscussion() === $this) {
                $view->setDiscussion(null);
            }
        }
        return $this;
    }

    public function getMessageCount(): int
    {
        return $this->messages->count();
    }

    public function __toString(): string
    {
        return $this->title ?? 'New Discussion';
    }
}
