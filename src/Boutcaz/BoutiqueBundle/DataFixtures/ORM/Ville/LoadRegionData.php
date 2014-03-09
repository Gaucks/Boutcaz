<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadRegionData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Ville;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Boutcaz\BoutiqueBundle\Entity\Region;


class LoadRegionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

			//Creaae regions objects
			$bourgogne 				= $this->createRegion('Bourgogne');
			$lorraine 				= $this->createRegion('Lorraine');
			$alsace 				= $this->createRegion('Alsace');
			$picardie 				= $this->createRegion('Picardie');
			$franche_comte  		= $this->createRegion('Franche-Comté');
			$limousin 				= $this->createRegion('Limousin');
			$pays_de_la_loire 		= $this->createRegion('Pays de la Loire');
			$nord_pas_de_calais 	= $this->createRegion('Nord-Pas-de-Calais');
			$auvergne 				= $this->createRegion('Auvergne');
			$aquitaine 				= $this->createRegion('Aquitaine');
			$centre 				= $this->createRegion('Centre');
			$bretagne 				= $this->createRegion('Bretagne');
			$ile_de_france 			= $this->createRegion('Ile-de-France');
			$midi_pyrenees 			= $this->createRegion('Midi-Pyrénées');
			$languedoc_roussillon 	= $this->createRegion('Languedoc-Roussillon');
			$champagne_ardenne 		= $this->createRegion('Champagne-Ardenne');
			$corse 					= $this->createRegion('Corse');
			$guadeloupe 			= $this->createRegion('Guadeloupe');
			$guyane 				= $this->createRegion('Guyane');
			$martinique 			= $this->createRegion('Martinique');
			$mayotte 				= $this->createRegion('Mayotte');
			$basse_normandie 		= $this->createRegion('Basse-Normandie');
			$haute_normandie 		= $this->createRegion('Haute-Normandie');
			$picardie 				= $this->createRegion('Picardie');
			$poitou_charentes 		= $this->createRegion('Poitou-Charentes');
			$paca 					= $this->createRegion('Provence-Alpes-Côte d\'Azur');
			$la_reunion 			= $this->createRegion('La Réunion');
			$rhone_alpes 			= $this->createRegion('Rhône-Alpes');
			
			// Persist regions dans la database
			
			// Rangée 1
			$manager->persist($basse_normandie);
			$manager->persist($haute_normandie);
			$manager->persist($picardie);
			$manager->persist($corse);
			$manager->persist($paca);
			$manager->persist($la_reunion);
			$manager->persist($rhone_alpes);
			$manager->persist($auvergne);
			$manager->persist($aquitaine);
			
			// Rangée 2
			$manager->persist($bretagne);
			$manager->persist($ile_de_france);
			$manager->persist($alsace);
			$manager->persist($champagne_ardenne);
			$manager->persist($poitou_charentes);
			$manager->persist($guadeloupe);
			$manager->persist($guyane);
			$manager->persist($martinique);
			$manager->persist($mayotte);
			
			// Rangée 3
			$manager->persist($languedoc_roussillon);
			$manager->persist($bourgogne);
			$manager->persist($lorraine);
			$manager->persist($picardie);
			$manager->persist($franche_comte);
			$manager->persist($limousin);
			$manager->persist($pays_de_la_loire);
			$manager->persist($nord_pas_de_calais);
			$manager->persist($centre);

			
			$manager->flush();
			
			// Add all regions as a reference for use in other data fixtures
			$this->addReference('region-bo', $bourgogne);
			$this->addReference('region-lo', $lorraine);
			$this->addReference('region-al', $alsace);
			$this->addReference('region-np', $nord_pas_de_calais);
			$this->addReference('region-av', $auvergne);
			$this->addReference('region-aq', $aquitaine);
			$this->addReference('region-ce', $centre);
			$this->addReference('region-br', $bretagne);
			$this->addReference('region-fr', $ile_de_france);
			$this->addReference('region-lg', $languedoc_roussillon);
			$this->addReference('region-ch', $champagne_ardenne);
			$this->addReference('region-co', $corse);
			$this->addReference('region-gd', $guadeloupe);
			$this->addReference('region-gu', $guyane);
			$this->addReference('region-mt', $martinique);
			$this->addReference('region-ma', $mayotte);
			$this->addReference('region-bn', $basse_normandie);
			$this->addReference('region-hn', $haute_normandie);
			$this->addReference('region-pi', $picardie);
			$this->addReference('region-ps', $poitou_charentes);
			$this->addReference('region-pa', $paca);
			$this->addReference('region-lr', $la_reunion);
			$this->addReference('region-ra', $rhone_alpes);
			
    }
    
	
	private function createRegion($nom ) {
			$region = new Region();
			$region->setRegion($nom);
	 
			return $region;
	}
	
	
	public function getOrder()
	{
			return 1; 
	}
	
    
}