<?php
    $apiURL = 'https://api.chat-api.com/instance424467/';
    $token = '1g628o3hzssnae1j';


    $data = json_encode(
        array(
            'chatId'=>'5215540181174@c.us',
            'body'=>"Ticket Creado 99 : error de softwareadasd asdasdasd"
        )
    );

    $url = $apiURL.'message?token='.$token;
    $options = stream_context_create(
        array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $data
            )
        )
    );
    $response = file_get_contents($url,false,$options);
    echo $response; exit;
?>