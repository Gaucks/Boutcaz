<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadTypeData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Type;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Boutcaz\BoutiqueBundle\Entity\Type;



class LoadTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	// Creation des categories Multimédia
		$particulier  		= $this->createType('Particulier');
		$professionel  		= $this->createType('Professionel');

		// Enregistrement des Types
		$manager->persist($particulier);
		$manager->persist($professionel);
				
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createType($nom) {
		$type = new  Type();
		$type->setType($nom);
 
		return $type;
	}
	
	public function getOrder()
	{
		return 1; 
	}   
    
}