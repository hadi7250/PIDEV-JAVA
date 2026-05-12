<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCanBeCreated(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setName('Test User');

        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertEquals('Test User', $user->getName());
    }

    public function testUserStatus(): void
    {
        $user = new User();
        $user->setStatus('active');

        $this->assertEquals('active', $user->getStatus());
    }
}