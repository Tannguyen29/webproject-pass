<?php

namespace App\Controller;

use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/classroom', name: 'app_classroom')]
    public function amdin_classroom (ClassroomRepository $ClassroomRepository):Response {
        $class=$ClassroomRepository->findAll();
        return $this->render('classroom_crud/index.html.twig',
            [
                'classroom' => $class
            ]);
      }
}
