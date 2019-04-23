<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

//    /**
//     * @ORM\Column(type="string")
//     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
//     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id"))
//     */
//    private $driver_id;
//
//    /**
//     * @return mixed
//     */
//    public function getDriverIdOrd()
//    {
//        return $this->driver_id;
//    }
//
//    /**
//     * @param mixed $driver_id
//     */
//    public function setDriverIdOrd($driver_id)
//    {
//        $this->driver_id = $driver_id;
//    }
//
//    /**
//     * @Assert\NotBlank()
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Car", inversedBy="orders")
//     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
//     */
//    private $car;
//
//    /**
//     * @return mixed
//     */
//    public function getCar(): string
//    {
//        return $this->car;
//    }
//
//    /**
//     * @param mixed $car
//     */
//    public function setCar(Car $car)
//    {
//        $this->car = $car;
//    }
//
//    /**
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     */
//    private $userOrder;
//
//
//    public function getUserOrder(): int
//    {
//        return $this->userOrder;
//    }
//
//    public function setUserOrder(User $userOrder):self
//    {
//        $this->setUserOrder($userOrder);
//
//        return $this;
//    }

    /**
     * @ORM\Column(type="string")
     */
    private $fromAddress;

    /**
     * @ORM\Column(type="string")
     */
    private $toAddress;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @return mixed
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param mixed $fromAddress
     */
    public function setFromAddress($fromAddress): void
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * @return mixed
     */
    public function getToAddress()
    {
        return $this->toAddress;
    }

    /**
     * @param mixed $toAddress
     */
    public function setToAddress($toAddress): void
    {
        $this->toAddress = $toAddress;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;
    }


}