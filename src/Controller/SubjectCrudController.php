<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubjectCrudController extends AbstractController
{
    #[Route('/subject/crud', name: 'app_subject_crud')]
    public function index(SubjectRepository $SubjectRepository): Response
    {
        $sub=$SubjectRepository->findAll();
        return $this->render('subject_crud/index.html.twig',
        [
            'subj' => $sub
        ]);
    }
    #[Route('subject/edit/{id}', name: 'subject_edit')]
    public function classroomEdit ($id, SubjectRepository $SubjectRepository, Request $request, ManagerRegistry $managerregistry):Response{
        $sub = $SubjectRepository->find($id);
        if ($sub == null){
            $this->addFlash('Warning', 'This subject does not existed!');
            return $this->redirectToRoute('app_subject_crud');
        }
        else{
            $form = $this->createForm(SubjectType::class,$sub);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $manager = $managerregistry->getManager();
                $manager->persist($sub);
                $manager->flush();
                $this->addFlash('Info', 'Edit class info successfully');
                return $this->redirectToRoute('app_subject_crud');
            }
            return $this->renderForm('subject_crud/edit_subject.html.twig',
            [
                'subjectForm' => $form
            ]);
        }
    
    }

    #[Route('subject/delete/{id}', name: 'subject_delete')]
    public function subjectDelete ($id, ManagerRegistry $managerRegistry) {
      $sub = $managerRegistry->getRepository(Subject::class)->find($id);
      if ($sub == null) {
          $this->addFlash('Warning', 'class not existed !');
      
      } else {
          $manager = $managerRegistry->getManager();
          $manager->remove($sub);
          $manager->flush();
          $this->addFlash('Info', 'Delete users successfully !');
      }
      return $this->redirectToRoute('app_subject_crud');
    }

    #[Route('/subject/add', name: 'subject_add')]
    public function subjectAdd (Request $request, ManagerRegistry $managerRegistry):Response {
      $sub = new Subject;
      $form = $this->createForm(SubjectType::class,$sub);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $manager = $managerRegistry->getManager();
          $manager->persist($sub);
          $manager->flush();
          $this->addFlash('Info','Add Subject successfully !');
          return $this->redirectToRoute('app_subject_crud');
      }
      return $this->renderForm('subject_crud/add_subject.html.twig',
      [
          'subjectForm' => $form
      ]);
}
}
