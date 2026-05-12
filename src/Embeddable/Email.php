<?php

namespace App\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Embeddable]
class Email
{
    #[ORM\Column(length: 180, unique: true, name: 'email')]
    #[Assert\Email]
    #[Assert\Length(max: 180)]
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getDomain(): string
    {
        return substr($this->email, strrpos($this->email, '@') + 1);
    }

    public function getLocalPart(): string
    {
        return substr($this->email, 0, strrpos($this->email, '@'));
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
