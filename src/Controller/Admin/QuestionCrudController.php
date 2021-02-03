<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Admin\MapField;
use App\Repository\CategorieRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceFieldName;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $allCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $tableau[] = null;
        if($allCategorie){

            foreach($allCategorie as $categorie){
               $tableau[$categorie->getName()] = $categorie;
           }
        }
        return [
            TextField::new('text'),
            BooleanField::new('valide'),
            ChoiceField::new('categorie')->setChoices($tableau)->hideOnIndex()
        ];
    }
    
}
