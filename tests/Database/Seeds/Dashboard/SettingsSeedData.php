<?php

namespace tests\Database\Seeds\Dashboard;

use Components\Dashboard\Models\Setting;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;

class SettingsSeedData extends AbstractSeedData implements SeedDataInterface
{
    const BASE_SETTING_ID = '255bffad-7689-4821-b53c-ace793319530';

    const ALTERNATE_SETTING_ID = '67879738-b833-48d4-b22f-23d86936dd3d';

    public static function getData(): array
    {
        return
            [
                [
                    'id' => self::BASE_SETTING_ID,
                    'setting_groups_id' => 1,
                    'description' => 'this is a setting',
                    'name' => 'test setting',
                    'key' => 'setting_1',
                    'value' => '1',
                    "priority" => 0,
                    'is_active' => true
                ],
                [
                    "id" => "39139906-eda7-476f-b328-bd61ebac7910",
                    "setting_groups_id" => 2,
                    "name" => "test setting 2b",
                    "description" => "group 2 item",
                    "priority" => 0,
                    "is_active" => "1",
                    "value" => "1",
                    "key" => "setting_2b"
                ],
                [
                    "id" => "b0539280-fa62-4e09-8f29-8b278dbda222",
                    "setting_groups_id" => 2,
                    "name" => "test setting 2c",
                    "description" => "group 2 item",
                    "priority" => 0,
                    "is_active" => "1",
                    "value" => "1",
                    "key" => "setting_2c"
                ],
                [
                    "id" => "da7bca27-6f89-4c81-918e-ab69b6d9661d",
                    "setting_groups_id" => 2,
                    "name" => "test setting 2",
                    "description" => "group 2 item",
                    "priority" => 0,
                    "is_active" => "1",
                    "value" => "1",
                    "key" => "setting_2"
                ]
            ];
    }

    public function getClass()
    {
        return new Setting();
    }
}
