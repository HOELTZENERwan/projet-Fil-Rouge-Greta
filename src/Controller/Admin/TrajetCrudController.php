<?php

namespace App\Controller\Admin;

use App\Entity\Trajet;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TrajetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trajet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('label'),
            DateField::new('dateDebut'),
            DateField::new('dateFin'),
            AssociationField::new('idClient'),
            TextEditorField::new('commentaire'),

        ];
    }
    
}
