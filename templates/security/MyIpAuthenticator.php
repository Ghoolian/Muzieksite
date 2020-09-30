<?php


namespace App\Security;


// src/Security/MyIpAuthenticator.php
// ...

use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class MyIpAuthenticator
{
     private $security;

     public function __construct(Security $security)
        {
        $this->security = $security;
        }

    public function supports(Request $request)
{
             // if there is already an authenticated user (likely due to the session)
             // then return false and skip authentication: there is no need.
             if ($this->security->getUser()) {
                 return false;
         }

         // the user is not logged in, so the authenticator should continue
         return true;
    }
}