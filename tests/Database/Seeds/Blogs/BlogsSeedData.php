<?php

namespace tests\Database\Seeds\Blogs;

use Components\Blogs\Models\Blog;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;

class BlogsSeedData extends AbstractSeedData implements SeedDataInterface
{
    const BLOG_BASE_ID = "967b87ee-6823-4429-8849-d9fd78b5c09a";

    const BLOG_RECIPE_ID = "83eb7764-01bd-4ebc-86a7-38e71a0c03da";

    const BLOG_SLUG = 'test';
    const BLOG_RECIPE_SLUG = 'recipe';

    public static function getData(): array
    {
        return
            [
                [
                    "id" => self::BLOG_BASE_ID,
                    "created_at" => self::getDatetime(),
                    "updated_at" => self::getDatetime(),
                    "created_by" => "123",
                    "updated_by" => "123",
                    "deleted_at" => null,
                    "title" => "blog test title 1",
                    "description" => "blog test description 1",
                    "contents" => "Blog test contents 1",
                    "slug" => self::BLOG_SLUG,
                    "keywords" => "test",
                    "blog_categories_id" => BlogCategoriesSeedData::BLOG_CATEGORIES_BASE_ID
                ],
                [
                    "id" => self::BLOG_RECIPE_ID,
                    "created_at" => self::getDatetime(),
                    "updated_at" => self::getDatetime(),
                    "created_by" => "123",
                    "updated_by" => "123",
                    "deleted_at" => null,
                    "title" => "blog recipe title 1",
                    "description" => "blog recipe description 1",
                    "contents" => "Blog recipe contents 1",
                    "slug" => self::BLOG_RECIPE_SLUG,
                    "keywords" => "test",
                    "blog_categories_id" => BlogCategoriesSeedData::BLOG_CATEGORIES_BASE_ID
                ]
            ];
    }

    public function getClass()
    {
        return new Blog();
    }
}
