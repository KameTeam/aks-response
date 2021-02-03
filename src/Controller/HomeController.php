<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\MyResponse;
use App\Entity\Stagiaire as EntityStagiaire;
use App\Form\CompetenceType;
use App\Form\ResponseType;
use App\Form\StagiaireType;
use App\Repository\CategorieRepository;
use App\Repository\QuestionRepository;
use App\Repository\StagiaireRepository;
use DateTime;
use Doctrine\DBAL\Types\ObjectType;
use Exception;
use MyClass\Stagiaire;
use PDO;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(QuestionRepository $questionRepository, CategorieRepository $categorieRepository, Request $reqest, CompetenceType $competenceType): Response
    {
        /* Question 33 */
        $competence =new Competence();
        $formCompetence  = $this->createForm(CompetenceType::class, $competence);
        $formCompetence->handleRequest($reqest);
        if($formCompetence->isSubmitted() && $formCompetence->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($competence);
                    $entityManager->flush();
                    return $this->redirectToRoute('home');
        }
        /* Question 33 */

        /* Question 34 */

        $newStagiaire = new EntityStagiaire();
        $formStagiaire = $this->createForm(StagiaireType::class, $newStagiaire);
        $formStagiaire->handleRequest($reqest);
        if($formStagiaire->isSubmitted() && $formStagiaire->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($newStagiaire);
                    $entityManager->flush();
                    return $this->redirectToRoute('home');
        }


        /* Question 34 */


        $errors = null;
        $allQuestion = $questionRepository->findAll();
        $allCategorie = $categorieRepository->findAll();
        
        
        if($reqest->isMethod('POST')){

          
            foreach($reqest->request as $key => $myRequest){
                if(!empty($myRequest)){
                    $idQuestion = explode('-', $key)[1];
                    $question = $questionRepository->find($idQuestion);
                    $myResponses = new MyResponse();
                    $myResponses->setQuestion($question);
                    $myResponses->setText($myRequest);

                    $question->setValide(true);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($myResponses);
                    $entityManager->flush();
                    return $this->redirectToRoute('home');

                }
                else{
                    $errors = 'Veuillez remplire tout les formulaire, Répondez a toute les questions';
                }
            }
        }

        /* Question 7  */
            function multiplication($a, $b){
                return $a*$b;
            }
            $question7 = multiplication(5, 10);
        /* Fin question 7 */

        /* Question 14 */
       
         
    
                $db = new PDO('mysql:host=localhost;port=3306;dbname=exam_m2i', 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
                
        $query = $db->query(
            'SELECT * FROM `stagiaire`'
        );
        $stagiaires = [];
        foreach($query->fetchAll() as $stagiaire){
            
            $stagiaires[] =  $stagiaire;
        }
        dump($stagiaires);
        /* Question 14 */

        /* Question 23 */
        $testStagiaire = new Stagiaire(uniqid(), 'geoffrey', '01.01.01.01.01', '07/11/94', Date('NOW'));

        /*Question 23 */

        

        return $this->render('home/index.html.twig', [
            'questions' => $allQuestion,
            'categories' => $allCategorie,
            'errors' => $errors,
            'question7' => $question7,
            'db' => $stagiaires,
            'objet' => $testStagiaire,
            'formCompetence' => $formCompetence->createView(),
            'formStagiaire' => $formStagiaire->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
}
