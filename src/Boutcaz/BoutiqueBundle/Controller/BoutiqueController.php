<?php

namespace Boutcaz\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Boutcaz\BoutiqueBundle\Entity\Annonce;
use Boutcaz\BoutiqueBundle\Entity\Image;
use Boutcaz\BoutiqueBundle\Entity\AuteurType;

use Boutcaz\BoutiqueBundle\Form\QDAnnonceType;
use Boutcaz\BoutiqueBundle\Form\RechercheType;

use Boutcaz\BoutiqueBundle\Form\Handler\AnnonceHandler;

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
    	
    	return $this->render('BoutiqueBundle:Public:accueil.html.twig', array(  'recherche'=> $form_recherche->createView(), 
														    					'regions'  => $region, 'regions2'  => $region2, 'regions3'  => $region3));
    }
    
    public function deposerAction()
    {
    	$entete         = FALSE; /* Retire toutes les entetes */
    	
		// Création des objets requis
    	$annonce        = new Annonce;
		
		$request       	= $this->get('request'); // La requete
		$entityManager  = $this->getDoctrine()->getManager(); // L'entityManager
		$user           = $this->container->get('security.context')->getToken()->getUser(); // Les données de l'utilisateurs
		
    	$form           = $this->createForm(new QDAnnonceType($this->container->get('security.context')), $annonce);	 /* On créer le formulaire d'annonce */
		
		$formHandler 	= new AnnonceHandler($form, $request, $entityManager, $annonce, $user); // On transmet tout au AnnonceHandler
		
		$process 		= $formHandler->process(); // Validation du formulaire
				
		if($process)
		{
			// Launch the message flash
            $this->get('session')->getFlashBag()->add('notice','Votre annonces à été enregistré, consultez votre boite mail pour la confirmé!');
            	
			return $this->redirect(($this->generateUrl('show_homepage', array( 'region' 	 => $user->getRegion()->getSlug(), 
																			   'departement' => $user->getDepartement()->getslug(), 
																			   'ville' 		 => $user->getVille()->getslug(), 
																			   'id' 		 => $annonce->getId(), 
																			   'slug' 		 => $annonce->getSlug()))));				
		}
	 
		return $this->render('BoutiqueBundle:Public:deposer.html.twig', array( 'form' => $form->createView(),'entete' => $entete ));
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
    	$em = $this->getDoctrine()->getManager();
    	
    	$region = $em->getRepository('BoutiqueBundle:Region')->findOneBySlug($slug);
    	$annonces = $em->getRepository('BoutiqueBundle:Annonce')->findByRegion($region->getId());
    	
        return $this->render('BoutiqueBundle:Public:accueil_region.html.twig', array('region' => $region->getRegion() ,'slug' => $slug, 'annonces' => $annonces));
    }
    
    public function showAction($region, $departement, $ville, Annonce $id, $slug)//Annonce $anonce à rajouter
    {
    	$annonce = $this->getDoctrine()->getManager()->getRepository('BoutiqueBundle:Annonce')->findById($id);
    	
    	if($annonce == NULL )
    	{
	     	throw $this->createNotFoundException('Unable to find entity.');
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
    
   
}
