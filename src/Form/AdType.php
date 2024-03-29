<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType ;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType  ;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{

    /**
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
            ->add('title',  TextType::class, $this->getConfiguration("Titre", "Saisir le titre !"))
            ->add('slug' , TextType::class, $this->getConfiguration("Adresse web", "Saisir le slug (automatique)!"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix", "Indiquez le prix"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une description globale de l'annonce"))
            ->add('content',TextareaType::class,$this->getConfiguration("Description détaillée", "Tapez une description "))
            ->add('coverImage', UrlType::class, $this->getConfiguration("URL de l'image principale" , "Donnez l'adresse d'une image qui donne vraiment envie"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Le nombres disponibles "))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
