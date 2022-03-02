<?php

namespace tests\Database\Seeds\Users;

use Components\Users\Models\User;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;

class UsersSeedData extends AbstractSeedData implements SeedDataInterface
{
    const BASE_USER_ID = '0C30457D-50F0-DE6F-C734-5E36231F022C';

    const ALTERNATE_USER_ID = "A8AAE570-4B9A-C70E-1668-0667F79F6C5E";

    public static function getUsers()
    {
        return
            [
                [
                    "id" => self::BASE_USER_ID,
                    "firstname" => "david",
                    "lastname" => 'Meikle',
                    "updated_at" => self::getDatetime(),
                    "created_at" => self::getDatetime()
                ],
                [
                    "id" => self::ALTERNATE_USER_ID,
                    "firstname" => "david2",
                    "lastname" => "Smith",
                    "updated_at" => self::getDatetime(),
                    "created_at" => self::getDatetime()
                ],
                [
                    "id" => "D884CFEF-E1BF-8A3A-4C33-9F35F22DE52B",
                    "firstname" => "david2",
                    "lastname" => "Jones",
                    "updated_at" => self::getDatetime(),
                    "created_at" => self::getDatetime()
                ],
                [
                    "id" => "ECE6718A-5077-EE2A-9809-DCDFF1E5035D",
                    "firstname" => "david2",
                    "lastname" => "Doe",
                    "updated_at" => self::getDatetime(),
                    "created_at" => self::getDatetime()
                ]
            ];
    }

    public static function getData(): array
    {
        return self::getUsers();
    }

    public function getClass()
    {
        return new User();
    }

    public static function getUser() : array {
        return
            [
                "id" => "8bb73a53-3238-4773-baf8-1b3c423fcc1b",
                "firstname" => "testname",
                "lastname" => 'test lastname',
                "updated_at" => self::getDatetime(),
                "created_at" => self::getDatetime()
            ];
    }
}
