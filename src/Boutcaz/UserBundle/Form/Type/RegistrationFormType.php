<?php
 
namespace Boutcaz\UserBundle\Form\Type;
 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
 
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('ville', 		'entity',    		array('class' 	   => 'BoutiqueBundle:Ville',
        											  'property' 	   => 'ville',
        											  'label' 		   => 'Ville:',
        											  'group_by' 	   => 'departement.departement',
        											  'empty_value'	   => 'Choisissez votre ville...'
        											 )
				  )
			->add('type', 		'entity',    		array('class' 	   => 'BoutiqueBundle:Type',
        											  'property' 	   => 'type',
        											  'label' 		   => 'Status:',
        											  'expanded' 	   => true, 
													  'multiple' 	   => false,
        											 )
        	    );
    }
    
    public function getName()
    {
        return 'fos_user_registration';
    }

}