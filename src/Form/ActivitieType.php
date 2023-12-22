<?php

namespace App\Form;


use App\Entity\Activitie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitieType extends CalendarType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder,$options);
        $builder

            ->add('stock')
         //   ->add('price')
         //   ->add('modifiedPrice')

          /*  ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])*/
      /*    ->add('staffs', EntityType::class, [
              'class' => Staff::class,
              'multiple' => true, // Permettre plusieurs sélections
              'expanded' => true, // Afficher comme des cases à cocher
              'label' => 'Select Staff(s)',
              'required' => false, // Optionnel
          ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activitie::class,
        ]);
    }
}
