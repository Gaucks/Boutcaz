<?php

namespace Boutcaz\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boutcaz\UserBundle\Entity\ProfilePerso; 
use Boutcaz\UserBundle\Form\Type\ProfilePersoType;

class UserController extends Controller
{
    public function navigationAction()
    {
    	return $this->render('UserBundle:Template:navigation.html.twig');		
	}
	
	public function editpersoAction( $errors = NULL )
	{
	
		$em = $this->getDoctrine()->getManager();
		
		$profile = $em->getRepository('UserBundle:ProfilePerso')->find(4);
		$form = $this->createForm(new ProfilePersoType, $profile);
		
		$request = $this->get('request');
		
		if('POST' === $request->getMethod())
		{
			$form->bind($request);
			
			
			
			if($form->isValid())
			{
				$em->persist($profile);
				$em->flush();
				
				return $this->redirect( $this->generateUrl('fos_user_profile_edit'));
			}	
			var_dump($form->getErrors('phone'));

		}
		return $this->render('UserBundle:Profile:edit_perso.html.twig', array('form' => $form->createView(), 'errors' => $errors));
	}
	
	
}
