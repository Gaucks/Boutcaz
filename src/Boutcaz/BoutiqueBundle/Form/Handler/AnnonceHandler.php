<?php
# src/tuto/WelcomeBundle/Form/Handler/ContactHandler.php

namespace Boutcaz\BoutiqueBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * The AnnonceHandler.
 * Use for manage your form submitions
 *
 */
class AnnonceHandler
{
 	
 	protected $request;
    protected $form;
    protected $ip;
    protected $user;
    protected $annonce;
    protected $entityManager;
    protected $session;
    
    // protected $mailer; -> Si on veut envoyer un mail

    /**
     * Initialize the handler with the form and the request
     *
     * @param Form $form
     * @param Request $request
     * Mailer $mailer A ajouter si on veut envoyer un mail , à mettre dans le constructeur
     */
     
    public function __construct(Form $form, Request $request, $entityManager, $annonce, $user )
    {
        $this->form             = $form;
        $this->request          = $request;
        $this->annonce          = $annonce;
        $this->ip               = $this->request->server->get('REMOTE_ADDR');
        $this->entityManager    = $entityManager;
        $this->user             = $user;
        $this->session          = new Session;
        // $this->mailer = $mailer; -> Si on veut envoyer un mail
    }
    
    public function process()
    {
		// Check the method
		if ('POST' == $this->request->getMethod())
		{
			// Bind value with form
			$this->form->bind($this->request);
			
			if ($this->form->isValid()) {
				
				return $this->saveAnnonce();
			}
			else
			{
				$this->session->getFlashBag()->add('notice_error','Votre annonce comporte une ou des erreurs, veuillez modifier les champs indiqués.');
			}

			// $data = $this->form->getData();
			//  $this->onSuccess($data); -> Si on veut envoyer un mail	
			
		}
		
		return false;
    }

    private function onSuccess()
    {
	    /* -> Si on veut envoyer un mail
		$message = \Swift_Message::newInstance()
                    ->setContentType('text/html')
                    ->setSubject($data['subject'])
                    ->setFrom($data['email'])
                    ->setTo('xxxxxx@gmail.com')
                    ->setBody($data['content']);

        $this->mailer->send($message);
*/
    }
    
    private function saveAnnonce()
	{
		$this->annonce->setUser($this->user)
					  ->setIpadress($this->ip)
					  ->setDepartement($this->user->getDepartement())
					  ->setRegion($this->user->getRegion())
					  ->setVille($this->user->getVille())
					  ->getImage()->upload();

		$this->saveBdd($this->annonce);
		
		return true;
	}
	
	private function saveBdd()
	{	
		$this->entityManager->persist($this->annonce);
		$this->entityManager->flush();
	}

}