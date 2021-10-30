<?php

namespace Components\Users\Services;

use ContextSeeds;
use PHPUnit\Framework\TestCase;

class UsersServiceTest extends TestCase
{
    public function testCanBeCreated() : void {
        $usersService = new UsersService();

        $user = $usersService->get(ContextSeeds::BASE_USER_ID);

        $this->assertNotNull($user);
        $this->assertEquals($user->getId(), ContextSeeds::BASE_USER_ID);
    }
}