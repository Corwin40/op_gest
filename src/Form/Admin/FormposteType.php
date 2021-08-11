<?php

namespace App\Form\Admin;

use App\Entity\Admin\Formposte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormposteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('email')
            ->add('phone')
            ->add('lastName')
            ->add('isRgpd', CheckboxType::class, [
                'label'    => "En soumettant ce formulaire, j'accepte que les données saisies soient exploitées dans le cadre de l'étude sur les connaissances numériques des usagers de la poste.",
                'required' => false,
            ])
            ->add('age',ChoiceType::class, [
                'choices'  => [
                    'de 10 à 20 ans' => '10-20',
                    'de 20 à 30 ans' => '20-30',
                    'de 30 à 40 ans' => '30-40',
                    'de 40 à 50 ans' => '40-50',
                    'de 50 à 60 ans' => '50-60',
                    'de 60 à 70 ans' => '60-70',
                    'de 70 à 80 ans' => '70-80',
                    'plus de 80 ans' => '80+'
                ],
            ])
            ->add('genre',ChoiceType::class, [
                'choices'  => [
                    'Une femme' => 'women',
                    'Une homme' => 'men'
                ],
            ])
            ->add('isInternet', CheckboxType::class, [
                'label'    => "un accès à internet : Box, Mobile, ...",
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formposte::class,
        ]);
    }
}
