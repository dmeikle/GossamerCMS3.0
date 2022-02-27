<?php

namespace Components\Blogs\Services;

use Components\Blogs\DTOs\BlogDTO;
use Components\Blogs\Models\Blog;
use Components\Blogs\Services\Contracts\BlogsServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Pesedget\Database\Utils\ListResult;

class BlogsService extends AbstractService implements BlogsServiceInterface
{

    public function list(int $offset, int $limit, array $searchParams) : ListResult
    {
        $query = Blog::query();

        Blog::getSearchParams($query, $searchParams['search'] ?? '');

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }

    public function save(BlogDTO $blogDTO, string $userId): Blog
    {
        $id = $this->getKey($blogDTO);

        $blog = Blog::updateOrCreate(
            [
                'id' => $id,
                'created_at' => time(),
                'updated_at' => time(),
                'created_by' => $userId,
                'updated_by' => $userId,
                'title' => $blogDTO->getTitle(),
                'description' => $blogDTO->getDescription(),
                'contents' => $blogDTO->getContents(),
                'keywords' => $blogDTO->getKeywords(),
                'slug' => $blogDTO->getSlug(),
                'blog_categories_id' => $blogDTO->getBlogCategoriesId()
            ]
        );
        //need to add this manually since the returned value from save
        //is not set by eloquent
        $blog->id = $id;

        return $blog;
    }

    public function getBySlug(string $slug): Blog
    {
        return Blog::where('slug', $slug)->first();
    }

    public function get(string $id): Blog
    {
        return Blog::where('id', $id)->first();
    }
}
