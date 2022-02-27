<?php

namespace Gossamer\Core\Views;

use Gossamer\Core\MVC\Contracts\ViewInterface;
use Gossamer\Core\Util\JsonMapper;
use Gossamer\Set\Utils\Traits\ContainerTrait;

class JsonView implements ViewInterface
{
    use ContainerTrait;

    public function render($data)
    {
        return JsonMapper::toJson($data);
    }
}
