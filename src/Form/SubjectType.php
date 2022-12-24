<?php

namespace App\Form;

use App\Entity\Subject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subjectcode', TextType::class,
            [
                'label' => 'subjectcode',
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 20
                ]
            ])
            ->add('subjectname', TextType::class,
            [
                'label' => 'subjectname',
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
            'data_class' => Subject::class,
        ]);
    }
}
