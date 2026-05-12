<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ORM\Table(name: 'notifications')]
class Notification
{
    public const TYPE_REPLY_TO_DISCUSSION = 'REPLY_TO_DISCUSSION';
    public const TYPE_REPLY_TO_MESSAGE = 'REPLY_TO_MESSAGE';
    public const TYPE_DISCUSSION_SOLVED = 'DISCUSSION_SOLVED';
    public const TYPE_DISCUSSION_LOCKED = 'DISCUSSION_LOCKED';
    public const TYPE_MESSAGE_UPVOTE = 'MESSAGE_UPVOTE';
    public const TYPE_REPORT_RESOLVED = 'REPORT_RESOLVED';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Notification type is required')]
    private ?string $type = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Message is required')]
    private ?string $message = null;

    #[ORM\ManyToOne(targetEntity: ForumDiscussion::class)]
    #[ORM\JoinColumn(name: 'discussion_id', referencedColumnName: 'id_forum_discussion', nullable: true)]
    private ?ForumDiscussion $relatedDiscussion = null;

    #[ORM\ManyToOne(targetEntity: ForumMessage::class)]
    #[ORM\JoinColumn(name: 'message_id', referencedColumnName: 'id_forum_message', nullable: true)]
    private ?ForumMessage $relatedMessage = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'is_read')]
    private bool $isRead = false;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function getRelatedDiscussion(): ?ForumDiscussion
    {
        return $this->relatedDiscussion;
    }

    public function setRelatedDiscussion(?ForumDiscussion $relatedDiscussion): static
    {
        $this->relatedDiscussion = $relatedDiscussion;
        return $this;
    }

    public function getRelatedMessage(): ?ForumMessage
    {
        return $this->relatedMessage;
    }

    public function setRelatedMessage(?ForumMessage $relatedMessage): static
    {
        $this->relatedMessage = $relatedMessage;
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

    public function isRead(): bool
    {
        return $this->isRead;
    }

    public function setRead(bool $isRead): static
    {
        $this->isRead = $isRead;
        return $this;
    }

    public function markAsRead(): static
    {
        $this->isRead = true;
        return $this;
    }

    public function markAsUnread(): static
    {
        $this->isRead = false;
        return $this;
    }

    public function getFormattedMessage(): string
    {
        return match($this->type) {
            self::TYPE_REPLY_TO_DISCUSSION => sprintf(
                'New reply to your discussion: "%s"',
                $this->relatedDiscussion?->getTitle() ?? 'Unknown Discussion'
            ),
            self::TYPE_REPLY_TO_MESSAGE => sprintf(
                'Someone replied to your message in: "%s"',
                $this->relatedDiscussion?->getTitle() ?? 'Unknown Discussion'
            ),
            self::TYPE_DISCUSSION_SOLVED => sprintf(
                'Your discussion was marked as solved: "%s"',
                $this->relatedDiscussion?->getTitle() ?? 'Unknown Discussion'
            ),
            self::TYPE_DISCUSSION_LOCKED => sprintf(
                'Your discussion was locked: "%s"',
                $this->relatedDiscussion?->getTitle() ?? 'Unknown Discussion'
            ),
            self::TYPE_MESSAGE_UPVOTE => sprintf(
                'Your message received an upvote in: "%s"',
                $this->relatedDiscussion?->getTitle() ?? 'Unknown Discussion'
            ),
            self::TYPE_REPORT_RESOLVED => sprintf(
                'Your report has been resolved: "%s"',
                $this->relatedDiscussion?->getTitle() ?? 'Unknown'
            ),
            default => $this->message,
        };
    }

    public function getActionUrl(): ?string
    {
        if ($this->relatedDiscussion) {
            return '/forum/discussion/' . $this->relatedDiscussion->getId();
        }
        return null;
    }

    public function __toString(): string
    {
        return $this->getFormattedMessage();
    }
}
