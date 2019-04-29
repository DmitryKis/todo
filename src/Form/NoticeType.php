<?php

namespace App\Form;

use App\Entity\Notice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoticeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, array('label' => 'Title', 'attr' => array('class' => 'form-control')))
            ->add('Description', TextareaType::class, array('label' => 'Description', 'attr' => array('class' => 'form-control')))
            ->add('Deadline', null, [
                'widget' => 'single_text', 'attr' => array('class' => 'form-control')
            ])
            ->add('Done',CheckboxType::class, array('label' => 'Done', 'attr' => array('class' => 'form-control')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notice::class,
        ]);
    }
}
