<?php

namespace GSBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="Vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_immatriculation", type="integer", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numImmatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=50, nullable=true)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=50, nullable=true)
     */
    private $modele;

    /**
     * @var integer
     *
     * @ORM\Column(name="puissanceFiscale", type="integer", nullable=true)
     */
    private $puissancefiscale;

    /**
     * @var integer
     *
     * @ORM\Column(name="kilometre", type="integer", nullable=true)
     */
    private $kilometre;

    /**
     * @var string
     *
     * @ORM\Column(name="typVehicule", type="string", length=50, nullable=true)
     */
    private $typvehicule;

    /**
     * @var integer
     *
     * @ORM\Column(name="estDispo", type="integer", nullable=true)
     */
    private $estdispo;

    /**
     * @var integer
     *
     * @ORM\Column(name="capaStockage", type="integer", nullable=true)
     */
    private $capastockage;


    /**
     * Set numImmatriculation
     *
     * @param string $numImmatriculation
     * @return Vehicule
     */
    public function setnumImmatriculation($numImmatriculation)
    {
        $this->numImmatriculation = $numImmatriculation;

        return $this;
    }

    /**
     * Get numImmatriculation
     *
     * @return integer 
     */
    public function getNumImmatriculation()
    {
        return $this->numImmatriculation;
    }

    /**
     * Set marque
     *
     * @param string $marque
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     * @return Vehicule
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string 
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set puissancefiscale
     *
     * @param integer $puissancefiscale
     * @return Vehicule
     */
    public function setPuissancefiscale($puissancefiscale)
    {
        $this->puissancefiscale = $puissancefiscale;

        return $this;
    }

    /**
     * Get puissancefiscale
     *
     * @return integer 
     */
    public function getPuissancefiscale()
    {
        return $this->puissancefiscale;
    }

    /**
     * Set kilometre
     *
     * @param integer $kilometre
     * @return Vehicule
     */
    public function setKilometre($kilometre)
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    /**
     * Get kilometre
     *
     * @return integer 
     */
    public function getKilometre()
    {
        return $this->kilometre;
    }

    /**
     * Set typvehicule
     *
     * @param string $typvehicule
     * @return Vehicule
     */
    public function setTypvehicule($typvehicule)
    {
        $this->typvehicule = $typvehicule;

        return $this;
    }

    /**
     * Get typvehicule
     *
     * @return string 
     */
    public function getTypvehicule()
    {
        return $this->typvehicule;
    }

    /**
     * Set estdispo
     *
     * @param integer $estdispo
     * @return Vehicule
     */
    public function setEstdispo($estdispo)
    {
        $this->estdispo = $estdispo;

        return $this;
    }

    /**
     * Get estdispo
     *
     * @return integer 
     */
    public function getEstdispo()
    {
        return $this->estdispo;
    }

    /**
     * Set capastockage
     *
     * @param integer $capastockage
     * @return Vehicule
     */
    public function setCapastockage($capastockage)
    {
        $this->capastockage = $capastockage;

        return $this;
    }

    /**
     * Get capastockage
     *
     * @return integer 
     */
    public function getCapastockage()
    {
        return $this->capastockage;
    }
}
