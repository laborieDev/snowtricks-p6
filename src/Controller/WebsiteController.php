<?php

namespace App\Controller;

use App\Entity\Media;
use App\Lib\MediaLib;
use App\Entity\Figure;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WebsiteController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $datas = $entityManager->getRepository(Figure::class)->findBy([], [
            'id' => 'desc'
        ]);

        $figures = $paginator->paginate(
            $datas,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('website/index.html.twig', [
            'figures' => $figures
        ]);
    }


    /******* APPELS AJAX  **********/

    /**
     * @Route("/ajax/remove_media", name="remove_media")
     * @param Request $request
     * @param Security $security
     * @return JsonResponse
     */
    public function removeMedia(Request $request, Security $security, Medialib $mediaLib): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $mediaId = $request->query->get('id');

        if ($mediaId == null || $security->getUser() == null) {
            throw new NotFoundHttpException('Datas not found !');
        }

        $media = $entityManager->getRepository(Media::class)->find($mediaId);

        if ($media == null) {
            throw new NotFoundHttpException('Datas not found !');
        }

        $error = null;

        try{
            $mediaLib->removeMedia($media);
        } catch(Exception $e){
            $error = $e;
        }

        return new JsonResponse([
            'error' => $error
        ]);
    }
}
