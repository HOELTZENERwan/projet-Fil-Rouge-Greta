<?php

namespace App\Controller\Admin;

use App\Entity\Frais;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FraisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Frais::class;
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
