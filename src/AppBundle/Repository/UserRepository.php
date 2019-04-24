<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getUserId()
    {
        return $this->createQueryBuilder('user')
            ->where('user.email = :userEmail')
            ->setParameter('userEmail', 'root@ukr.net');
    }

}