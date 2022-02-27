<?php

namespace Components\Blogs\Http\Requests;

use Components\Blogs\DTOs\BlogDTO;
use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\PostRequest;

class SaveBlogRequest extends PostRequest
{

    public function post(): DTOInterface
    {
        return new BlogDTO(
            $this->id,
            $this->title,
            $this->contents,
            $this->slug,
            $this->keywords,
            $this->blogs_categories_id
        );
    }
}
