<?php

namespace Boutcaz\BoutiqueBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiFlood extends Constraint
{
  public $message = 'Le code postal n\'existe pas.';
  
  public function validatedBy()
  {
    return 'boutcazboutique_antiflood'; // Ici, on fait appel à l'alias du service
  }
}