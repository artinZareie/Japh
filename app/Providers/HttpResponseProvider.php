<?php

namespace App\Providers;

use App\Core\IProvider;
use App\Core\Platform;
use App\Services\HttpResponseService;

class HttpResponseProvider implements IProvider
{
    public function boot(): void
    {
        if (!Platform::isCli()) {
            HttpResponseService::init();
        }
    }
}
