<?php

namespace GSBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="Reservation", indexes={@ORM\Index(name="idUsager", columns={"idUsager"}), @ORM\Index(name="num_immatriculation", columns={"num_immatriculation"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=false)
     */
    private $dateReservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_loc", type="date", nullable=false)
     */
    private $dateDebutLoc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_loc", type="date", nullable=false)
     */
    private $dateFinLoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="essence_conso", type="integer", nullable=true)
     */
    private $essenceConso;

    /**
     * @var string
     *
     * @ORM\Column(name="estRendu", type="string", length=50, nullable=true)
     */
    private $estrendu;

    /**
     * @var \Vehicule
     *
     * @ORM\ManyToOne(targetEntity="Vehicule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="num_immatriculation", referencedColumnName="num_immatriculation")
     * })
     */
    private $numImmatriculation;

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
     * Get idreservation
     *
     * @return integer 
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime 
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set dateDebutLoc
     *
     * @param \DateTime $dateDebutLoc
     * @return Reservation
     */
    public function setDateDebutLoc($dateDebutLoc)
    {
        $this->dateDebutLoc = $dateDebutLoc;

        return $this;
    }

    /**
     * Get dateDebutLoc
     *
     * @return \DateTime 
     */
    public function getDateDebutLoc()
    {
        return $this->dateDebutLoc;
    }

    /**
     * Set dateFinLoc
     *
     * @param \DateTime $dateFinLoc
     * @return Reservation
     */
    public function setDateFinLoc($dateFinLoc)
    {
        $this->dateFinLoc = $dateFinLoc;

        return $this;
    }

    /**
     * Get dateFinLoc
     *
     * @return \DateTime 
     */
    public function getDateFinLoc()
    {
        return $this->dateFinLoc;
    }

    /**
     * Set essenceConso
     *
     * @param integer $essenceConso
     * @return Reservation
     */
    public function setEssenceConso($essenceConso)
    {
        $this->essenceConso = $essenceConso;

        return $this;
    }

    /**
     * Get essenceConso
     *
     * @return integer 
     */
    public function getEssenceConso()
    {
        return $this->essenceConso;
    }

    /**
     * Set estrendu
     *
     * @param string $estrendu
     * @return Reservation
     */
    public function setEstrendu($estrendu)
    {
        $this->estrendu = $estrendu;

        return $this;
    }

    /**
     * Get estrendu
     *
     * @return string 
     */
    public function getEstrendu()
    {
        return $this->estrendu;
    }

    /**
     * Set numImmatriculation
     *
     * @param \GSBBundle\Entity\Vehicule $numImmatriculation
     * @return Reservation
     */
    public function setNumImmatriculation(\GSBBundle\Entity\Vehicule $numImmatriculation = null)
    {
        $this->numImmatriculation = $numImmatriculation;

        return $this;
    }

    /**
     * Get numImmatriculation
     *
     * @return \GSBBundle\Entity\Vehicule 
     */
    public function getNumImmatriculation()
    {
        return $this->numImmatriculation;
    }

    /**
     * Set iduser
     *
     * @param \GSBBundle\Entity\User $iduser
     * @return Reservation
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
    public function getIdusager()
    {
        return $this->iduser;
    }
}
