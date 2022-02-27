<?php

namespace Extensions\Recipes\Providers;

use Extensions\Recipes\Services\Contracts\RecipesServiceInterface;
use Extensions\Recipes\Services\RecipesService;
use Gossamer\Core\System\Contracts\ProviderInterface;

class ModuleProvider implements ProviderInterface
{
    public function register() {
        return [
            [RecipesServiceInterface::class, RecipesService::class]
        ];
    }
}
