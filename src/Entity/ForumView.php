<?php

namespace App\Entity;

use App\Repository\ForumViewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumViewRepository::class)]
#[ORM\Table(name: 'forum_views')]
class ForumView
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: ForumDiscussion::class, inversedBy: 'viewsCollection')]
    #[ORM\JoinColumn(name: 'discussion_id', referencedColumnName: 'id_forum_discussion', nullable: false)]
    private ?ForumDiscussion $discussion = null;

    #[ORM\Column(name: 'viewed_at', type: 'datetime')]
    private ?\DateTimeInterface $viewedAt = null;

    public function __construct()
    {
        $this->viewedAt = new \DateTime();
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

    public function getDiscussion(): ?ForumDiscussion
    {
        return $this->discussion;
    }

    public function setDiscussion(?ForumDiscussion $discussion): static
    {
        $this->discussion = $discussion;
        return $this;
    }

    public function getViewedAt(): ?\DateTimeInterface
    {
        return $this->viewedAt;
    }

    public function setViewedAt(\DateTimeInterface $viewedAt): static
    {
        $this->viewedAt = $viewedAt;
        return $this;
    }
}
