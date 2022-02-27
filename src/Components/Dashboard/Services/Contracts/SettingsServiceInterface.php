<?php

namespace Components\Dashboard\Services\Contracts;

use Components\Dashboard\DTOs\SettingDTO;
use Components\Dashboard\Models\Setting;
use Components\Dashboard\Models\SettingGroup;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface SettingsServiceInterface
{
    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function save(SettingDTO $setting, SettingGroup $settingGroup) : Setting;

    public function get(string $id) : Setting;

    public function listAllByGroups(int $offset, int $limit) : ListResult;
}
