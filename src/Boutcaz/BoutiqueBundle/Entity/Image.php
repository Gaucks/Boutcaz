<?php

// src/Boutcaz\BoutiqueBundle/Entity/Image.php
namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Image
{
   /**
   * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Annonce")
   */
   private $annonce;
   
   /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
   
  private $alt;
  
  /**
   * @Assert\File(maxSize="6000000")
   */
  private $file;
    

  public function upload($annonce)
  {
		// Si jamais il n'y a pas de fichier (champ facultatif)
		if (null === $this->file) {
		  return;
		}
	
		// On garde le nom original du fichier de l'internaute
		$name = $this->file->getClientOriginalName();
		
		// On déplace le fichier envoyé dans le répertoire de notre choix
		$this->file->move($this->getUploadRootDir(), $name);
		
		// On sauvegarde le nom de fichier dans notre attribut $url
		$this->url = $name;
		
		// On crée également le futur attribut alt de notre balise <img>
		$this->alt = $name;
		
		// On ajoute aussi l'id de l'annonce
		$this->annonce = $annonce;
	
	}
	
	public function getUploadDir()
	{
	// On retourne le chemin relatif vers l'image pour un navigateur
	return 'uploads/img';
	}
	
	protected function getUploadRootDir()
	{
	// On retourne le chemin relatif vers l'image pour notre code PHP
	return __DIR__.'/../../../../web/'.$this->getUploadDir();
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
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }
    
    public function getFile()
    {
        return $this->file;
    }
    
    // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
    public function setFile( $file)
    {
        $this->file = $file;
        
        return $this;

     }
 

    /**
     * Set annonce
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Annonce $annonce
     * @return Image
     */
    public function setAnnonce(\Boutcaz\BoutiqueBundle\Entity\Annonce $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Annonce 
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }
}
