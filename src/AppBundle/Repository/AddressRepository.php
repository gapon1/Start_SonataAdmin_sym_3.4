<?php

namespace AppBundle\Repository;

use AppBundle\Controller\AddressController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * AddressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AddressRepository extends EntityRepository
{
    /**
     * @return AddressController[]|ArrayCollection
     */
    public function getAddressStatus(): array
    {
        return $this->createQueryBuilder('addressArchive')
            ->select( 'addressArchive.id', 'addressArchive.name', 'addressArchive.address', 'addressArchive.status')
            ->where('addressArchive.status = :status')
            ->setParameter('status', 1)
            ->getQuery()
            ->execute();
    }

}