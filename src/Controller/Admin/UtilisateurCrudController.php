<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    
    public function __construct(
        UtilisateurRepository $utilisateurRepository
    ){
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function configureFields(string $pageName): iterable
    {

         $user = $this->getUser();

        //  $admins= ['ROLE_USER'];

         $admin =  $this->utilisateurRepository->findOneByRole();
        
        // if($this->getEntityFqcn() !== $admin){
        //  $entity = $this->context->getEntity();   

         if($admin  !== null ){
            $fields = [
                IdField::new('id')->hideOnForm(),
                EmailField::new('email'),
                TextField::new('nom'),
                TextField::new('prenom'),
                TelephoneField::new('telephone'),
                ArrayField::new('roles'),
                AssociationField::new('clients')
            ];
        }else{
            $fields = [];
        }


        dump($admin);

        return $fields;
    }

}
       
