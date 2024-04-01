
<?php
//startar o servidor



use Api\Websoket\SistemaChat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
//importar o composer
require __DIR__.'/vendor/autoload.php';

//conectar o cliente e o servidor(API)
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new SistemaChat()
        )
    ),
    8081
);

//iniciar o servidor e começar a escutar as conexões
$server->run();
