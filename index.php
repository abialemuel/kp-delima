<?php 
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;

    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/helper.php';

    $app = new Silex\Application();
    $app['debug'] = true;
    
    $app->post('/webhook', function (Request $request) {
        header('Content-Type: application/json');
        logger($request);
    });

    $app->get('/hello/{name}', function ($name) use ($app) {
        return 'Hello '.$app->escape($name);
      });

    $app->post('/feedback', function (Request $request) {
        $params = get_params($request);
        // $user = new User($params['source']['userId']);
        $user = new User('Ud4f84658b86dbf2fc6f0a96bbe43570f');
        logger($request);
        
        return new JsonResponse(['user' => $user]);
    });

    $app->run();
?>