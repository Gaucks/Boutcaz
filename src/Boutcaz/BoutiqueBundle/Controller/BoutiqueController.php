<?php

namespace Boutcaz\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutcaz\BoutiqueBundle\Entity\Annonce;
use Boutcaz\BoutiqueBundle\Entity\Guest;
use Boutcaz\BoutiqueBundle\Entity\Image;
use Boutcaz\BoutiqueBundle\Entity\AuteurType;

use Boutcaz\BoutiqueBundle\Form\QDGuestType;
use Boutcaz\BoutiqueBundle\Form\QDAnnonceType;
use Boutcaz\BoutiqueBundle\Form\RechercheType;
use Boutcaz\BoutiqueBundle\Form\ImageType;

class BoutiqueController extends Controller
{
    public function indexAction()
    {
    	// On récupere les parametres de sécurité
		$securityContext = $this->container->get('security.context');
				
    	if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
		    
		    	$user = $securityContext->getToken()->getUser();
		    	
		    	$user = $user->getUsername();
    	}
    	else{
	    	$user = NULL;
    	}
    	
    	//Création du formulaire de recherche
    	$form_recherche = $this->createForm(new rechercheType());
    	
    	$em = $this->getDoctrine();
    	
    	$regions = $em->getRepository('BoutiqueBundle:Region')->findBy(array(), null,  10);
    	
        return $this->render('BoutiqueBundle:Public:accueil.html.twig', array('recherche' => $form_recherche->createView(), 'regions' => $regions, 'user' => $user ));
    }
    
    public function deposerAction()
    {
    	$entete = FALSE; /* Retire toutes les entetes */
    	
    	$annonce 	= new Annonce;
    	$guest 		= new Guest;		
		$image 		= new Image;
		
		
    	$form_annonce 	= $this->createForm(new QDAnnonceType, $annonce);	 /* On créer le formulaire d'annonce */
    	$form_guest   	= $this->createForm(new QDGuestType, $guest);	 /* On créer le formulaire d'annonce */
    	$form_image 	= $this->createForm(new ImageType, $image);	/* On créer le formulaire d'images */
    	
    	$request = $this->get('request');
		
		if($request->getMethod() == 'POST')
		{
				
			// On bind les formulaires
			$form_annonce->bind($request);
			$form_guest->bind($request);
			$form_image->bind($request);
			
			$em = $this->getDoctrine()->getManager();
			
		    
			// Le formulaire est il valide
			if ($form_annonce->isValid()) {
				
				// On récupere les parametres de sécurité
				$securityContext = $this->container->get('security.context');
		
					// L'utilisateur est connecté donc on récupère ses informations
					if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
					
						$user = $securityContext->getToken()->getUser();
						
						// On crée l'objet Guest en fonction des données utilisateur connecté
						$guest->setPseudo($user->getUsername());
						$guest->setEmail($user->getEmail());
						$guest->setPassword($user->getPassword());
						$guest->setType($form_guest->getData()->getType(2));
						
						// On enregistre le Guest
						$em->persist($guest);
						$em->flush();
						
						$annonce->setAuteurid($user->getId());
						
						// On met le type d'utilisateur à Membre
						$annonce->setAuteurType($em->getRepository('BoutiqueBundle:AuteurType')->findOneByid(1) );
						
					}
					
					// L'UTILISATEUR N'EST PAS CONNECTÉ ON FAIT CE QUI SUIT :
						if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') == FALSE  ){
							
							// Sinon l'utilisateur est un invité	 
							if ($form_guest->isValid()){
							// On crée l'objet Guest en fonction du formulaire transmis
							$guest->setPseudo($form_guest->getData()->getPseudo());
							$guest->setEmail($form_guest->getData()->getEmail());
							$guest->setPassword($form_guest->getData()->getPassword());
							$guest->setType($form_guest->getData()->getType());
							$guest->setVille($form_guest->getData()->getVille());
							
							// On enregistre le Guest
							$em->persist($guest);
							$em->flush();
							
							
							// On met le type d'utilisateur à invité
							$annonce->setAuteurType($em->getRepository('BoutiqueBundle:AuteurType')->findOneByid(2) );
							// On met la valeur de Auteurid en fonction du mode d'envoi ( connecté ou non ) 	
							$annonce->setAuteurid($guest->getId());	
							}
							else{
								return $this->render('BoutiqueBundle:Public:deposer.html.twig', array(  'form_annonce' 	=> $form_annonce->createView(), 
																										'form_guest' 	=> $form_guest->createView(),
																										'form_image' 	=> $form_image->createView(),
																										'entete'		=> $entete  ));
								 }
						
						}
					
				
				// On enregistre le tout
		        $em->persist($annonce);
		        $em->flush();
		        
		        // Concernant l'image transmise
				 if( ($form_image->getData()->getFile() != NULL) AND ($form_image->isValid()) )
				 { 	
				 	$image->upload($annonce);
					 	
					$em->persist($image);	 
					$em->flush();	
				 }
			
			return $this->redirect(($this->generateUrl('boutique_homepage')));			
		}
	 
	 }
		
		return $this->render('BoutiqueBundle:Public:deposer.html.twig', array('form_annonce' => $form_annonce->createView(), 'form_guest' => $form_guest->createView(),  'form_image' => $form_image->createView(), 'entete'		=> $entete ));
	}
	
	
    public function regionAction($slug)
    {
    	
    	$em 	= $this->getDoctrine();
    	
    	$region = $em->getManager()->getRepository('BoutiqueBundle:Region')->findOneBySlug($slug);
    	
        return $this->render('BoutiqueBundle:Public:accueil_region.html.twig', array('region' => $region, 'slug' => $slug));
    }
    
    public function showAction()
    {
        return $this->render('BoutiqueBundle:Public:show_annonce.html.twig');
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
}
