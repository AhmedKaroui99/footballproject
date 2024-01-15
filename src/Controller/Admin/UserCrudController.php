<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
    return [
        IdField::new('id')
        ->hideOnForm()
        ->hideOnIndex(),
        TextField::new('email'),
        ChoiceField::new('roles')
            ->setChoices([
                'admin' => 'ROLE_ADMIN',
                'user' => 'ROLE_USER',
                ])
            ->setRequired(isRequired: false)
            ->allowMultipleChoices(allow: true),
        TextField::new('plainPassword')->onlyOnForms(),


    ];
//      public function configureCrud(Crud $crud): Crud
//     {
//         return $crud
//         ->setEntityPermission('ROLE_ADMIN');
// }

}
}