<?php
namespace Model;

class Toss extends BaseModel
{
    public function tossCoin($pair)
    {
        $warrior1 = 0;
        $warrior2 = 0;
        if ($warrior1 === $warrior2) {
            // retoss
            $warrior1 = rand(0, 1000);
            $warrior2 = rand(0, 1000);
            echo "retossing...";
        }
        echo "W1: {$warrior1}, W2: {$warrior2}\n";
        $hunter = $warrior1 < $warrior2
            ? $pair->getWarrior2()
            : $pair->getWarrior1();
        $hunted = $warrior1 > $warrior2
            ? $pair->getWarrior2()
            : $pair->getWarrior1();
        $toss = new \Toss();
        $toss
            ->setPair($this->_db->getReference("Pair", (int)$pair->getId()))
            ->setHunter($this->_db->getReference("Warrior", (int)$hunter->getId()))
            ->setHunted($this->_db->getReference("Warrior", (int)$hunted->getId()))
            ->setEdited(new \DateTime());

        $this->_db->persist($toss);
        $this->_db->flush();

        return [
            "hunter"    =>  [
                "name"      =>  $hunter->getName(),
                "galaxy"    =>  $hunter->getGalaxy()
            ],
            "hunted"    =>  [
                "name"      =>  $hunted->getName(),
                "galaxy"    =>  $hunted->getGalaxy()
            ],
            "warrior1"  =>  [
                "name"      =>  $pair->getWarrior1()->getName(),
                "galaxy"    =>  $pair->getWarrior1()->getGalaxy()
            ],
            "warrior2"  =>  [
                "name"      =>  $pair->getWarrior2()->getName(),
                "galaxy"    =>  $pair->getWarrior2()->getGalaxy()
            ]
        ];
    }
}
