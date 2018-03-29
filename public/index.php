<?php

use Illuminate\Container\Container;
use duncan3dc\Laravel\BladeInstance;

use Psr7Middlewares\Middleware;
use Relay\RelayBuilder;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Stream;
use Zend\Diactoros\Response\SapiEmitter;
use Core\Container as myContainer;
use DebugBar\StandardDebugBar;

require __DIR__.'/../vendor/autoload.php';

myContainer::$container = new Container();

Middleware::setStreamFactory(function ($file, $mode) {
	return new Stream($file, $mode);
	//return app()->makeWith(Stream::class, [ "file" => $file, 'mode' => $mode ]);
});

app()->singleton('BladeInstance', function () {
	return new BladeInstance("../App/Views/", "../App/Views/cache/");
});

app()->make(\Core\Database::class);

$router = FastRoute\simpleDispatcher(require_once("../config/route.php"));
$debugBar = app()->make(StandardDebugBar::class);
$relay = app()->make(RelayBuilder::class);

$dispatcher = $relay->newInstance([
    Middleware::fastRoute($router),
    Middleware::FormatNegotiator(), //(recomended) to insert only in html responses
    Middleware::DebugBar($debugBar) //(optional) Instance of debugbar
      //  ->captureAjax(true)         //(optional) To send data in headers in ajax
]);



$response = $dispatcher(ServerRequestFactory::fromGlobals(), new Response());

//вывод ответа на экран
$emitter = new SapiEmitter();
return $emitter->emit($response);

function app(){
	return myContainer::$container;
}