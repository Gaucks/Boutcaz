<?php

namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// On rajoute ce use pour le context :
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Annonces
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Boutcaz\BoutiqueBundle\Entity\AnnonceRepository")
 * @Assert\Callback(methods={"titreValide"})
 */
class Annonce
{   

	// MEMBRE OU INVITÉ ?
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\AuteurType")
    */
	private $auteurtype;
	
	// DANS QUEL CATEGORIE METTE L'ANNONCE
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Categorie")
    */
	private $categorie;
	
	// C'EST UNE OFFRE, UNE DEMANDE OU UN DON
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Proposition")
    */
	private $proposition;
	
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
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\Length(min = "4" , minMessage = "Votre titre doit comporter au moins 4 caractères.")
     * @Assert\Regex(pattern = "/^[a-zA-Z0-9àáâãäåòóôõöøèéêëçìíîïùúûüÿñ -]+$/", message = "Le titre ne doit contenir que des chiffres ou des lettres" )
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(message = "4 caractères minimum")
     * @Assert\Length(min = "10" , minMessage = "Votre description doit comporter au moins 10 caractères.")
     */
    private $description;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tarif", type="integer", nullable=true)
     * @Assert\Regex(pattern= "/[0-9]/", message = "Le tarif ne peut être écrit qu'en chiffre." )
     */
    private $tarif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="auteurid", type="integer", nullable=FALSE)
     */
	private $auteurid;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;
    
    /**
    * @var boolean
    *
    * @ORM\Column(name="published", type="boolean")
    */
    private $published;


	public function __construct()
	{
    	$this->date  = new \DateTime();
		$this->updated  = new \DateTime();
		$this->published  = TRUE;

	}
	
	 public function titreValide(ExecutionContextInterface $context)
    {
	    $mots_interdits = array('Vend', 'Vends', 'Achete', 'achete', 'donne');
	    
	    // On vérifie que le contenu ne contient pas l'un des mots
		if (preg_match('#'.implode('|', $mots_interdits).'#', $this->getTitre())) 
		{
			// La règle est violée, on définit l'erreur et son message
			// 1er argument : on dit quel attribut l'erreur concerne, ici « contenu »
			// 2e argument : le message d'erreur
			$context->addViolationAt('titre', 'Titre invalide car il contient un mot interdit.', array(), null);
		}
	    
	    
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
     * Set titre
     *
     * @param string $titre
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Annonce
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
     * Set tarif
     *
     * @param integer $tarif
     * @return Annonce
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return integer 
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Annonce
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
     * Set auteurid
     *
     * @param integer $auteurid
     * @return Annonce
     */
    public function setAuteurid($auteurid)
    {
        $this->auteurid = $auteurid;

        return $this;
    }

    /**
     * Get auteurid
     *
     * @return integer 
     */
    public function getAuteurid()
    {
        return $this->auteurid;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Annonce
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set auteurtype
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\AuteurType $auteurtype
     * @return Annonce
     */
    public function setAuteurtype(\Boutcaz\BoutiqueBundle\Entity\AuteurType $auteurtype = null)
    {
        $this->auteurtype = $auteurtype;

        return $this;
    }

    /**
     * Get auteurtype
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\AuteurType 
     */
    public function getAuteurtype()
    {
        return $this->auteurtype;
    }

    /**
     * Set categorie
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Categorie $categorie
     * @return Annonce
     */
    public function setCategorie(\Boutcaz\BoutiqueBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set proposition
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Proposition $proposition
     * @return Annonce
     */
    public function setProposition(\Boutcaz\BoutiqueBundle\Entity\Proposition $proposition = null)
    {
        $this->proposition = $proposition;

        return $this;
    }

    /**
     * Get proposition
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Proposition 
     */
    public function getProposition()
    {
        return $this->proposition;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Annonce
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }
}
