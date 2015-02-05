<?php
$router->name("/")->action(["Pair", "present"])->store();
$router->name("addpair")->action(["Pair", "view"])->store();
$router->post()->name("addpair")->action(["Pair", "add_post"])->store();
$router->cli()->name("websocket")->action(["WebSocket", "start"])->store();
