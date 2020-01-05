<?php 
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

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
        $message = $request->get('message');
    
        return new Response($message, 200);
    });

    $app->run();
?>