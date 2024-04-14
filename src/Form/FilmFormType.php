<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avatar',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Votre avatar'
            ]])
            ->add('titre',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Votre titre'
            ]])
            ->add('duree',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'La Durée'
            ]])
            ->add('categorie',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Catégorie du film'
            ]])
            ->add('description',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Description du film'
            ]])
            ->add('realisateur',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Le Realisateur'
            ]])
            ->add('qualite',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Qualité'
            ]])
            ->add('lien',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Lien du film'
            ]])
            ->add('dateS',TextType::class,['attr'=>[
                'class'=>'form-control' ,
                'placeholder'=>'Date de sortie'
            ]])
            ->add('Valider',SubmitType::class,[
                'label'=>'Valider' ,
                'attr'=>['class'=>'btn btn-primary mt-3'] ,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
