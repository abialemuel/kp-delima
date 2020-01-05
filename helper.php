<?php 
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;

    function logger($request)
    {
        $request = file_get_contents('php://input');
        $req_dump = print_r( $request . '/n', true );
        $fp = file_put_contents( 'webhook_request.log', $req_dump, FILE_APPEND );
    }
?>