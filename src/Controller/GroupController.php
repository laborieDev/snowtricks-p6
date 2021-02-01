<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupController extends AbstractController
{   
    /**
     * @Route("/connected/add_group", name="add_group")
     * @param Request $request
     * @return Response
     */
    public function addGroup(Request $request): Response
    {
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $group = $form->getData();
            $entityManager->persist($group);
            $entityManager->flush();
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('group/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
