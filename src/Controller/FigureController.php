<?php

namespace App\Controller;

use App\Entity\Media;
use App\Lib\MediaLib;
use App\Entity\Figure;
use App\Form\Type\FigureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FigureController extends AbstractController
{
    /**
     * @Route("/connected/add_figure", name="add_figure")
     * @param Request $request
     * @param mediaLib $mediaLib
     * @param Security $security
     * @return Response
     */
    public function addFigure(Request $request, MediaLib $mediaLib, Security $security): Response
    {
        $figure = new Figure();
        $form = $this->createForm(FigureType::class, $figure);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $figure = $form->getData();
            $figure->setUser($security->getUser());

            $folder = $this->getParameter('images_directory');

            // Get featured image
            $featuredImageObject = $form->get('featuredImage');
            $featuredImage = $featuredImageObject->get('image')->getData();

            if ($featuredImage) {
                $name = $featuredImageObject->get('name')->getData();

                $featuredImageMedia = $mediaLib->addImage($featuredImage, $name, $folder);
                if($featuredImageMedia != null){
                    $figure->setFeaturedImage($featuredImageMedia);
                }
            }

            $images = $form->get('images')->getData();

            foreach($images as $image){
                $name = $image->getName();
                $file = $image->getImage();
                if($file == null){
                    $image->setFigure($figure);
                    $image->setIsImage(false);
                    $entityManager->persist($image);
                    continue;
                }
                $imageMedia = $mediaLib->setImage($image, $file, $name, $folder, $figure);
            }

            $entityManager->persist($figure);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('figure/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
