<?php

namespace Nanaweb\MyFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Nanaweb\MyFormBundle\Form\DataTransformer\AddressTransformer;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attr = isset($options['attr']) ? $options['attr'] : array('size' => 40);
        $cityOption = array(
          'required' => $options['required'],
          'label' => $options['city_label'],
          'attr' => $attr,
        );
        $extraOption = array(
          'required' => false,
          'label' => $options['extra_label'],
          'attr' => $attr,
        );
        
        $builder
          ->add('city', 'text', $cityOption)
          ->add('extra', 'text', $extraOption)
          ->addViewTransformer(new AddressTransformer('city', 'extra'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'city_label' => 'City address',
            'extra_label' => 'Extra address',
        ));
    }
    
    public function getName()
    {
        return 'address';
    }
}