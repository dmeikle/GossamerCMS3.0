<?php

namespace tests\Database\Seeds\Blogs;

use Components\Blogs\Models\BlogComment;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;
use tests\Database\Seeds\Users\UsersSeedData;

class BlogCommentsSeedData extends AbstractSeedData implements SeedDataInterface
{
    const BASE_BLOG_COMMENT_ID = "EE6D9A99-E5D5-0CE9-9D9B-8A441FDA946A";

    public static function getData(): array
    {
        return
            [
                [
                    "id" => self::BASE_BLOG_COMMENT_ID,
                    "blogs_id" => BlogsSeedData::BLOG_BASE_ID,
                    "created_at" => self::getDatetime(),
                    "created_by" => UsersSeedData::BASE_USER_ID,
                    "deleted_at" => null,
                    "updated_at" => self::getDatetime(),
                    "updated_by" => UsersSeedData::BASE_USER_ID,
                    "comment" => "this is a test comment"
                ]
            ];
    }

    public function getClass()
    {
        return new BlogComment();
    }
}
