<?php

namespace App\Controller\Admin;

use App\Entity\Frais;
use App\Entity\Client;
use App\Entity\Trajet;
use App\Entity\TypeFrais;
use App\Entity\StatutFrais;
use App\Entity\Utilisateur;
use App\Repository\FraisRepository;
use App\Repository\ClientRepository;
use App\Repository\TrajetRepository;
use App\Repository\TypeFraisRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminDashboardController extends AbstractDashboardController
{
    protected $utilisateurRepository;
    protected $clientRepository;
    protected $trajetRepository;
    protected $fraisRepository;
    protected $typeFraisRepository;
    


    public function __construct(
        UtilisateurRepository $utilisateurRepository,
        FraisRepository $fraisRepository,
        TypeFraisRepository $typeFraisRepository,
        TrajetRepository $trajetRepository,
        ClientRepository $clientRepository
    )
    {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->trajetRepository = $trajetRepository;
        $this->fraisRepository = $fraisRepository;
        $this->clientRepository = $clientRepository;
        $this->typeFraisRepository = $typeFraisRepository;

    }



    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function index(): Response
    {
        //   return parent::index();

         // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        // return $this->redirect($routeBuilder->setController(ClientCrudController::class)->generateUrl());
 
        //  // you can also redirect to different pages depending on the current user
        //   if ('jane' === $this->getUser()->getUsername()) {
        //      return $this->redirect('...');
        //  }
        

          return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
              'countUtilisateurs' => $this->utilisateurRepository->countUtilisateurs(),
              'countClients' => $this->clientRepository->countClients(),
              'countTrajets' =>$this->trajetRepository->countTrajets() ,
              'countFrais' => $this->fraisRepository->countFrais(),
              'countTypeFrais' => $this->typeFraisRepository->countTypeFrais(),
              'typeFrais' => $this->typeFraisRepository->findAll(),
        
          ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EE Expense Manager : Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Clients', 'fa fa-address-card', Client::class);
        yield MenuItem::linkToCrud('Frais', 'fa fa-clipboard', Frais::class);
        yield MenuItem::linkToCrud('Trajets', 'fa fa-plane', Trajet::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', Utilisateur::class);
        yield MenuItem::linkToCrud('Statuts Frais', 'fa fa-tasks', StatutFrais::class);
        yield MenuItem::linkToCrud('Types de Frais', 'fa fa-layer-group', TypeFrais::class);
    }


    public function configureUserMenu(UserInterface $user): UserMenu 
    {
        return parent::configureUserMenu($user)
                ->setName($user->getUsername())
                ->setGravatarEmail($user->getEmail())
                ->displayUserAvatar(true);
    }

    /**
     * @Route("/admin/changeLocale", name="changeLocale")
     */
    public function changeLocale(Request $request)
    {
        $form = $this->createFormBuilder(null)
                ->add('locale', ChoiceType::class, [
                    'choices' => [
                        'Français' => 'fr_FR',
                        'English' => 'en_US'
                    ]
                ])
                ->add('save', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $locale = $form->getData()['locale'];
            $user = $this->getUser();
            $user->setLocale($locale);
            $em->persist($user);
            $em->flush();
        }

        return $this->render('bundles/EasyAdminBundle/locale.html.twig', [
            'form' => $form->createView()
        ]);        
    }
}
