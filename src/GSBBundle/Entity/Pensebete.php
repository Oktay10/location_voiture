<?php

namespace GSBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pensebete
 *
 * @ORM\Table(name="Pensebete", indexes={@ORM\Index(name="FK_Pensebete_Usager", columns={"idUsager"})})
 * @ORM\Entity
 */
class Pensebete
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="penseBete", type="string", length=50, nullable=true)
     */
    private $pensebete;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pensebete
     *
     * @param string $pensebete
     * @return Pensebete
     */
    public function setPensebete($pensebete)
    {
        $this->pensebete = $pensebete;

        return $this;
    }

    /**
     * Get pensebete
     *
     * @return string 
     */
    public function getPensebete()
    {
        return $this->pensebete;
    }

    /**
     * Set idusager
     *
     * @param \GSBBundle\Entity\User $iduser
     * @return Pensebete
     */
    public function setIduser(\GSBBundle\Entity\User $iduser = null)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return \GSBBundle\Entity\User 
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}
