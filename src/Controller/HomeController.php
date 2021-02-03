<?php

namespace App\Controller;

use App\Entity\MyResponse;
use App\Form\ResponseType;
use App\Repository\CategorieRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(QuestionRepository $questionRepository, CategorieRepository $categorieRepository, Request $reqest): Response
    {
        $allQuestion = $questionRepository->findAll();
        $allCategorie = $categorieRepository->findAll();
        $errors = null;
        if($reqest->isMethod('POST')){

          
            foreach($reqest->request as $key => $myRequest){
                if(empty($myRequest)){
                  
                    $errors = 'Veuillez remplire tout les formulaire, Répondez a toute les questions';

                }
               
            }
            if($errors === null){
                foreach($reqest->request as $key => $myRequest){
            
                    $idQuestion = explode('-', $key)[1];
                    $question = $questionRepository->find($idQuestion);
                    $myResponses = new MyResponse();
                    $myResponses->setQuestion($question);
                    $myResponses->setText($myRequest);

                    $question->setValide(true);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($myResponses);
                    $entityManager->flush();
                }
               
            }
        }

        return $this->render('home/index.html.twig', [
            'questions' => $allQuestion,
            'categories' => $allCategorie,
            'errors' => $errors,
            'controller_name' => 'HomeController',
        ]);
    }
}
