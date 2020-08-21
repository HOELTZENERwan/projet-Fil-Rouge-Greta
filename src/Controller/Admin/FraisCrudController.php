<?php

namespace App\Controller\Admin;

use App\Entity\Frais;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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

       $imageFile = ImageField::new('scanFile')->setFormType(VichImageType::class)
                                                ->setLabel('Choisir un fichier');
       
        $image = ImageField::new('scan')->setBasePath('uploads/images/scans')
                                    ->setLabel('Note de frais');


        $fields  = [
                MoneyField::new('montant')->setCurrency('EUR'),
                DateTimeField::new('date'),
                TextEditorField::new('commentaire'),
                AssociationField::new('idTypeFrais'),
                AssociationField::new('idStatutFrais'),
                AssociationField::new('idCommercial'),
                AssociationField::new('idTrajet')
        ];

        if($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL){
          $fields[]= $image;
        }else{
            $fields[]=$imageFile;
        }

        return $fields;
    }
    
}
