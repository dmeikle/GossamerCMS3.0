<?php

namespace Components\Users\Providers;

use Components\Users\Services\Contracts\UsersServiceInterface;
use Components\Users\Services\TestService;
use Components\Users\Services\UsersService;
use Gossamer\Core\System\Contracts\ProviderInterface;

class ModuleProvider implements ProviderInterface
{
    public function register() {
        return [
            [UsersServiceInterface::class, UsersService::class],
            [TestService::class]
        ];
    }
}