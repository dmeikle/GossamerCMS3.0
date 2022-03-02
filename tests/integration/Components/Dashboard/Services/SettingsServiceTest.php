<?php

namespace tests\integration\Components\Dashboard\Services;

use Components\Dashboard\DTOs\SettingDTO;
use Components\Dashboard\Models\SettingGroup;
use tests\Database\Seeds\Dashboard\SettingGroupsSeedData;
use tests\Database\Seeds\Dashboard\SettingsSeedData;
use tests\Database\Seeds\Users\UsersSeedData;
use tests\helpers\TestCase;

class SettingsServiceTest extends TestCase
{
    const SERVICE_NAME = 'Components\Dashboard\Services\SettingsService';

    public function testListAll() {
        $service = $this->getService(self::SERVICE_NAME);

        $list = $service->list(0, 10, array());

        $this->assertNotNull($list);
        $this->assertJsonEqualsIgnoreDates( $list->getList());
    }

    public function testListAllByGroup() {
        $service = $this->getService(self::SERVICE_NAME);

        $list = $service->listAllByGroups(0, 10);

        $this->assertNotNull($list);
        $this->assertJsonEqualsIgnoreDates( $list->getList());
    }

    public function testGetSetting() {
        $service = $this->getService(self::SERVICE_NAME);

        $item = $service->get(SettingsSeedData::BASE_SETTING_ID);

        $this->assertNotNull($item);
        $this->assertJsonEqualsIgnoreDates( $item);
    }

    public function testSaveSetting() {
        $service = $this->getService(self::SERVICE_NAME);

        $item = $service->save(
            new SettingDTO(
                SettingsSeedData::ALTERNATE_SETTING_ID,
                SettingGroupsSeedData::BASE_SETTING_GROUP_ID,
                'phpunit test',
                'php unit test description',
                5,
                1,
                'this is a value',
                'phpunit_test'
            ),
            new SettingGroup(SettingGroupsSeedData::ALTERNATIVE_SETTING_GROUP)
        );

        $this->assertNotNull($item);
        $this->assertJsonEqualsIgnoreDates( $item);
    }
}
