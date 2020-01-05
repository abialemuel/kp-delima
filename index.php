<?php 
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;

    require_once __DIR__.'/vendor/autoload.php';
    $app = new Silex\Application();
    $app['debug'] = true;
    
    $app->post('/webhook', function (Request $request) use ($app) {
        header('Content-Type: application/json');
        $request = file_get_contents('php://input');
        $req_dump = print_r( $request, true );
        $fp = file_put_contents( 'webhook_request.log', $req_dump );
    });

    $app->get('/hello/{name}', function ($name) use ($app) {
        return 'Hello '.$app->escape($name);
      });

    $app->post('/feedback', function (Request $request) {
        $content = $request->request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }
    
        return new JsonResponse(['data' => $params]);
    });

    $app->run();
?>