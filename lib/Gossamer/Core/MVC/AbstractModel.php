<?php

namespace Gossamer\Core\MVC;

use Gossamer\Core\MVC\Contracts\ModelInterface;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;

class AbstractModel extends Model implements ModelInterface
{
    use ContainerTrait;

    protected $dateFormat = 'Y/m/d H:i:s';

    protected $casts = ['id' => 'string'];
    protected static array $searchable = [];

    public static function getSearchParams(Builder $builder, string $queryParam) {
        foreach(static::$searchable as $key) {
            $builder->orWhere($key, 'like', '%' . $queryParam . '%');
        }
    }

    public static function getFilterParams(Builder $builder, array $params) {
        foreach($params as $key => $value) {
            $builder->where($key, '=', $value);
        }
    }

}
