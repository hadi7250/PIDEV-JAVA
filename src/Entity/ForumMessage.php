<?php

namespace App\Entity;

use App\Repository\ForumMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumMessageRepository::class)]
#[ORM\Table(name: 'forum_message')]
class ForumMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_forum_message', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private ?string $content = null;

    #[ORM\Column(name: 'author_name', length: 255)]
    private ?string $authorName = null;

    #[ORM\Column(name: 'discussion_id', type: 'integer')]
    private ?int $discussionId = null;

    #[ORM\ManyToOne(targetEntity: ForumDiscussion::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(name: 'discussion_id', referencedColumnName: 'id_forum_discussion', nullable: false)]
    private ?ForumDiscussion $discussion = null;

    #[ORM\Column(name: 'parent_message_id', type: 'integer', nullable: true)]
    private ?int $parentMessageId = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'parent_message_id', referencedColumnName: 'id_forum_message', onDelete: 'CASCADE')]
    private ?ForumMessage $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class, cascade: ['remove'])]
    private Collection $replies;

    #[ORM\OneToMany(mappedBy: 'message', targetEntity: ForumVote::class, cascade: ['remove'])]
    private Collection $votes;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->replies = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;
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

    public function getDiscussionId(): ?int
    {
        return $this->discussionId;
    }

    public function setDiscussionId(int $discussionId): static
    {
        $this->discussionId = $discussionId;
        return $this;
    }

    public function getDiscussion(): ?ForumDiscussion
    {
        return $this->discussion;
    }

    public function setDiscussion(?ForumDiscussion $discussion): static
    {
        $this->discussion = $discussion;
        if ($discussion) {
            $this->discussionId = $discussion->getId();
        }
        return $this;
    }

    public function getParentMessageId(): ?int
    {
        return $this->parentMessageId;
    }

    public function setParentMessageId(?int $parentMessageId): static
    {
        $this->parentMessageId = $parentMessageId;
        return $this;
    }

    public function getParent(): ?ForumMessage
    {
        return $this->parent;
    }

    public function setParent(?ForumMessage $parent): static
    {
        $this->parent = $parent;
        if ($parent) {
            $this->parentMessageId = $parent->getId();
        }
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

    /**
     * @return Collection<int, ForumMessage>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(ForumMessage $reply): static
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
            $reply->setParent($this);
        }
        return $this;
    }

    public function removeReply(ForumMessage $reply): static
    {
        if ($this->replies->removeElement($reply)) {
            if ($reply->getParent() === $this) {
                $reply->setParent(null);
            }
        }
        return $this;
    }

    public function isReply(): bool
    {
        return $this->parent !== null;
    }

    public function hasReplies(): bool
    {
        return !$this->replies->isEmpty();
    }

    public function getReplyCount(): int
    {
        return $this->replies->count();
    }

    /**
     * @return Collection<int, ForumVote>
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function getUpvoteCount(): int
    {
        return $this->votes->filter(fn(ForumVote $v) => $v->getVoteType() === ForumVote::TYPE_UPVOTE)->count();
    }

    public function getDownvoteCount(): int
    {
        return $this->votes->filter(fn(ForumVote $v) => $v->getVoteType() === ForumVote::TYPE_DOWNVOTE)->count();
    }

    public function getScore(): int
    {
        return $this->getUpvoteCount() - $this->getDownvoteCount();
    }

    public function getUserVote(User $user): ?ForumVote
    {
        foreach ($this->votes as $vote) {
            if ($vote->getUser() === $user) {
                return $vote;
            }
        }
        return null;
    }

    /**
     * @return Collection<int, ForumReport>
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function __toString(): string
    {
        return substr($this->content ?? '', 0, 50) . '...';
    }
}
