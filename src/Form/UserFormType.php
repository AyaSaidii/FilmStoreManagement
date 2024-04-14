<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Votre Nom'
            ]])
            ->add('username',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Votre Username'
            ]])
            ->add('password',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Votre Password'
            ]])
            ->add('role')

            ->add('Valider',SubmitType::class,[
                'label'=>'Valider' ,
                'attr'=>['class'=>'btn btn-primary mt-3'] ,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
