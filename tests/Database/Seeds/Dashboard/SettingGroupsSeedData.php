<?php

namespace tests\Database\Seeds\Dashboard;

use Components\Dashboard\Models\SettingGroup;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;

class SettingGroupsSeedData extends AbstractSeedData implements
    SeedDataInterface
{

    const BASE_SETTING_GROUP_ID = 1;

    const ALTERNATIVE_SETTING_GROUP =
        [
            "id" => 3,
            "name" => "test group 3",
            "description" => "this is an empty group",
            "priority" => 1,
            "is_active" => "1"
        ];

    public static function getData(): array
    {
        return
            [
                [
                    "id" => self::BASE_SETTING_GROUP_ID,
                    "name" => "test group",
                    "description" => "this is a group",
                    "priority" => 0,
                    "is_active" => "1"
                ],
                [
                    "id" => 2,
                    "name" => "test group 2",
                    "description" => "this is group 2",
                    "priority" => 2,
                    "is_active" => "1"
                ],
                [
                    "id" => 3,
                    "name" => "test group 3",
                    "description" => "this is an empty group",
                    "priority" => 1,
                    "is_active" => "1"
                ]
            ];
    }


    public function getClass()
    {
        return new SettingGroup();
    }
}

