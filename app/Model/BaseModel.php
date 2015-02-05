<?php
namespace Model;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class BaseModel
{
    protected $_db = null;

    public function __construct()
    {
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration([APPPATH. "config/Entity"], $isDevMode);

        require(APPPATH . "config/database.php");
        $this->_db = EntityManager::create($database, $config);
    }

    public function getEntityManager()
    {
        return clone $this->_db;
    }
}
