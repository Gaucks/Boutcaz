<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadAuteurTypeData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Type;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Boutcaz\BoutiqueBundle\Entity\AuteurType;



class LoadAuteurTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	// Creation des categories Multimédia
		$member  		= $this->createAuteur('Membre');
		$guest  		= $this->createAuteur('Invité');

		// Enregistrement des Types
		$manager->persist($member);
		$manager->persist($guest);
				
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createAuteur($nom) {
		$auteur = new  AuteurType();
		$auteur->setType($nom);
 
		return $auteur;
	}
	
	public function getOrder()
	{
		return 7; 
	}   
    
}