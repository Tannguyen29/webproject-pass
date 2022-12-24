<?php

namespace App\Form;

use App\Entity\Classroom;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classname', TextType::class,
            [
                'label' => 'classname',
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 20
                ]
            ])
            ->add('classcode', TextType::class,
            [
                'label' => 'classcode',
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 20
                ]
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
