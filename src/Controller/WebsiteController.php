<?php

namespace App\Controller;

use App\Entity\Figure;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
