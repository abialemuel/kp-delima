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
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        logger($request);
    
        return new JsonResponse(['data' => $params]);
    });

    $app->run();
?>