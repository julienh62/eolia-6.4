<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Category;
use App\Entity\Staff;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('start')
            ->add('end')
          /*  ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])*/

            ->add('staffs', EntityType::class, [
                'class' => Staff::class,
                'multiple' => true, // Permettre plusieurs sélections
                'expanded' => true, // Afficher comme des cases à cocher
                'label' => 'Select Staff(s)',
                'required' => false, // Optionnel
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
