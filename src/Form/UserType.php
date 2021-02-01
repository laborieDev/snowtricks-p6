<?php
namespace App\Form\Type;

use App\Entity\User;
use App\Entity\Group;
use App\Form\Type\LinkType;
use App\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param Array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class,[
                    "label" => "Nom : ",
                    "attr" => [
                        "placeholder" => "Nom",

                    ]
                ]
            )

            ->add('firstName', TextType::class,[
                    "label" => "Prénom : ",
                    "attr" => [
                        "placeholder" => "Prénom"
                    ]
                ]
            )


            ->add('image', MediaType::class,[
                "label" => "Photo de profil"
            ])

            ->add('email', EmailType::class,[
                    "label" => "Email : ",
                    "attr" => [
                        "placeholder" => "Email"
                    ]
                ]
            )

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passes de correspondent pas',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    "attr" => [
                        "placeholder" => "Mot de passe"
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    "attr" => [
                        "placeholder" => "Confirmation du mot de passe"
                    ]
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
