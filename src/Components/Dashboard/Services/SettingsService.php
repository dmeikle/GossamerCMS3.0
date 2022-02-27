<?php

namespace Components\Dashboard\Services;

use Components\Dashboard\DTOs\SettingDTO;
use Components\Dashboard\Models\Setting;
use Components\Dashboard\Models\SettingGroup;
use Components\Dashboard\Services\Contracts\SettingGroupsServiceInterface;
use Components\Dashboard\Services\Contracts\SettingsServiceInterface;
use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Core\System\EntityManager;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Pesedget\Database\Utils\ListResult;
use Gossamer\Set\Utils\Container;

class SettingsService extends AbstractService implements SettingsServiceInterface
{

    private SettingGroupsService $settingGroupsService;

    public function __construct(
        Container $container,
        EntityManager $entityManager,
        HttpRequest $httpRequest,
        HttpResponse $httpResponse,
        LoggingInterface $logger, SettingGroupsService $settingGroupsService
    ) {
        parent::__construct($container, $entityManager, $httpRequest,
            $httpResponse, $logger);
        $this->settingGroupsService = $settingGroupsService;
    }


    /**
     * @param  int    $offset
     * @param  int    $limit
     * @param  array  $searchParams
     *
     * @return ListResult
     */
    public function list(
        int $offset,
        int $limit,
        array $searchParams
    ): ListResult {
        $query = Setting::query();

        Setting::getSearchParams($query, $searchParams['search'] ?? '');

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }

    /**
     * @param  SettingDTO    $settingDTO
     * @param  SettingGroup  $settingGroup
     *
     * @return Setting
     */
    public function save(SettingDTO $settingDTO, SettingGroup $settingGroup): Setting
    {
        $id = $this->getKey($settingDTO);

        $setting = Setting::updateOrCreate(
            [
                'id' => $id,
                'setting_groups_id' => $settingGroup->id,
                'name' => $settingDTO->getName(),
                'description' => $settingDTO->getDescription(),
                'priority' => $settingDTO->getPriority(),
                'is_active' => $settingDTO->getIsActive(),
                'value' => $settingDTO->getValue(),
                'key' => $settingDTO->getKey()
            ]
        );
        //need to add this manually since the returned value from save
        //is not set by eloquent
        $setting->id = $id;

        return $setting;
    }

    /**
     * @param  string  $id
     *
     * @return Setting
     */
    public function get(string $id): Setting
    {
        return Setting::where('id', $id)->first();
    }

    /**
     * @param  int  $offset
     * @param  int  $limit
     *
     * @return ListResult
     */
    public function listAllByGroups(int $offset, int $limit): ListResult
    {
        $groups = $this->settingGroupsService->listAll();

        foreach ($groups->getList() as &$group) {
            $settings = Setting::where('setting_groups_id', $group->id)->get();
            $group->setSettings($settings->toArray());
        }

        return $groups;
    }
}
