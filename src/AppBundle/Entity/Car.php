<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 * @ORM\Table(name="car")
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

//    /**
//     *
//     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
//     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
//     */
//    private $driver_id;
//
//    /**
//     * @return mixed
//     */
//    public function getDriverId(): int
//    {
//        return $this->driver_id;
//    }
//
//    /**
//     * @param mixed $driver_id
//     */
//    public function setDriverId(int $driver_id)
//    {
//        $this->driver_id = $driver_id;
//    }
//
//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Orders", mappedBy="car")
//     *
//     */
//    private $car_id;
//
//    public function __construct()
//    {
//        $this->car_id = new ArrayCollection();
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getCarId(): int
//    {
//        return $this->car_id;
//    }
//
//    /**
//     * @param mixed $car_id
//     */
//    public function setCarId(int $car_id)
//    {
//        $this->car_id = $car_id;
//    }

    /**
     * @ORM\Column(type="string")
     */
    private $carName;

    /**
     * @ORM\Column(type="string")
     */
    private $carType;


    /**
     * @ORM\Column(type="string")
     */
    private $carDiscript;

    /**
     * @ORM\Column(type="string")
     */
    private $carImg;

    /**
     * @return mixed
     */
    public function getCarImg(): ?string
    {
        return $this->carImg;
    }

    /**
     * @param mixed $carImg
     */
    public function setCarImg(string $carImg)
    {
        $this->carImg = $carImg;
    }

    /**
     * @return mixed
     */
    public function getCarDiscript(): string
    {
        return $this->carDiscript;
    }

    /**
     * @param mixed $carDiscript
     */
    public function setCarDiscript(string $carDiscript)
    {
        $this->carDiscript = $carDiscript;
    }

    /**
     * @return mixed
     */
    public function getCarType(): string
    {
        return $this->carType;
    }

    /**
     * @param mixed $carType
     */
    public function setCarType(string $carType)
    {
        $this->carType = $carType;
    }

    /**
     * @return mixed
     */
    public function getCarName(): string
    {
        return $this->carName;
    }

    /**
     * @param mixed $carName
     */
    public function setCarName(string $carName)
    {
        $this->carName = $carName;
    }

    public function __toString()
    {
        return $this->getCarName();
    }

    public function getUpdatedAt(): object
    {
        return new \DateTime('-' . rand(0, 100) . 'days');
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

}