<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param Array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class,[
                    "label" => "Message",
                    "attr" => [
                        "placeholder" => "Un commentaire ?",
                        "class" => "form-control"
                    ]
                ]
            )
        ;
    }
}
