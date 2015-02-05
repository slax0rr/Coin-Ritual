<?php
require_once "app/Model/BaseModel.php";

define("APPPATH", "app/");

$db = new \Model\BaseModel();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($db->getEntityManager());
