<?php

namespace Components\Blogs\Http\Requests;

use Gossamer\Core\Http\Requests\GetRequest;

class IndexRequest extends GetRequest
{
    public function getParameters(): array
    {
        return [
            'offset' => $this->offset,
            'limit' => $this->limit,
            'search' => $this->search,
            'title' => $this->title
        ];
    }
}
