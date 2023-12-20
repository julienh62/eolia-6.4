<?php

namespace App\Form;

use App\Entity\ActivitieCategorySettings;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitieCategorySettingsType extends CategorySettingsType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder,$options);
        $builder

            ->add('price')
          //  ->add('category')
          /*  ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActivitieCategorySettings::class,
        ]);
    }
}
