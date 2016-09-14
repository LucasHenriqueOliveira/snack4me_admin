<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];



$c = new \Slim\Container($configuration);

$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $c['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};


$app = new \Slim\App($c);

//
////The following code should enable lazy CORS.
//$app->options('/{routes:.+}', function ($request, $response, $args) {
//    return $response;
//});
//
//$app->add(function ($req, $res, $next) {
//    $response = $next($req, $res);
//    return $response
//        ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
//        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
//        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
//});


# https://github.com/tuupola/cors-middleware
$app->add(new \Tuupola\Middleware\Cors([
    "methods" => ["GET", "POST", "PUT"],
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));



$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/', function (Request $request, Response $response) {

    $response->getBody()->write("rodando");

    return $response;
});
$app->run();
