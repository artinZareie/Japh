<?php

use App\Services\HttpResponseService;

return [
	[
		'uri' => '/',
		'controller' => function() {
			return '<html><head></head><body><a href="' . uri('/21') . '">Hello</a></body></html>';
		}
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
