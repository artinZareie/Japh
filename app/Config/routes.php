<?php

use App\Core\RecurcivePipeline;
use App\Services\HttpResponseService;
use App\Services\MiddlewaresService;

return [
	[
		'uri' => '/',
		'controller' => function() {
			include dir_glue(config("base_root"), "resources", "views", "index.view.php");
		},
	],
	[
		'uri' => '/<[0-9]+>',
		'controller' => function(int $num) {
			return "You are ${num}th user!";
		}
	],
	[
		'uri' => '<.*>',
		'controller' => function() {
			HttpResponseService::getResponseClass()->setStatusCode(404);
			return '404 Not Found!';
		}
	]
];
