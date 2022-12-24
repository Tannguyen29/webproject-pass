<?php

namespace App\Controller;

use App\Entity\Userdetail;
use App\Form\UserdetailType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Repository\UserdetailRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentCrudController extends AbstractController
{
    #[Route('/crud', name: 'app_student_crud')]
    public function studentindex (UserRepository $UserRepository):Response {
        $users=$UserRepository->findAll();
        return $this->render('student_crud/index.html.twig',
            [
                'users' => $users
            ]);
      }

      #[Route('studentdetail/crud', name: 'app_student_detail_crud')]
    public function studendetailtindex (UserdetailRepository $UserdetailRepository):Response {
        $userdetails=$UserdetailRepository->findAll();
        return $this->render('userdetail/index.html.twig',
            [
                'userdetails' => $userdetails
            ]);
      }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function studentDetail ($id, UserdetailRepository $UserdetailRepository) {
      $userdetails = $UserdetailRepository->find($id);
      if ($userdetails== null) {
          $this->addFlash('Warning', 'Invalid user id !');
          return $this->redirectToRoute('app_student_detail_crud');
      }
      return $this->render('userdetail/detail.html.twig',
          [
              'userdetails' => $userdetails
          ]);
    }
    

  #[Route('/delete/{id}', name: 'student_delete')]
  public function studentDelete ($id, ManagerRegistry $managerRegistry) {
    $users = $managerRegistry->getRepository(User::class)->find($id);
    if ($users == null) {
        $this->addFlash('Warning', 'users not existed !');
    
    } else {
        $manager = $managerRegistry->getManager();
        $manager->remove($users);
        $manager->flush();
        $this->addFlash('Info', 'Delete users successfully !');
    }
    return $this->redirectToRoute('app_student_detail_crud');
  }

  
  #[Route('/edit/{id}', name: 'student_edit')]
  public function studentEdit ($id , UserRepository $UserRepository, Request $request,  ManagerRegistry $managerRegistry):Response {
    $users = $UserRepository->find($id);
    if ($users == null) {
        $this->addFlash('Warning', 'users not existed !');
        return $this->redirectToRoute('app_student_detail_crud');
    } else {
        $form = $this->createForm(RegistrationFormType::class,$users);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($users);
            $manager->flush();
            $this->addFlash('Info','Edit users successfully !');
            return $this->redirectToRoute('app_student_detail_crud');
        }
        return $this->renderForm('userdetail/edit.html.twig',
        [
            'userForm' => $form
        ]);
    }
}
}
