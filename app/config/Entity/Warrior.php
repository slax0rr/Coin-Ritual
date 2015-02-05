<?php

/**
 * @Entity @Table(name="warriors")
 **/
class Warrior
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @Column (type="string")
     * @var string
     */
    protected $name;
    /**
     * @Column (type="string")
     * @var string
     */
    protected $galaxy;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getGalaxy()
    {
        return $this->galaxy;
    }

    public function setGalaxy($galaxy)
    {
        $this->galaxy = $galaxy;
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
