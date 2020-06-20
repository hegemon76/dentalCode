<?php

namespace App\Form;

use App\Entity\Visit;
use DateTime;
//use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class VisitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class,[
                'widget' => 'single_text',
                'html5' => 'false',
            ])
            ->add('time', TimeType::class, [
                'hours' => [8,9,10,11,12,13,14,15],
                'minutes' => [00,30],
            ])
            ->add('doctor')
            ->add('Zapisz', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visit::class,
        ]);
    }
}
