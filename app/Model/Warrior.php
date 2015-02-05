<?php
namespace Model;

class Warrior extends BaseModel
{
    public function getAll()
    {
        $repo = $this->_db->getRepository("Warrior");
        $warriors = $repo->findBy(["deleted" => false], ["edited" => "DESC"]);
        return $warriors;
    }

    public function get($id)
    {
        $repo = $this->_db->getRepository("Warrior");
        return $repo->findBy(["id" => (int)$id, "deleted" => false])[0];
    }
}
