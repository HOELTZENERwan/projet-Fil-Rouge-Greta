<?php

namespace App\Listeners;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationSuccessListener {

    //on stocke le token en cookies (httponly)
    private $secure = false; 
    private $tokenTtl;

    public function __construct($tokenTtl){
        $this->tokenTtl = $tokenTtl;
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event){
        //sur login_check on crée un cookie PHPSESSID qui contient le token
        $response = $event->getResponse();
        $data = $event->getData();
        $token = $data['token'];
    //on supprime le token
        // unset($data['token']);
       $user =$event->getUser();
       $event->setData($data);
       $response->headers->setCookie(
            new Cookie('BEARER', $token,
            (new \DateTime())
            ->add(new \DateInterval('PT'. $this->tokenTtl. 'S'))
            ), null , null , false, $this->secure
        );

    }
}