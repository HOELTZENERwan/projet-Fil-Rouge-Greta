<?php

namespace App\Controller\Admin;

use App\Entity\Frais;
use App\Entity\Client;
use App\Entity\Trajet;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class AdminDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function index(): Response
    {
        //   return parent::index();

         // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ClientCrudController::class)->generateUrl());
 
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
        yield MenuItem::linkToCrud('Clients', 'fa fa-file-pdf', Client::class);
        yield MenuItem::linkToCrud('Frais', 'fa fa-file-pdf', Frais::class);
        yield MenuItem::linkToCrud('Trajets', 'fa fa-file-pdf', Trajet::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-file-pdf', Utilisateur::class);

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
