<?php

namespace App\Form;

use App\Entity\Activitie;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use App\Entity\Staff;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitieType extends CalendarType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      parent::buildForm($builder,$options);

        $builder

            ->add('stock')
            ->add('price')
            ->add('modifiedPrice', MoneyType::class, [
                'label' => 'nouveau prix?',
                'required' => false, // Rendre le champ facultatif

                'mapped' => false, // Indique que ce champ ne sera pas mappé à l'entité
                'attr' => [
                    // 'class' =>'form-control',
                    'placeholder' =>'nouveau prix?'
                ],
                'divisor' => 100
            ])
            //->add('category')
       /*     ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
            ])
            ->add('staffs', EntityType::class, [
                'class' => Staff::class,
                'multiple' => true, // Permettre plusieurs sélections
                'expanded' => true, // Afficher comme des cases à cocher
                'label' => 'Select Staff(s)',
                'required' => false, // Optionnel
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activitie::class,
        ]);
    }
}
