<?php

namespace App\Controller;

use App\Form\ClassType;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassroomCrudController extends AbstractController
{
    #[Route('/classroom/crud', name: 'app_classroom_crud')]
    public function index(ClassroomRepository $ClassroomRepository): Response
    {
        $class=$ClassroomRepository->findAll();
        return $this->render('classroom_crud/index.html.twig',
        [
            'class' => $class
        ]);
  }


    #[Route('/edit/{id}', name: 'classroom_edit')]
    public function classroomEdit ($id, ClassroomRepository $ClassroomRepository, Request $request, ManagerRegistry $managerregistry):Response{
        $classroom = $ClassroomRepository->find($id);
        if ($classroom == null){
            $this->addFlash('Warning', 'This class does not existed!');
            return $this->redirectToRoute('app_classroom_crud');
        }
        else{
            $form = $this->createForm(ClassType::class,$classroom);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $manager = $managerregistry->getManager();
                $manager->persist($classroom);
                $manager->flush();
                $this->addFlash('Info', 'Edit class info successfully');
                return $this->redirectToRoute('app_classroom');
            }
            return $this->renderForm('classroom_crud/edit_classroom.html.twig',
            [
                'classroomForm' => $form
            ]);
        }
    
    }

    #[Route('/delete/{id}', name: 'classroom_delete')]
    public function classroomDelete ($id, ManagerRegistry $managerRegistry) {
      $classroom = $managerRegistry->getRepository(Classroom::class)->find($id);
      if ($classroom == null) {
          $this->addFlash('Warning', 'class not existed !');
      
      } else {
          $manager = $managerRegistry->getManager();
          $manager->remove($classroom);
          $manager->flush();
          $this->addFlash('Info', 'Delete users successfully !');
      }
      return $this->redirectToRoute('app_classroom');
    }

    #[Route('/add', name: 'classroom_add')]
    public function classroomAdd (Request $request, ManagerRegistry $managerRegistry):Response {
      $class = new Classroom;
      $form = $this->createForm(ClassType::class,$class);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $manager = $managerRegistry->getManager();
          $manager->persist($class);
          $manager->flush();
          $this->addFlash('Info','Add classroom successfully !');
          return $this->redirectToRoute('app_classroom');
      }
      return $this->renderForm('classroom_crud/add_classroom.html.twig',
      [
          'classroomForm' => $form
      ]);
}
}
