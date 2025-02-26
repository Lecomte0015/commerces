<?php

namespace App\Form;

use App\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [ // Utiliser 'name' car 'Brand' est supprimé dans l'entité
                'required' => false, // Correction ici
                'label' => 'Nom de la marque',
                'attr' => [
                    'placeholder' => 'Saisir le nom de la marque'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le nom de la marque'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
