<?php

namespace App\Controller\Admin;

use App\Entity\StatutFrais;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatutFraisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatutFrais::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
