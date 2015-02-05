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
            $warrior1 += rand($warrior1, 10000);
            $warrior1 -= rand(0, $warrior1);
            $warrior2 = rand(0, 1000);
            $warrior2 += rand($warrior2, 10000);
            $warrior2 -= rand(0, $warrior2);
            echo "retossing...";
        }
        echo "W1: {$warrior1}, W2: {$warrior2}\n";
        if ($warrior1 < $warrior2) {
            $hunter = $pair->getWarrior2();
            $hunted = $pair->getWarrior1();
        } else {
            $hunter = $pair->getWarrior1();
            $hunted = $pair->getWarrior2();
        }
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
                "rank"      =>  $hunter->getRank(),
                "name"      =>  $hunter->getName(),
                "bloodname" =>  $hunter->getBloodname(),
                "galaxy"    =>  $hunter->getGalaxy()
            ],
            "hunted"    =>  [
                "rank"      =>  $hunted->getRank(),
                "name"      =>  $hunted->getName(),
                "bloodname" =>  $hunted->getBloodname(),
                "galaxy"    =>  $hunted->getGalaxy()
            ],
            "warrior1"  =>  [
                "rank"      =>  $pair->getWarrior1()->getRank(),
                "name"      =>  $pair->getWarrior1()->getName(),
                "bloodname" =>  $pair->getWarrior1()->getBloodname(),
                "galaxy"    =>  $pair->getWarrior1()->getGalaxy()
            ],
            "warrior2"  =>  [
                "rank"      =>  $pair->getWarrior2()->getRank(),
                "name"      =>  $pair->getWarrior2()->getName(),
                "bloodname" =>  $pair->getWarrior2()->getBloodname(),
                "galaxy"    =>  $pair->getWarrior2()->getGalaxy()
            ]
        ];
    }
}
