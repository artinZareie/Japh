<?php

use App\Firelines\Http\Middlewares\CustomMiddleware;
use App\Firelines\Http\Middlewares\HtmlMiddleware;

return [
	"default_middlewares" => [
		HtmlMiddleware::class,
		CustomMiddleware::class
	]
];

