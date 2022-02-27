<?php

namespace Components\Dashboard\Services;

use Components\Dashboard\Models\SettingGroup;
use Components\Dashboard\Services\Contracts\SettingGroupsServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Pesedget\Database\Utils\ListResult;

class SettingGroupsService extends AbstractService implements SettingGroupsServiceInterface
{

    /**
     * @return ListResult
     */
    public function listAll(): ListResult
    {

        return new ListResult(SettingGroup::query()->count('id'), SettingGroup::query()->orderBy('priority')->get());
    }
}
