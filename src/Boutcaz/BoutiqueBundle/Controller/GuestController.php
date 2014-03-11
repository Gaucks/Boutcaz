<?php

namespace Boutcaz\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Boutcaz\BoutiqueBundle\Entity\Guest;
use Boutcaz\BoutiqueBundle\Form\QDGuestType;

class GuestController extends Controller
{
    public function registerAction()
    {
	    $guest = new Guest;
	    
	    $form = $this->createForm( new QDGuestType(), $guest);
	    
	    
	    return $this->render('BoutiqueBundle:Guest:register.html.twig', array('form' => $form->createView() ));
    }
}