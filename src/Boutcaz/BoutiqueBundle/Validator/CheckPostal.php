<?php

namespace Boutcaz\BoutiqueBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckPostal extends Constraint
{
  public $message = 'Le code postal %string% n\'est pas reconnu.';
  
  public function validatedBy()
  {
    return 'boutcazboutique_checkpostal'; // Ici, on fait appel à l'alias du service
  }
}