<?php

namespace App\Entity;

use App\Repository\ForumVoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumVoteRepository::class)]
#[ORM\Table(name: 'forum_votes')]
#[ORM\UniqueConstraint(name: 'unique_user_message_vote', columns: ['user_id', 'message_id'])]
class ForumVote
{
    public const TYPE_UPVOTE = 'up';
    public const TYPE_DOWNVOTE = 'down';

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: ForumMessage::class, inversedBy: 'votes')]
    #[ORM\JoinColumn(name: 'message_id', referencedColumnName: 'id_forum_message', nullable: false)]
    private ?ForumMessage $message = null;

    #[ORM\Column(name: 'vote_type', type: 'string', length: 10)]
    private ?string $voteType = null;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getMessage(): ?ForumMessage
    {
        return $this->message;
    }

    public function setMessage(?ForumMessage $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function getVoteType(): ?string
    {
        return $this->voteType;
    }

    public function setVoteType(string $voteType): static
    {
        if (!in_array($voteType, [self::TYPE_UPVOTE, self::TYPE_DOWNVOTE])) {
            throw new \InvalidArgumentException('Invalid vote type');
        }
        $this->voteType = $voteType;
        return $this;
    }

    public function isUpvote(): bool
    {
        return $this->voteType === self::TYPE_UPVOTE;
    }

    public function isDownvote(): bool
    {
        return $this->voteType === self::TYPE_DOWNVOTE;
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
}
