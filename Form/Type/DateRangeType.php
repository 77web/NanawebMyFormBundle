<?php

namespace Nanaweb\MyFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateRangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $childOptions = array(
          'widget' => $options['widget'],
          'input' => $options['input'],
          'label' => $options['label'],
          'read_only' => $options['read_only'],
          'error_bubbling' => $options['error_bubbling'],
          'required' => $options['required'],
        );
        
        $builder
            ->add('from', 'date', $childOptions)
            ->add('to', 'date', $childOptions)
        ;
    }

    public function getName()
    {
        return 'date_range';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'widget' => 'single_text',
            'input' => 'datetime',
        ));
    }
}
