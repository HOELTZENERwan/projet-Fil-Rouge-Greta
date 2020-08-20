<?php

namespace App\Controller\Admin;

use App\Entity\Frais;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FraisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Frais::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
         
            MoneyField::new('montant')->setCurrency('EUR'),
            DateTimeField::new('date'),
            TextEditorField::new('scan'),
            TextEditorField::new('commentaire'),
            AssociationField::new('idTypeFrais'),
            AssociationField::new('idStatutFrais'),
            AssociationField::new('idCommercial'),
            AssociationField::new('idTrajet')
        ];
    }
    
}
