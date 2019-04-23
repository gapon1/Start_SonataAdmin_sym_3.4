<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;

class CarRepository extends EntityRepository
{
    /**
     * @return Car[]|ArrayCollection
     */
    public function getFreeCars(): array
    {
        return $this->createQueryBuilder('car')
            ->select('car.carName', 'carId.status', 'user.name', 'carId.id')
            ->join('car.driver_id', 'user')
            ->leftJoin('car.car_id', 'carId')
            ->where('carId.status = :status')
            ->setParameter('status', 'finished')
            ->orderBy('car.carName', 'ASC')
            ->getQuery()
            ->execute();
    }


    public function getCar()
    {
        return $this->createQueryBuilder('car')
            ->leftJoin('car.car_id', 'carId')
            ->where('carId.status = :status')
            ->setParameter('status', 'finished')
            ->orderBy('car.carName', 'ASC');
    }

}