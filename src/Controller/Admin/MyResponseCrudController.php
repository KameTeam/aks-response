<?php

namespace App\Controller\Admin;

use App\Entity\MyResponse;
use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MyResponseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MyResponse::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $allQuestion = $this->getDoctrine()->getRepository(Question::class)->findAll();
        $tableau[] = null;
        if($allQuestion){
            foreach($allQuestion as $question){
                $tableau[$question->getText()] = $question;
            }

        }
        return [
            TextField::new('text'),
            ChoiceField::new('question')->setChoices($tableau)->hideOnIndex()
        ];
    }
    
}
