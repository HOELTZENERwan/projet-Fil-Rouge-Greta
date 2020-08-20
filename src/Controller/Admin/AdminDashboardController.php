<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
          return parent::index();

         // redirect to some CRUD controller
        // $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        // return $this->redirect($routeBuilder->setController(OneOfYourCrudController::class)->generateUrl());
 
        //  // you can also redirect to different pages depending on the current user
        //  if ('jane' === $this->getUser()->getUsername()) {
        //      return $this->redirect('...');
        //  }
 
         // you can also render some template to display a proper Dashboard
         // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //  return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EE Expense Manager : Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);

        // return [
        //     MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

        //     MenuItem::section('Frais'),
        //     MenuItem::linkToCrud('Frais', 'fa fa-tags', Frais::class),
        //     MenuItem::linkToCrud('Trajets', 'fa fa-file-text', Trajet::class),

        //     MenuItem::section('Utilisateurs'),
        //     MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', Utilisateur::class),
        //     MenuItem::linkToCrud('Users', 'fa fa-user', User::class),

        //     MenuItem::section('Clients'),
        //     MenuItem::linkToCrud('Clients', 'fa fa-customer', Client::class),
        //     // MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        // ];


    }
}
