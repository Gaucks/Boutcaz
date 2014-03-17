<?php

namespace Boutcaz\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Boutcaz\BoutiqueBundle\Entity\Annonce;
use Boutcaz\BoutiqueBundle\Entity\GuestAnnonce;
use Boutcaz\BoutiqueBundle\Entity\Image;
use Boutcaz\BoutiqueBundle\Entity\AuteurType;

use Boutcaz\BoutiqueBundle\Form\QDAnnonceType;
use Boutcaz\BoutiqueBundle\Form\QDGuestAnnonceType;
use Boutcaz\BoutiqueBundle\Form\RechercheType;

use Boutcaz\BoutiqueBundle\Form\Handler\AnnonceHandler;
use Boutcaz\BoutiqueBundle\Form\Handler\GuestAnnonceHandler;

class BoutiqueController extends Controller
{
    public function indexAction()
    {
    	//Création du formulaire de recherche
    	$form_recherche            = $this->createForm(new rechercheType());
    	
    	//Récupération de toutes les régions limité a 9 affichage ( à modifier )
    	$regionEntityRepository    = $this->getDoctrine()->getRepository("BoutiqueBundle:Region");
    	
    	$region                    = $regionEntityRepository->findBy(array(), array('id' => 'desc'), 8, 0);
		$region2                   = $regionEntityRepository->findBy(array(), array('id' => 'desc'), 9, 8);
	    $region3                   = $regionEntityRepository->findBy(array(), array('id' => 'desc'), 9, 17);
    	
    	return $this->render('BoutiqueBundle:Public:accueil.html.twig', array(  'recherche' => $form_recherche->createView(), 
														    					'regions'   => $region,
														    					'regions2'  => $region2,
														    					'regions3'  => $region3 ));
    }
    
    public function rechercheCheckAction()
    {    
    	$recherche = $this->getRequest()->request->get('recherche');

    	if($recherche == NULL){
    		return $this->redirect($this->generateUrl('boutique_homepage'));
    	}
    	
    	return $this->redirect($this->generateUrl('recherche_show', array('recherche' => $recherche)));
    }
    
    public function rechercheShowAction($recherche)
    {
    	$em = $this->getDoctrine()->getManager();
    	
		if($recherche == NULL){
    		return $this->redirect($this->generateUrl('boutique_homepage'));
    	} 
    	
    	$annonce  		= $em->getRepository('BoutiqueBundle:GuestAnnonce')->findAnnonces($recherche);
    	$guestAnnonces  = $em->getRepository('BoutiqueBundle:Annonce')->findAnnonces($recherche);
    	
    	$annonces 		= array_merge($annonce, $guestAnnonces); // Fusion des données Guest et Membres
    	
    	return $this->render('BoutiqueBundle:Public:recherche.html.twig', array('annonces' 			=> $annonces, 
    																			'slug'	   			=> 'toute-la-france',
    																			'region'			=> 'Toute la France',
    																			'totalAnnonces' 	=> 10,
    																			'totalBoutiques'	=> 0 ));
    }
    
    public function deposerAction()
    {
    	
    	$entete         = FALSE; /* Retire toutes les entetes */
    	
    	//===============================================================
		//! On controle si l'utilisateur est enregistré
		//  ou non afin d'afficher le bon formulaire d'annonce
		// Ceci est surement une methode à refactoriser
		// GC le 12/03/14
		//===============================================================

    	$securityContext = $this->container->get('security.context'); // Le conttroleur de sécurité
    	$request       	= $this->get('request'); // La requete
		$entityManager  = $this->getDoctrine()->getManager(); // L'entityManager
		
		// L'utilisateur est connecté donc on envoi le formulaire adéquate
		if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
		
			// Création des objets requis
	    	$annonce        = new Annonce;
			
			$user           = $this->container->get('security.context')->getToken()->getUser(); // Les données de l'utilisateurs
			
	    	$form           = $this->createForm(new QDAnnonceType($this->container->get('security.context')), $annonce);	 /* On créer le formulaire d'annonce */
			
			$formHandler 	= new AnnonceHandler($form, $request, $entityManager, $annonce, $user); // On transmet tout au AnnonceHandler
			
			$process 		= $formHandler->process(); // Validation du formulaire
			
			// On envoie le tout a la validation via le AnnonceHandler		
			if($process)
			{
				// Launch the message flash
	            $this->get('session')->getFlashBag()
	            					 ->add('notice','Votre annonces à été enregistré, consultez votre boite mail pour la confirmé!');
	            	
				return $this->redirect(($this->generateUrl('show_homepage', array( 'region' 	 => $user->getRegion()->getSlug(), 
																				   'departement' => $user->getDepartement()->getslug(), 
																				   'ville' 		 => $user->getVille()->getslug(), 
																				   'id' 		 => $annonce->getId(), 
																				   'slug' 		 => $annonce->getSlug()))));				
			}
			
			return $this->render('BoutiqueBundle:Public:deposer.html.twig', array( 'form' 	=> $form->createView(),
																			   'entete' => $entete ));	
			
		}
		
		//==============================================================
		//! Affichage du formulaire si l'utilisateur n'a pas de compte
		//==============================================================
		
