<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class UserRepository extends EntityRepository
{
    public function getUserId()
    {
        $session = new Session();
        $userId = $session->get('UserInfo');


        return $this->createQueryBuilder('user')
            ->where('user.email = :userEmail')
            ->setParameter('userEmail', $userId);
    }

}