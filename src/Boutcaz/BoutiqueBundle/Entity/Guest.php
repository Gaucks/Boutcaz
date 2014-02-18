<?php

namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Guest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Boutcaz\BoutiqueBundle\Entity\GuestRepository")
 */
class Guest
{	
	// DANS QUEL VILLE IL SE SITUE
    /**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Ville")
    */
	private $ville;
	
	// PROFESSIONNEL OU PARTICULIER
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Type")
    */
	private $type;
	
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
     * @ORM\Column(name="pseudo", type="string", length=255)
     * @Assert\Regex(pattern = "/^[a-zA-Z0-9-]+$/")
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "L'email '{{ value }}' n'est pas une adresse email valide", checkMX = true )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     * @Assert\Regex(pattern= "/[0-9]/", message = "Veuillez utiliser le format : 0102030405" )
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showphone", type="boolean")
     */
    private $showphone;

	
	public function __construct()
	{
    	$this->date  = new \DateTime();
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
     * Set pseudo
     *
     * @param string $pseudo
     * @return Guest
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Guest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Guest
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Guest
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return Guest
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
     * @return Guest
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
     * Set ville
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Ville $ville
     * @return Guest
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

    /**
     * Set type
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Type $type
     * @return Guest
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

}
