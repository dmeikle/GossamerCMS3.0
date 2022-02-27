<?php

namespace tests\Database\Seeds\Blogs;

use Components\Blogs\Models\BlogCategory;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;

class BlogCategoriesSeedData extends AbstractSeedData implements
    SeedDataInterface
{

    const BLOG_CATEGORIES_BASE_ID = 1;

    public static function getData(): array
    {
        return
            [
                [
                    "id" => self::BLOG_CATEGORIES_BASE_ID,
                    "category" => "test category 1",
                    "description" => "test"
                ]
            ];
    }

    public function getClass()
    {
        return new BlogCategory();
    }
}
