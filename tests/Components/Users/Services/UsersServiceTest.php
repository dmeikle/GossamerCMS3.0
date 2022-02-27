<?php

namespace Components\Users\Services;

use Components\Users\DTOs\UserDTO;
use tests\Database\Seeds\Users\UsersSeedData;
use tests\helpers\TestCase;

class UsersServiceTest extends TestCase
{
    const SERVICE_NAME = 'Components\Users\Services\UsersService';
    /**
     * @return void
     */
    public function testGetSingle() : void {
        $usersService = $this->getService(self::SERVICE_NAME);

        $user = $usersService->get(UsersSeedData::BASE_USER_ID);

        $this->assertNotNull($user);
        $this->assertEquals($user->id, UsersSeedData::BASE_USER_ID);
    }

    /**
     * @return void
     */
    public function testListAll() : void {
        $usersService = $this->getService(self::SERVICE_NAME);

        $users = $usersService->list(0,10);

        $this->assertNotNull($users);
        $this->assertEquals(count($users->getList()), count(UsersSeedData::getUsers()));
        $this->assertJsonEqualsIgnoreDates($users->getList());
    }

    /**
     * @return void
     */
    public function testSave() : void {
        $usersService = $this->getService(self::SERVICE_NAME);
        $userBefore = UsersSeedData::getUser();
        $userAfter = $usersService->save(new UserDTO(
            $userBefore['id'],
            $userBefore['firstname'],
            $userBefore['lastname'],
            $userBefore['created_at']
        ));

        $this->assertNotNull($userAfter);
        $this->assertEquals($userAfter->firstname, $userBefore['firstname']);
    }
}
