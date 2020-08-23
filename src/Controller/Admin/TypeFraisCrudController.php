<?php

namespace App\Controller\Admin;

use App\Entity\TypeFrais;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeFraisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeFrais::class;
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
