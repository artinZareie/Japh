<?php

namespace App\Core;
use App\Firelines\Cli\Handler as CliHandler;
use App\Firelines\Http\Handler as HttpHandler;
use App\Services\HttpResponseService;

/**
 * Main Kernel
 * 
 * Main kernel of application
 */
class Kernel implements IKernel, ISingletone
{
    /**
     * Instance of kernel
     *
     * @var Kernel
     */
    private static $instance;
    /**
     * Renderable context
     *
     * @var IRenderable
     */
    private $renderableContext;

    /**
     * getInstance
     * 
     * If an instance exists returns existing instance and if
     * instance doesn't exists creates a new instance and return it.
     *
     * @return ISingletone
     */
    public static function getInstance(): ISingletone
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        self::$instance = Injector::get(self::class);
        return self::$instance;
    }
    /**
     * Kernel call
     * 
     * Will execute when everything is booted and application is ready
     * to execute.
     *
     * @return void
     */
    public function call(): void
    {
        try {
            if (Platform::isCli()) {
                $handler = inject(CliHandler::class);
            }
            else {
                $handler = inject(HttpHandler::class);
            }
            $this->renderableContext = $handler->fire();
        } catch (InterruptException $e) {
            Renderer::render($e->getRenderable());
        }
    }

    public function render(): void
    {
        if (Platform::isCli()) {
            Renderer::renderToTerminal($this->renderableContext);
        }
        else {
            Renderer::renderToHttp(HttpResponseService::getResponseClass());
        }
    }
}
