<?php

namespace App\Listeners;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;

class RefreshedTokenListener implements EventSubscriberInterface {

    private $secure = false; 
    private $tokenTtl;

    public function __construct($tokenTtl){
        $this->tokenTtl = $tokenTtl;
    }

    public function setRefreshToken(AuthenticationSuccessEvent $event){       
        $refreshToken = $event->getData()['refresh_token'];
        $response = $event->getResponse();
        $data = $event->getData();
        dump($data);
        if($refreshToken){
            $response->headers->setCookie(
                new Cookie('REFRESH_TOKEN', $refreshToken,
                (new \DateTime())
                ->add(new \DateInterval('PT'. $this->tokenTtl. 'S'))
                ), null , null , false, $this->secure
            );
        }


    }

    public static function getSubscribedEvents(){
        return [
            'lexik_jwt_authentication.on_authentication_success' => [
                ['setRefreshToken']
            ]
        ];
    }
}