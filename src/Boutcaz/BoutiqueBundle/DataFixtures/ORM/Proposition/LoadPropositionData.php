<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadPropositionData.php


namespace Boutcaz\SiteBundle\DataFixtures\ORM\Type;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Boutcaz\BoutiqueBundle\Entity\Proposition;



class LoadPropositionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	// Creation des categories Multimédia
		$offre  		= $this->createProposition('Offre');
		$demande  		= $this->createProposition('Demande');
		$don  			= $this->createProposition('Don');	

		// Enregistrement des Propositions
		$manager->persist($offre);
		$manager->persist($demande);
		$manager->persist($don);
				
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createProposition($nom) {
		$proposition = new  Proposition();
		$proposition->setProposition($nom);
 
		return $proposition;
	}
	
	public function getOrder()
	{
		return 6; 
	}   
    
}