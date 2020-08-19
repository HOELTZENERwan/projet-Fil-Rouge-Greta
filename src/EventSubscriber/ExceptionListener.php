<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
                ['logException', 0],
                ['notifyException', -10],
            ],
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        // ...
    }

    public function logException(ExceptionEvent $event)
    {
        // ...
    }

    public function notifyException(ExceptionEvent $event)
    {
        // ...
    }
}

// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpKernel\Event\ExceptionEvent;
// use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

// class ExceptionListener
// {
//     public function onKernelException(ExceptionEvent $event)
//     {
//         // You get the exception object from the received event
//         $exception = $event->getThrowable();
//         $message = sprintf(
//             'My Error says: %s with code: %s',
//             $exception->getMessage(),
//             $exception->getCode()
//         );

//         // Customize your response object to display the exception details
//         $response = new Response();
//         $response->setContent($message);

//         // HttpExceptionInterface is a special type of exception that
//         // holds status code and header details
//         if ($exception instanceof HttpExceptionInterface) {
//             $response->setStatusCode($exception->getStatusCode());
//             $response->headers->replace($exception->getHeaders());
//         } else {
//             $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
//         }

//         // sends the modified response object to the event
//         $event->setResponse($response);
//     }
// }