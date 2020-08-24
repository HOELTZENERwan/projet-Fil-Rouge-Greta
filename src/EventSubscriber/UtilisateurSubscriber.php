<?php 

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/** 
 *  lorsqu'on crée un nouvel utilisateur depuis le CRUD AdminBundle,
 * le comptable/admin définit un mot de passe par défaut (à modifier par l'utilisateur plus tard)
 *  ce mot de passe est envoyé en string, donc ici on le hashe avant 
 * qu'il soit stocké dans la BDD
 */

class UtilisateurSubscriber implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private $security;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;


    public function __construct(Security $security, UserPasswordEncoderInterface $encoder)
    {
        $this->security = $security;
        $this->encoder = $encoder;
    }


    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setHashedPassword']
        ];
    }

    public function setHashedPassword(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        $hash = $this->encoder->encodePassword($entity, $entity->getPassword());
        if($entity instanceof Utilisateur){
            $entity->setPassword($hash);
        }
    }
}