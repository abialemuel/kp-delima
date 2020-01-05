<?php 
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpClient\HttpClient;

    $host = 'https://api.line.me';

    function logger($request)
    {
        $request = file_get_contents('php://input');
        $req_dump = print_r( $request, true ) . "\n";
        $fp = file_put_contents( 'webhook_request.log', $req_dump, FILE_APPEND );
    }

    function get_params($request)
    {
        $content = $request->getContent();
        if (!empty($content))
        {
            return json_decode($content, true); // 2nd param to get as array
        }
    }

    Class User {
        private $userId;
        private $displayName;
        private $pictureURL;
        private $statusMessage;
     
        function __construct( $id ) {
            $user = get_user($id);
            $this->userId = $userId;
            $this->displayName = $displayName;
            $this->pictureURL = $pictureURL;
            $this->statusMessage = $pictureURL;
        }
     
        function getAll() {
            return $this;
        }
     
        private function get_user($userID)
        {
            $client = HttpClient::create();
            $response = $client->request('GET', "$host" . "/v2/bot/profile/" . "$userID");
            return get_params($response);
        }
    }
?>