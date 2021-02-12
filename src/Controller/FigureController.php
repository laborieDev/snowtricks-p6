<?php

namespace App\Controller;

use App\Entity\Media;
use App\Lib\MediaLib;
use App\Entity\Figure;
use App\Entity\Message;
use App\Form\Type\FigureType;
use App\Form\Type\MessageType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

            $date = new \DateTime();
            $figure = $form->getData();
            $figure->setCreatedAt($date);
            $figure->setUpdatedAt($date);
            $figure->setUser($security->getUser());

            $folder = $this->getParameter('images_directory');

            // Get featured image
            $featuredImageObject = $form->get('featuredImage');
            $featuredImage = $featuredImageObject->get('image')->getData();

            if ($featuredImage) {
                $name = $featuredImageObject->get('name')->getData();
                $featuredImageMedia = $mediaLib->addImage($featuredImage, $name, $folder, $figure, true);
            }

            //Get others images
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
                $mediaLib->setImage($image, $file, $name, $folder, $figure);
            }

            $entityManager->persist($figure);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('figure/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/figure/{slug}", name="figure_view")
     * @param Request $request
     * @param Security $security
     * @param PaginatorInterface $paginator
     * @param String $slug
     * @return Response
     */
    public function getFigureView(Request $request, Security $security, PaginatorInterface $paginator, $slug)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $figure = $entityManager->getRepository(Figure::class)->findOneBy([
            "slug" => $slug
        ]);

        if ($figure == null) {
            throw new NotFoundHttpException('This Figure does not exist');
        }

        $message = new Message();
        $messageForm = $this->createForm(MessageType::class, $message);

        $isFormSubmit = false;

        $messageForm->handleRequest($request);
        if ($messageForm->isSubmitted() && $messageForm->isValid() && $security->getUser() != null) {
            $date = new \DateTime();
            $message = $messageForm->getData();
            $message->setUser($security->getUser());
            $message->setAddAt($date);
            $message->setFigure($figure);

            $entityManager->persist($message);
            $entityManager->flush();

            $isFormSubmit = true;
        }

        //Get all comments
        $allMessages = $entityManager->getRepository(Message::class)->findBy(['figure' => $figure], [
            'id' => 'desc'
        ]);


        //Paginate comments
        $messages = $paginator->paginate(
            $allMessages,
            $request->query->getInt('page', 1),
            4
        );

        if ($isFormSubmit) {
            return $this->render('figure/view.html.twig', [
                'figure' => $figure,
                'messageForm' => $messageForm->createView(),
                'messages' => $messages,
                'alertModal' => "Message bien enregistré !"
            ]);
        }

        return $this->render('figure/view.html.twig', [
            'figure' => $figure,
            'messages' => $messages,
            'messageForm' => $messageForm->createView()
        ]);
    }

    /**
     * @Route("/connected/edit_figure/{figureId}", name="edit_figure")
     * @param Request $request
     * @param mediaLib $mediaLib
     * @param Int $figureId
     * @return Response
     */
    public function editFigure(Request $request, MediaLib $mediaLib, $figureId): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $figure = $entityManager->getRepository(Figure::class)->find($figureId);
        $figureForm = $entityManager->getRepository(Figure::class)->find($figureId);

        $form = $this->createForm(FigureType::class, $figureForm);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $figureForm = $form->getData();
            $date = new \DateTime();

            $figure->setName($figureForm->getName());
            $figure->setDescription($figureForm->getDescription());
            $figure->setGroup($figureForm->getGroup());
            $figure->setUpdatedAt($date);

            $folder = $this->getParameter('images_directory');

            // Get featured image
            $featuredImageObject = $form->get('featuredImage');
            $featuredImage = $featuredImageObject->get('image')->getData();

            if ($featuredImage != null) {
                $name = $featuredImageObject->get('name')->getData();

                $oldFetauredImage = $figure->getFeaturedImage();

                $featuredImageMedia = $mediaLib->addImage($featuredImage, $name, $folder, $figure, true);
                if($featuredImageMedia != null){
                    $mediaLib->removeMedia($oldFetauredImage);
                }
            }

            //Get others images
            $images = $form->get('images')->getData();

            foreach($images as $image){
                $name = $image->getName();
                $file = $image->getImage();
                $url = $image->getUrl();
                if ($file != null) {
                    $imageMedia = $mediaLib->setImage($image, $file, $name, $folder, $figure);
                } elseif($url != null){
                    $image->setFigure($figure);
                    $image->setIsImage(false);
                    $entityManager->persist($image);
                }                
            }

            $entityManager->persist($figure);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('figure/new.html.twig', [
            'form' => $form->createView(),
            'action' => 'edit',
            'figure' => $figure
        ]);
    }

    /**
     * @Route("/connected/ajax/delete_figure/{figureId}", name="delete_figure")
     * @param mediaLib $mediaLib
     * @param Security $security
     * @param Int $figureId
     * @return JsonResponse
     */
    public function removeFigure(MediaLib $mediaLib, Security $security, $figureId): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $figure = $entityManager->getRepository(Figure::class)->find($figureId);

        if ($figure->getUser() != $security->getUser()) {
            throw new NotFoundHttpException('Request not authorized !');
        }

        $errors = "";

        //SUPPRESSION DES IMAGES DE LA FIGURE
        $allMedias = $figure->getImages();
        foreach($allMedias as $media){
            try{
                $mediaLib->removeMedia($media);
            } catch(Exception $error){
                $errors += $error."; ";
            }
        }

        $allComments = $figure->getMessages();
        foreach($allComments as $comment){
            $entityManager->remove($comment);
        }

        $entityManager->remove($figure);
        $entityManager->flush();

        return new JsonResponse([
            'error' => $errors
        ]);
    }

    /**
     * @Route("/search", name="search_figure")
     * @return Response
     */
    public function searchFigure(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $figures = $entityManager->getRepository(Figure::class)->findAll();

        return $this->render('figure/search.html.twig', [
            'allFigures' => $figures
        ]);
    }
}
