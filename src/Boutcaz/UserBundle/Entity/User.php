<?php 

namespace Boutcaz\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;	
/**
 * @ORM\Entity
 * @ORM\Table(name="qd_user")
 */
class User extends BaseUser
{

	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var integer
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
     // DANS QUEL Region IL SE SITUE
    /**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Region")
    */
	private  $region;
	
	// PROFESSIONNEL OU PARTICULIER
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Type")
    */
	private $type;

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
    

    public function __construct()
    {
        parent::__construct();
        
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * Set region
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Region $region
     * @return User
     */
    public function setRegion(\Boutcaz\BoutiqueBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set type
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Type $type
     * @return User
     */
    public function setType(\Boutcaz\BoutiqueBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set departement
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Departement $departement
     * @return User
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
     * @return User
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
