<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class,[
                'label' => 'form.first_name',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('last_name', TextType::class,[
                'label' => 'form.last_name',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'form.gender',
                'translation_domain' => 'FOSUserBundle',
                'choices' => [
                    'Я парень' => 'Парень',
                    'Я девушка' => 'Девушка'],
                'expanded' => true
            ])
            ->add('group_number', TextType::class,[
                'label' => 'form.group_number',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('total_vno_score', NumberType::class,[
                'label' => 'form.total_vno_score',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('birth_year', NumberType::class,[
                'label' => 'form.birth_year',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('is_resident', ChoiceType::class, [
                'label' => 'form.is_resident',
                'translation_domain' => 'FOSUserBundle',
                'choices' => [
                    'Да' => true,
                    'Нет' => false
                ],
                'expanded' => true
            ]);

    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


}
