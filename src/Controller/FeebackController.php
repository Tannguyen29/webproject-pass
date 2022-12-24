<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeebackController extends AbstractController
{
    #[Route('/feedback', name: 'app_feedback')]
    public function feedbackindex (FeedbackRepository $FeedbackRepository):Response {
        $feedbacks=$FeedbackRepository->findAll();
        return $this->render('feedback/index.html.twig',
            [
                'feedbacks' => $feedbacks
            ]);
      }

      #[Route('/feedback/add', name: 'feedback_add')]
      public function feedbackAdd (Request $request, ManagerRegistry $managerRegistry):Response {
        $feedbacks = new Feedback;
        $form = $this->createForm(FeedbackType::class,$feedbacks);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($feedbacks);
            $manager->flush();
            $this->addFlash('Info','Add feedback successfully !');
            return $this->redirectToRoute('app_student');
        }
        return $this->renderForm('feedback/feedback_add.html.twig',
        [
            'feedbackForm' => $form
        ]);
}

#[IsGranted("ROLE_ADMIN")]
#[Route('feedback/detail/{id}', name: 'feedback_detail')]
public function feedbackDetail ($id,FeedbackRepository $FeedbackRepository) {
  $feedbacks = $FeedbackRepository->find($id);
  if ($feedbacks== null) {
      $this->addFlash('Warning', 'Invalid feedback id !');
      return $this->redirectToRoute('app_admin');
  }
  return $this->render('feedback/feedback_detail.html.twig',
      [
          'feedbacks' => $feedbacks
      ]);
}
#[IsGranted("ROLE_ADMIN")]
#[Route('feedback/delete/{id}', name: 'feedback_delete')]
public function feedbackDelete ($id,ManagerRegistry $managerRegistry) {
  $feedbacks = $managerRegistry->getRepository(FeedbackType::class)->find($id);
  if ($feedbacks == null) {
      $this->addFlash('Warning', 'users not existed !');
  
  } else {
      $manager = $managerRegistry->getManager();
      $manager->remove($feedbacks);
      $manager->flush();
      $this->addFlash('Info', 'Delete users successfully !');
  }
  return $this->redirectToRoute('app_feedback');
}
}
