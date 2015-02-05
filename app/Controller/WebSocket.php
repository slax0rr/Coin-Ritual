<?php
namespace Controller;

use \Ratchet\Server\IoServer;
use \Ratchet\Http\HttpServer;
use \Ratchet\WebSocket\WsServer;
use \Ratchet\ConnectionInterface;
use \Ratchet\MessageComponentInterface;

class WebSocket implements MessageComponentInterface
{
    protected $_clients = null;

    public function __construct()
    {
        $this->_clients = new \SplObjectStorage();
    }

    public function start()
    {
        $server = IoServer::factory(new HttpServer(new WsServer($this)), 3000);
        $server->run();
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $this->_clients->attach($connection);
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->_clients->detach($connection);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message received: {$msg}\n";
        $json = json_decode($msg);
        $toss = $this->_coinToss((int)$json->pair);
        foreach ($this->_clients as $client) {
            $client->send(json_encode($toss));
        }
    }

    protected function _coinToss($id)
    {
        $pair = new \Model\Pair();
        $pairData = $pair->get($id);
        $toss = new \Model\Toss();
        return $toss->tossCoin($pairData);
    }
}

