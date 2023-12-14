<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\CategorySettings;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('CategorySetting', EntityType::class, [
                'class' => CategorySettings::class,
                'multiple' => true, // Permettre plusieurs sélections
                'expanded' => true, // Afficher comme des cases à cocher
                'label' => 'Select category setting(s)',
                'required' => false, // Optionnel
            ])
           /* ->add('categorySetting', EntityType::class, [
                'class' => CategorySettings::class,
'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
