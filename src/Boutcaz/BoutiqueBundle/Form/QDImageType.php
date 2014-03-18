<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QDImageType extends ImageType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
	// On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
     parent::buildForm($builder, $options);	
     
     $builder->add('file','file', array('label' => FALSE, 'required' => FALSE, 'attr' => array('class' => 'file')));

     
    
     }

}