<?php

namespace tests\integration\Extensions\Recipes\Services;

use tests\Database\Seeds\Recipes\RecipeCategoriesSeedData;
use tests\helpers\TestCase;

class RecipeCategoriesServiceTest extends TestCase
{
    const SERVICE_NAME = 'Extensions\Recipes\Services\RecipeCategoriesService';

    public function testListAll() {
        $service = $this->getService(self::SERVICE_NAME);

        $list = $service->list(0, 10, array());

        $this->assertNotNull($list);
        $this->assertJsonEqualsIgnoreDates( $list->getList());
    }

    public function testGetCategory() {
        $service = $this->getService(self::SERVICE_NAME);

        $item = $service->get(RecipeCategoriesSeedData::BASE_CATEGORY_ID);

        $this->assertNotNull($item);
        $this->assertEquals($item->id, RecipeCategoriesSeedData::BASE_CATEGORY_ID);
    }

//    public function testSaveCategory() {
//        $service = $this->getService(self::SERVICE_NAME);
//
//        $item = $service->save(RecipeCategoriesSeedData::BASE_CATEGORY_ID);
//
//        $this->assertNotNull($item);
//        $this->assertEquals($item->id, RecipeCategoriesSeedData::BASE_CATEGORY_ID);
//    }
}
