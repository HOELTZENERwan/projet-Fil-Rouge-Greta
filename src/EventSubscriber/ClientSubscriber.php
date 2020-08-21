<?php 

namespace App\EventSubscriber;

use App\Entity\Client;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class ClientSubscriber implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setAddedBy']
        ];
    }

    public function setAddedBy(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if($entity instanceof Client){
            $entity->setAddedBy($this->security->getUser());
        }
        // dd($entity); 
    }
}