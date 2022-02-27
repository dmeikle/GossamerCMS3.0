<?php

namespace Components\Dashboard\Controllers;

use Components\Blogs\Http\Requests\IndexRequest;
use Components\Dashboard\DTOs\SettingDTO;
use Components\Dashboard\Models\Setting;
use Components\Dashboard\Models\SettingGroup;
use Components\Dashboard\Services\Contracts\SettingsServiceInterface;
use Extensions\Recipes\Http\Requests\SaveRecipeRequest;
use Gossamer\Core\Http\Responses\SuccessResponse;
use Gossamer\Core\MVC\AbstractController;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Neith\Logging\LoggingInterface;

class SettingsController extends AbstractController
{

    private SettingsServiceInterface $settingsService;

    /**
     * @param  SettingsServiceInterface  $settingsService
     */
    public function __construct(EventDispatcher $eventDispatcher, LoggingInterface $logger, SettingsServiceInterface $settingsService) {
        parent::__construct($eventDispatcher, $logger);
        $this->settingsService = $settingsService;
    }


    public function index(IndexRequest $request) {
        $parameters = $request->getParameters();
        $list = $this->settingsService->list($request->getOffset(), $request->getLimit(), $parameters);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                $list)
        );
    }

    public function get(Setting $setting) {

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new SettingDTO(
                    $setting->id,
                    $setting->setting_groups_id,
                    $setting->name,
                    $setting->description,
                    $setting->priority,
                    $setting->is_active,
                    $setting->value,
                    $setting->key
                )
            ));
    }

    public function save(SaveRecipeRequest $request, SettingGroup $settingGroup)
    {
        $setting = $this->settingsService->save($request->post(), $settingGroup);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new SettingDTO(
                    $setting->id,
                    $setting->setting_groups_id,
                    $setting->name,
                    $setting->description,
                    $setting->priority,
                    $setting->is_active,
                    $setting->value,
                    $setting->key
                )
            ));
    }
}
