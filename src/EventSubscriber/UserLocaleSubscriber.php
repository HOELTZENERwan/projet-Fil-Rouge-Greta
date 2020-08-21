<?php

namespace App\Subscribers;

use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class UserLocaleSubscriber implements EventSubscriberInterface
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();


        if (!is_null($user->getLocale()))
        {
            $this->session->set('_locale', $user->getLocale());
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => [
                ['onLogin' , 15]   
            ]
        ];
    }
}