<?php
namespace Model;

class Pair extends BaseModel
{
    public function add($warrior1, $warrior2)
    {
        $pair = new \Pair();
        $pair
            ->setWarrior1($this->_db->getReference("Warrior", (int)$warrior1))
            ->setWarrior2($this->_db->getReference("Warrior", (int)$warrior2))
            ->setEdited(new \DateTime());

        $this->_db->persist($pair);
        $this->_db->flush();

        return $pair->getId();
    }

    public function get($id)
    {
        $repo = $this->_db->getRepository("Pair");
        return $repo->findBy(["id" => $id, "deleted" => false])[0];
    }
}
