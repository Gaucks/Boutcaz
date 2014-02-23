<?php

namespace Boutcaz\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function navigationAction()
    {
    	
    	return $this->render('UserBundle:Template:navigation.html.twig');
			
	}
}
