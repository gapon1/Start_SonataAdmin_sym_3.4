<?php

namespace AppBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
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


    /**
     * @ORM\OneToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driverIdOrd;

    /**
     * @return mixed
     */
    public function getDriverIdOrd()
    {
        return $this->driverIdOrd;
    }

    /**
     * @param mixed $driverIdOrd
     */
    public function setDriverIdOrd($driverIdOrd): void
    {
        $this->driverIdOrd = $driverIdOrd;
    }


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CarAdmin", inversedBy="orders")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
     */
    private $car;

    /**
     * @return mixed
     */
    public function getCar(): ?string
    {
        return $this->car;
    }

    public function __toString()
    {
        return $this->getCar();
    }

    /**
     * @param mixed $car
     */
    public function setCar(CarAdmin $car)
    {
        $this->car = $car;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userOrder;


    public function getUserOrder(): int
    {
        return $this->userOrder;
    }

    public function setUserOrder(User $userOrder): self
    {
        $this->setUserOrder($userOrder);

        return $this;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string")
     */
    private $profile;

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile($profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setTotalArea($totalArea): self
    {
        $this->totalArea = $totalArea;

        return $this;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $complexName;

    public function getComplexName()
    {
        return $this->complexName;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $district;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $totalArea;

    /**
     * @ORM\Column(type="string")
     */
    private $floor;

    /**
     * @ORM\Column(type="string")
     */
    private $flooring;

    /**
     * @ORM\Column(type="string")
     */
    private $priceM;

    /**
     * @ORM\Column(type="string")
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="string")
     */
    private $photo;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $comments;

    public function getTotalArea()
    {
        return $this->totalArea;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function setAddress($address): self
    {
        $this->address = $address;

        return $this;
    }

    public function setDistrict($district): self
    {
        $this->district = $district;

        return $this;
    }

    public function setFloor($floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function setFlooring($flooring): self
    {
        $this->flooring = $flooring;

        return $this;
    }

    public function setPriceM($priceM): self
    {
        $this->priceM = $priceM;

        return $this;
    }

    public function setTotalPrice($totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setComments($comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getFlooring()
    {
        return $this->flooring;
    }

    public function getPriceM()
    {
        return $this->priceM;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $fromAddress
     */
    public function setFromAddress($fromAddress): void
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * @param mixed $status
     */
    public function setComplexName($complexName): void
    {
        $this->complexName = $complexName;
    }

    /**˜
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
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