		else
		{
			$annonce = new GuestAnnonce;
			
			$form 	 = $this->createForm(new QDGuestAnnonceType(), $annonce);
			
			$formHandler 	= new GuestAnnonceHandler($form, $request, $entityManager, $annonce); // On transmet tout
			
			$process 		= $formHandler->process(); // Validation du formulaire
			
			// On envoie le tout a la validation via le AnnonceHandler		
			if($process)
			{
				// Launch the message flash
	            $this->get('session')->getFlashBag()
	            					 ->add('notice','Votre annonces à été enregistré, consultez votre boite mail pour la confirmé!');
	            	
				return $this->redirect(($this->generateUrl('deposer_homepage')));				
			}
			
			return $this->render('BoutiqueBundle:Guest:deposer.html.twig', array( 'form' 	=> $form->createView(),
																			   'entete' => $entete ));
		}
	 
		
	}
	
	public function regionCheckAction()
	{
		//=======================================================
		//! Utiliser pour récupérer la région de l'utilisateur, 
		//!	utilisé lors des redirections des connectés
		//======================================================

		$securityContext = $this->container->get('security.context');
		
		// L'utilisateur est connecté donc on récupère ses informations
		if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
			
			$slug = $securityContext->getToken()->getUser();
			
			return $this->redirect($this->generateUrl('region_homepage', array('slug' => $slug->getRegion()->getSlug()) ));
		}
		
		// On envoi une erreur si il n'est pas connecté
		throw new \Exception('Quelque chose a mal tourné, vous n\'êtes pas connecté apparemment!');			
		
	}
	
    public function regionAction($slug)
    {
    	// Recupere la région et l'entityManager
    	$em                        = $this->getDoctrine()->getManager();
		$region                    = $em->getRepository('BoutiqueBundle:Region')->findOneBySlug($slug);
    	
    	// Recupere les repository requis
    	$repositoryAnnonce         = $em->getRepository('BoutiqueBundle:Annonce');
    	$repositoryGuestAnnonce    = $em->getRepository('BoutiqueBundle:GuestAnnonce');
    	
    	// Recuperes les annonces
    	$annonces                  = $this->mergeAnnonces($region, $repositoryAnnonce, $repositoryGuestAnnonce );
    	
    	// Compteur d'annonces et boutiques
    	$totalAnnonce              = $this->totalAnnonces($region, $repositoryAnnonce, $repositoryGuestAnnonce);  
    	$totalBoutiques            = 0; // A Faire une fonction qui compte le nombre de résultat
    	
    	
    	// LA vue final
        return $this->render('BoutiqueBundle:Public:accueil_region.html.twig', array('region'    		=> $region->getRegion(),
        																			  'slug'  	 		=> $slug, 
        																			  'annonces' 		=> $annonces,
        																			  'totalAnnonces' 	=> $totalAnnonce,
        																			  'totalBoutiques' 	=> $totalBoutiques ));
    }
    
    public function showAction($region, $departement, $ville, $id, $slug)//Annonce $anonce à rajouter
    {
    	$annonce 		= $this->getDoctrine()->getManager()->getRepository('BoutiqueBundle:Annonce')->findById($id);
    	
    	if($annonce == NULL )
    	{
	     	$guestAnnonce  = $this->getDoctrine()->getManager()->getRepository('BoutiqueBundle:GuestAnnonce')->findById($id);
	     	
	     	if($guestAnnonce == NULL )
		 	{
		 		return $this->render('BoutiqueBundle:Errors:no_annonce_found.html.twig');
		 	}
		 	
		 	return $this->render('BoutiqueBundle:Guest:show_annonce.html.twig', array('annonce' => $guestAnnonce ));
		 	
    	}
    	
        return $this->render('BoutiqueBundle:Public:show_annonce.html.twig', array('annonce' => $annonce ));
    }
    
    public function signinAction()
    {
        return $this->render('BoutiqueBundle:Public:signin.html.twig');
    }
    
	public function signupAction()
	{
		return $this->render('BoutiqueBundle:Public:signup.html.twig');
	}
    
    public function footerAction()
    {
        return $this->render('BoutiqueBundle:Template:footer.html.twig');
    }
    
    public function navigationAction()
    {
	    return $this->render('BoutiqueBundle:Template:navigation.html.twig');
    }
    
    private function mergeAnnonces($region, $repositoryAnnonce, $repositoryGuestAnnonce)
    {	
		$annonce                   = $repositoryAnnonce->findByRegion($region->getId());
    	$guestAnnonces             = $repositoryGuestAnnonce->findByRegion($region->getId());
    	
    	$allAnnonces = array_merge($annonce, $guestAnnonces); // Mix les 2 repertoires d'annonces ( Guest et Membres )
    	
    	usort($allAnnonces, array($this, 'trie_par_date') );
    	
    	return $allAnnonces;
    	
	}
	
	private function trie_par_date($a, $b) { 
		$date1 = strtotime($a->getDate()->format('r'));
		$date2 = strtotime($b->getDate()->format('r'));
		return $date1 < $date2 ;
	}
	
	private function totalAnnonces($region, $repositoryAnnonce, $repositoryGuestAnnonce)
	{
		$countAnnonce              = $repositoryAnnonce->countResult($region->getId());
    	$countGuestAnnonce         = $repositoryGuestAnnonce->countResult($region->getId());
    	
    	return $countAnnonce+$countGuestAnnonce;
	}
    
   
}
