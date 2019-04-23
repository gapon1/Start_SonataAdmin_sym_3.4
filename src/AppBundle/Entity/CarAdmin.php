<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarAdmin
 *
 * @ORM\Table(name="car_admin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarAdminRepository")
 */
class CarAdmin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="car_name", type="string", length=255)
     */
    private $carName;

    /**
     * @var string
     *
     * @ORM\Column(name="carImg", type="string", length=255)
     */
    private $carImg;

    /**
     * @var string
     *
     * @ORM\Column(name="carType", type="string", length=255)
     */
    private $carType;

    /**
     * @var string
     *
     * @ORM\Column(name="carDiscript", type="string", length=255)
     */
    private $carDiscript;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $carName
     *
     * @return CarAdmin
     */
    public function setCarName($carName)
    {
        $this->carName = $carName;
        return $this;
    }

    /**
     * Get carName.
     *
     * @return string
     */
    public function getCarName()
    {
        return $this->carName;
    }

    /**
     * Set carImg.
     *
     * @param string $carImg
     *
     * @return CarAdmin
     */
    public function setCarImg($carImg)
    {
        $this->carImg = $carImg;
        return $this;
    }

    /**
     * Get carImg.
     *
     * @return string
     */
    public function getCarImg()
    {
        return $this->carImg;
    }

    /**
     * Set carType.
     *
     * @param string $carType
     *
     * @return CarAdmin
     */
    public function setCarType($carType)
    {
        $this->carType = $carType;
        return $this;
    }

    /**
     * Get carType.
     *
     * @return string
     */
    public function getCarType()
    {
        return $this->carType;
    }

    /**
     * Set carDiscript.
     *
     * @param string $carDiscript
     *
     * @return CarAdmin
     */
    public function setCarDiscript($carDiscript)
    {
        $this->carDiscript = $carDiscript;
        return $this;
    }

    /**
     * Get carDiscript.
     *
     * @return string
     */
    public function getCarDiscript()
    {
        return $this->carDiscript;
    }
}
