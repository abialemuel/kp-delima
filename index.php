<?php 
    require_once __DIR__.'/../vendor/autoload.php';
    $app = new Silex\Application();
    $app->post('/webhook', function (Request $request) {
        header('Content-Type: application/json');
        $request = file_get_contents('php://input');
        $req_dump = print_r( $request, true );
        $fp = file_put_contents( 'webhook_request.log', $req_dump );
    });
    $app->run();
?>