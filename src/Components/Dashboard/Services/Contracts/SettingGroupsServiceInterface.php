<?php

namespace Components\Dashboard\Services\Contracts;

use Gossamer\Pesedget\Database\Utils\ListResult;

interface SettingGroupsServiceInterface
{
    public function listAll() : ListResult;
}
