<?php

/**
 * @Entity @Table(name="tosses")
 **/
class Toss
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ManyToOne(targetEntity="Pair")
     * @var int
     */
    protected $pair;
    /**
     * @ManyToOne(targetEntity="Warrior")
     * @var int
     */
    protected $hunter;
    /**
     * @ManyToOne(targetEntity="Warrior")
     * @var int
     */
    protected $hunted;
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

    public function getPair()
    {
        return $this->pair;
    }

    public function setPair($pair)
    {
        $this->pair = $pair;
        return $this;
    }

    public function getHunter()
    {
        return $this->hunter;
    }

    public function setHunter($hunter)
    {
        $this->hunter = $hunter;
        return $this;
    }

    public function getHunted()
    {
        return $this->hunted;
    }

    public function setHunted($hunted)
    {
        $this->hunted = $hunted;
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

