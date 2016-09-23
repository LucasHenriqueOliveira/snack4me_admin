<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \App\Entity\User;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];


$entityManager = getEntityManager();

$c = new \Slim\Container($configuration);

$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $c['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};


$app = new \Slim\App($c);


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



$app->get('/', function (Request $request, Response $response) {

    #$response->getBody()->write("URL Incompleta");
    $data = "URL Incompleta";
    
    return $response
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});



$app->get('/users', function (Request $request, Response $response) use ($entityManager){

    try{
        $repository = $entityManager->getRepository(User::class);
        $users = $repository->findAll();

        $arrayUsers = User::toArray($users);
	
		 
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($arrayUsers, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }catch (Exception $e){
        echo $e;
    }





});



$app->run();
