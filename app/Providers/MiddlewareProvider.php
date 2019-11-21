<?php

namespace App\Providers;

use App\Core\IProvider;
use App\Services\MiddlewaresService;

class MiddlewareProvider implements IProvider
{
	public function boot(): void
	{
		MiddlewaresService::init();
	}
}
