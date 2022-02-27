<?php

namespace Components\Blogs\Services\Contracts;

use Components\Blogs\DTOs\BlogDTO;
use Components\Blogs\Models\Blog;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface BlogsServiceInterface
{
    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function save(BlogDTO $blog, string $userId): Blog;

    public function get(string $id) : Blog;

    public function getBySlug(string $slug) : Blog;




}
