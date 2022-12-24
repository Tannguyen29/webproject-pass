<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\UserdetailRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('student/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/infor/{id}', name: 'student_Infor')]
public function student_Infor ($id, UserdetailRepository $UserdetailRepository)
 
{
    $user = $this->getUser();
  $userdetail = $UserdetailRepository->find($id);
  return $this->render('student/acc_infor.html.twig',
          [
               'userdetail' => $userdetail
              ,'user' =>$user
          ]);
  
}

}
