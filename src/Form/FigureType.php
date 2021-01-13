<?php
namespace App\Form\Type;

use App\Entity\Group;
use App\Form\Type\LinkType;
use App\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                    "label" => "Nom"
                ]
            )

            ->add('group', EntityType::class, [
                'class' => Group::class,
                'choice_label' => 'name',
            ])
            
            ->add('description', TextareaType::class,[
                "label" => "Description"
            ])

            ->add('featuredImage', MediaType::class,[
                "label" => "Image mise en avant"
            ])

            ->add('images', CollectionType::class, [
                'entry_type' => MediaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true
            ])

            ->add('Valider', SubmitType::class)
        ;
    }
}