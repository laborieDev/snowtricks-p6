<?php

namespace App\Controller;

use App\Entity\User;
use App\Lib\MediaLib;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     * 
     * @param Request $request
     * @param MediaLIb $mediaLib
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function signUp(Request $request, MediaLib $mediaLib, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            //Set password
            $password = $user->getPassword();
            $encoded = $encoder->encodePassword($user, $password);
            $user->setPassword($encoded);

            $user->setRoles(['ROLE_USER']);

            //Get images directory
            $folder = $this->getParameter('images_directory');

            // Get featured image
            $imageObject = $form->get('image');
            $image = $imageObject->get('image')->getData();

            if ($image) {
                $name = $user->getLastName()."_".$user->getFirstName()."_profil";

                $imageMedia = $mediaLib->addImage($image, $name, $folder);
                if($imageMedia != null){
                    $user->setImage($imageMedia);
                }
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
         // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}
}
