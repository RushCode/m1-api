<?php

namespace leocata\M1;

use Hoa\Socket as HoaSocket;
use Hoa\Websocket\Client;

$t = new HoaSocket\Transport();

class WebSocketClient extends Client
{
    public function setSessionId()
    {

    }
}
