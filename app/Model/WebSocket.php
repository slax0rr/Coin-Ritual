<?php
namespace Model;

use \Ratchet\ConnectionInterface;
use \Ratchet\MessageComponentInterface;

class WebSocket extends BaseModel implements MessageComponentInterface
{
    protected $_clients = null;

    public function __construct()
    {
        $this->_clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $this->_clients->attach($connection);
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->_clients-detach($connection);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }
}
