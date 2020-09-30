<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;


class ActivationSubscriber implements EventSubscriberInterface
{
    /**
     * @var User $user
     */
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage, ContainerInterface $container)
    {
        $this->container = $container;
        $this->tokenStorage = $this->container->get('security.token_storage');


    }

    public function onKernelFinishEvent($event)
    {
        if ($this->tokenStorage->getToken() != null && $this->tokenStorage->getToken()->getUser() != "anon.") {
            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();
            if ($user->getActivationCheck() != true) {

                $this->container->get('session')->getFlashBag()->add('error', 'Je moet je account activeren voordat je deze paginas mag bekijken');

             }
        }
    }
    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => 'onKernelFinishEvent',
        ];
    }
}
