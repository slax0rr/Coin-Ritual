<?php

/**
 * @Entity @Table(name="pairs")
 **/
class Pair
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ManyToOne(targetEntity="Warrior")
     * @var int
     */
    protected $warrior1;
    /**
     * @ManyToOne(targetEntity="Warrior")
     * @var int
     */
    protected $warrior2;
    /**
     * @Column (type="datetime")
     * @var DateTime
     */
    protected $edited;
    /**
     * @Column (type="boolean", options={"default" = false})
     * @var boolean
     */
    protected $deleted = false;


    public function getId()
    {
        return $this->id;
    }

    public function getWarrior1()
    {
        return $this->warrior1;
    }

    public function setWarrior1($warrior1)
    {
        $this->warrior1 = $warrior1;
        return $this;
    }

    public function getWarrior2()
    {
        return $this->warrior2;
    }

    public function setWarrior2($warrior2)
    {
        $this->warrior2 = $warrior2;
        return $this;
    }

    public function getEdited()
    {
        return $this->edited;
    }

    public function setEdited(DateTime $edited)
    {
        $this->edited = $edited;
        return $this;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }
}
