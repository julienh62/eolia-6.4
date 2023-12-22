<?php

namespace App\Form;

use App\Entity\StaffScheduleSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

class StaffScheduleSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')

            /*    ->add('picture', ChoiceType::class, [
                    'label' => 'Choix de l\'image',
                    'choices' => [

                        'Cata' => 'https://127.0.0.1:8000/assets/uploads/miniature-cata-accueil1.jpg',
                        'Char' => 'https://127.0.0.1:8000/assets/uploads/groupe-cha-mini-1.jpg',
                        'Baby' => 'https://127.0.0.1:8000/assets/uploads/charbabyaccueil.jpg',
                    ],
                    'placeholder' => 'Sélectionnez une option',
                ]) */
            ->add('background_color', ColorType::class)
            ->add('border_color', ColorType::class)
            ->add('text_color', ColorType::class)
            ->add('staffSchedule', null, [
                'label' => 'staffSchedule'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StaffScheduleSettings::class,
        ]);
    }
}
