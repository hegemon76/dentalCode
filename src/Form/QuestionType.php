<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',null, [
            'attr' => [
                'placeholder' => 'Imię',
            ]])
         ->add('surname',null, [
            'attr' => [
                'placeholder' => 'Nazwisko',
            ]])
        ->add('email',null, [
            'attr' => [
                'placeholder' => 'E-mail',
            ]])
        ->add('body',null, [
            'attr' => [
                'placeholder' => 'Treść',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
