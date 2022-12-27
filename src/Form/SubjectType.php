<?php

namespace App\Form;

use App\Entity\Subject;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

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
            ->add('Sunjectfee',TextType::class,
            [
                'label' => 'Sunject Fee',
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('subjectstartdate', DateType::class,
            [
                'label' => 'subjectstartdate',
                'widget' => 'single_text'
            ])
            ->add('subjectenddate', DateType::class,
            [
                'label' => 'subjectenddate',
                'widget' => 'single_text'
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
