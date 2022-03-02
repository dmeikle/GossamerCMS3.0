<?php

namespace tests\integration\Components\Blogs\Services;

use Components\Blogs\DTOs\SaveBlogCommentDTO;
use Components\Blogs\Exceptions\CommentsDisallowedException;
use Components\Blogs\Models\Blog;
use tests\Database\Seeds\Blogs\BlogCommentsSeedData;
use tests\Database\Seeds\Blogs\BlogsSeedData;
use tests\Database\Seeds\Users\UsersSeedData;
use tests\helpers\TestCase;

class BlogCommentsServiceTest extends TestCase
{

    const SERVICE_NAME = 'Components\\Blogs\\Services\\BlogCommentsService';


    public function testListCommentsByBlog() {
        $service = $this->getService(self::SERVICE_NAME);

        $list = $service->listByBlog(0,10, BlogsSeedData::BLOG_BASE_ID);

        $this->assertNotNull($list->getList());
        $this->assertJsonEqualsIgnoreDates($list->getList());
    }

    public function testSaveComment() {
        $service = $this->getService(self::SERVICE_NAME);

        $item = $service->save(
            new SaveBlogCommentDTO(
                BlogsSeedData::BLOG_BASE_ID,
                'this is a test comment',
                UsersSeedData::BASE_USER_ID
            ),
            new Blog(BlogsSeedData::getAllowedBlog()),
            UsersSeedData::BASE_USER_ID
        );

        $this->assertNotNull($item);
        $this->assertJsonEqualsIgnoreDates($item);
    }

    public function testSaveDisallowedComment_shouldThrowException() {
        $service = $this->getService(self::SERVICE_NAME);

        try {
            $service->save(
                new SaveBlogCommentDTO(
                    BlogsSeedData::BLOG_COMMENTS_OFF_ID,
                    'this is a disallowed test comment',
                    UsersSeedData::BASE_USER_ID
                ),
                new Blog(BlogsSeedData::getDisallowedBlog()),
                UsersSeedData::BASE_USER_ID
            );
            $this->fail('Expected CommentsDisallowedException');
        }catch (\Exception $e) {
            $this->assertTrue($e instanceof CommentsDisallowedException);
        }
    }
}
