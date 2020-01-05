<?php 
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpClient\HttpClient;

    $host = 'https://api.line.me';
    $token = 'Bearer yAUR+ZsrKGgz+mSR/6GyyYHw9kDUIrjFwhN4wNmYPsJiDSgSbh5XPDFpgR/UPBfmFPN3Tus/XXqLQBsupI5dTMIRgky+uszuaVms9PEOgDLuMTmPh8wxBmkr/01so29avFqmgoAXLHS3DY4IgfOiSgdB04t89/1O/w1cDnyilFU=';

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
            $this->userId = $user['userId'];
            $this->displayName = $user['displayName'];
            $this->pictureURL = $user['pictureURL'];
            $this->statusMessage = $user['pictureURL'];
        }
     
        function getAll() {
            return $this;
        }
     
        private function get_user($userID)
        {
            $client = HttpClient::create(['headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "$token",
            ]]);
            $response = $client->request('GET', "$host" . "/v2/bot/profile/" . "$userID");
            return get_params($response);
        }
    }
?>