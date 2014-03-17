<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GuestAnnonceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('slug')
            ->add('description')
            ->add('tarif')
            ->add('date')
            ->add('updated')
            ->add('published')
            ->add('ipadress')
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('phone')
            ->add('showphone')
            ->add('image')
            ->add('categorie')
            ->add('proposition')
            ->add('region')
            ->add('departement')
            ->add('ville')
            ->add('type')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutcaz\BoutiqueBundle\Entity\GuestAnnonce'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boutcaz_boutiquebundle_guestannonce';
    }
}
