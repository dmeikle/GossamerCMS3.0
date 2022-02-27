<?php

namespace Components\Blogs\Providers;

use Components\Blogs\Services\BlogsService;
use Components\Blogs\Services\Contracts\BlogsServiceInterface;
use Gossamer\Core\System\Contracts\ProviderInterface;

class ModuleProvider implements ProviderInterface
{
    public function register() {
        return [
            [BlogsServiceInterface::class, BlogsService::class]
        ];
    }
}
