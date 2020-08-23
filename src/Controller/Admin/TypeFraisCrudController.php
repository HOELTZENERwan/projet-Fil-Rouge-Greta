<?php

namespace App\Controller\Admin;

use App\Entity\TypeFrais;
use App\Repository\FraisRepository;
use App\Repository\TypeFraisRepository;


use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeFraisCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return TypeFrais::class;
    }

    public function __construct(
        FraisRepository $fraisRepository,
        TypeFraisRepository $typeFraisRepository
    ){
        $this->typeFraisRepository = $typeFraisRepository;
        $this->fraisRepository = $fraisRepository;
    }


    
    public function configureFields(string $pageName): iterable
    {
        
        //récupérer la collection de frais associés à un type de frais
    //    $typesFrais = $this->typeFraisRepository->findAll();
    //    foreach($typesFrais as $typeFrais){
    //         dump($typeFrais->getLabel());
    //         $totalFrais = count($this->fraisRepository->findByTypeFrais($typeFrais));
    //    }
    
       

        return [
            IdField::new('id'),
            TextField::new('label'),
            AssociationField::new('allFrais')
            
            // ArrayField::new('count'),
            // NumberField::new('count')
        ];
    }
    
}
