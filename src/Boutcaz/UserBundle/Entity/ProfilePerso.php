<?php

namespace Boutcaz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProfilePerso
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Boutcaz\UserBundle\Entity\ProfilePersoRepository")
 */
class ProfilePerso
{
	// Quel département
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Departement")
    */
	private $departement;
	
	// Quel ville
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Ville")
    */
	private $ville;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Regex(pattern = "/[0-9]/", match=true,  message = "Le téléphone ne doit contenir que des chiffres" )
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var integer
     * @ORM\Column(name="phone", type="integer", nullable=true)
     * @Assert\Length(max = "14" , maxMessage = "Le numéro ne peut contenir que 14 chiffres.")
     * @Assert\Regex(pattern = "/[0-9]/", message = "Le téléphone ne doit contenir que des chiffres" )
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showphone", type="boolean")
     */
    private $showphone;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Assert\Regex("/^\w+/")
     */
    private $description;


	public function __construct()
	{
		$this->showphone = false;
	}
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
     * Set surname
     *
     * @param string $surname
     * @return Profile
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Profile
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return Profile
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set showphone
     *
     * @param boolean $showphone
     * @return Profile
     */
    public function setShowphone($showphone)
    {
        $this->showphone = $showphone;

        return $this;
    }

    /**
     * Get showphone
     *
     * @return boolean 
     */
    public function getShowphone()
    {
        return $this->showphone;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Profile
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set departement
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Departement $departement
     * @return Profile
     */
    public function setDepartement(\Boutcaz\BoutiqueBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Departement 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set ville
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Ville $ville
     * @return Profile
     */
    public function setVille(\Boutcaz\BoutiqueBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
    }
}
