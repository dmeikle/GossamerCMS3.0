<?php

namespace Gossamer\Core\MVC;

use Gossamer\Core\MVC\Contracts\ModelInterface;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use Illuminate\Database\Eloquent\Model;

class AbstractModel extends Model implements ModelInterface
{
    use ContainerTrait;
}