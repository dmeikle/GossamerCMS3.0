<?php

namespace tests\integration\Components\Blogs\Services;

use Components\Blogs\DTOs\BlogDTO;
use tests\Database\Seeds\Blogs\BlogCategoriesSeedData;
use tests\Database\Seeds\Blogs\BlogsSeedData;
use tests\Database\Seeds\Users\UsersSeedData;
use tests\helpers\TestCase;

class BlogsServiceTest extends TestCase
{
    const SERVICE_NAME = 'Components\Blogs\Services\BlogsService';

    public function testListAll() {
        $service = $this->getService(self::SERVICE_NAME);

        $list = $service->list(0, 10, array('query' => 'qwe'));
$this->generate($list->getList());
        $this->assertNotNull($list);
        $this->assertJsonEqualsIgnoreDates( $list->getList());
    }

    public function testGet() {
        $service = $this->getService(self::SERVICE_NAME);

        $item = $service->get(BlogsSeedData::BLOG_BASE_ID);

        $this->assertNotNull($item);
        $this->assertJsonEqualsIgnoreDates( $item);
    }

    public function testGetBySlug() {
        $service = $this->getService(self::SERVICE_NAME);

        $item = $service->getBySlug(BlogsSeedData::BLOG_SLUG);

        $this->assertNotNull($item);
        $this->assertJsonEqualsIgnoreDates( $item);
    }

    public function testSaveBlog() {

        $blog = $this->getService(self::SERVICE_NAME)->save(
            new BlogDTO(
                null,
                'phpunit recipe',
                'description here',
                'contents here',
                'phpunit',
                'unit test',
                BlogCategoriesSeedData::BLOG_CATEGORIES_BASE_ID
            ), UsersSeedData::BASE_USER_ID
        );

        $this->assertEquals($blog->title, 'phpunit recipe');
    }

}
