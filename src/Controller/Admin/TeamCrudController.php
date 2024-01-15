<?php

namespace App\Controller\Admin;

use App\Entity\Team;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TeamCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Team::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('country'),
            TextField::new('city'),
            ImageField::new('logo')
                ->setBasePath('uploads/images/teams')
                ->onlyOnIndex(),
            TextareaField::new('logoFile')
                ->setFormType(VichImageType::class)
                ->setFormTypeOption('delete_label', 'Confirm Update ?')
                ->hideOnIndex(),
        ];
    }
    
}
