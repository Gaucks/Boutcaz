<?php

namespace Boutcaz\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boutcaz\UserBundle\Entity\ProfilePerso; 
use Boutcaz\UserBundle\Form\Type\ProfilePersoType;

class UserController extends Controller
{
    public function navigationAction($navigation = 'nav_profile')
    {
    	return $this->render('UserBundle:Template:navigation.html.twig', array('navigation' => $navigation));		
	}
	
}
