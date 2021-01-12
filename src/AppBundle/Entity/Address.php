<?php

namespace AppBundle\Entity;

use AppBundle\Repository\AddressRepository;
use AppBundle\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Address
 *
 * @ORM\Table(name="entity_address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
{
    const SERVER_PATH_TO_IMAGE_FOLDER = __DIR__ . '/../../../' . 'uploads/uploads/object';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="object_type", type="string", nullable=true, options={"default" : "Rent"})
     */
    private $objectType;

    public function getObjectType(): ?string
    {
        return $this->objectType;
    }

    public function setObjectType(?string $objectType): self
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatead_at", type="datetime")
     */
    private $updateadAt;

    /**
     * @var string
     *
     * @ORM\Column(name="profile", type="string", length=255)
     */
    private $profile;

    /**
     * @var string
     *
     * @ORM\Column(name="city_area", type="string", length=255)
     */
    private $cityArea;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var int|null
     *
     * @ORM\Column(name="total_area", type="integer", nullable=true)
     */
    private $totalArea;

    /**
     * @var int|null
     *
     * @ORM\Column(name="floor", type="integer", nullable=true)
     */
    private $floor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="house_floor", type="integer", nullable=true)
     */
    private $houseFloor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cop", type="integer", nullable=true)
     */
    private $cop;

    /**
     * @ORM\Column(name="`status`", type="integer", options={"default" : 1})
     */
    private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }


    /**
     * @var int|null
     *
     * @ORM\Column(name="rental_rate", type="integer", nullable=true)
     */
    private $rentalRate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rental_m", type="integer", nullable=true)
     */
    private $rentalM;

    /**
     * @var string
     *
     * @ORM\Column(name="nds", type="string", length=255)
     */
    private $nds;

    /**
     * @var int|null
     *
     * @ORM\Column(name="total_payment", type="integer", nullable=true)
     */
    private $totalPayment;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_person", type="string", length=255)
     */
    private $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="percent", type="string", length=255)
     */
    private $percent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var File|UploadedFile
     *
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;


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
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Address
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateadAt.
     *
     * @param \DateTime $updateadAt
     *
     * @return Address
     */
    public function setUpdateadAt($updateadAt)
    {
        $this->updateadAt = $updateadAt;

        return $this;
    }

    /**
     * Get updateadAt.
     *
     * @return \DateTime
     */
    public function getUpdateadAt()
    {
        return $this->updateadAt;
    }

    /**
     * Set profile.
     *
     * @param string $profile
     *
     * @return Address
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile.
     *
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set cityArea.
     *
     * @param string $cityArea
     *
     * @return Address
     */
    public function setCityArea($cityArea)
    {
        $this->cityArea = $cityArea;

        return $this;
    }

    /**
     * Get cityArea.
     *
     * @return string
     */
    public function getCityArea()
    {
        return $this->cityArea;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Address
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set totalArea.
     *
     * @param int|null $totalArea
     *
     * @return Address
     */
    public function setTotalArea($totalArea = null)
    {
        $this->totalArea = $totalArea;

        return $this;
    }

    /**
     * Get totalArea.
     *
     * @return int|null
     */
    public function getTotalArea()
    {
        return $this->totalArea;
    }

    /**
     * Set floor.
     *
     * @param int|null $floor
     *
     * @return Address
     */
    public function setFloor($floor = null)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor.
     *
     * @return int|null
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set houseFloor.
     *
     * @param int|null $houseFloor
     *
     * @return Address
     */
    public function setHouseFloor($houseFloor = null)
    {
        $this->houseFloor = $houseFloor;

        return $this;
    }

    /**
     * Get houseFloor.
     *
     * @return int|null
     */
    public function getHouseFloor()
    {
        return $this->houseFloor;
    }

    /**
     * Set cop.
     *
     * @param int|null $cop
     *
     * @return Address
     */
    public function setCop($cop = null)
    {
        $this->cop = $cop;

        return $this;
    }

    /**
     * Get cop.
     *
     * @return int|null
     */
    public function getCop()
    {
        return $this->cop;
    }

    /**
     * Set rentalRate.
     *
     * @param int|null $rentalRate
     *
     * @return Address
     */
    public function setRentalRate($rentalRate = null)
    {
        $this->rentalRate = $rentalRate;

        return $this;
    }

    /**
     * Get rentalRate.
     *
     * @return int|null
     */
    public function getRentalRate()
    {
        return $this->rentalRate;
    }

    /**
     * Set rentalM.
     *
     * @param int|null $rentalM
     *
     * @return Address
     */
    public function setRentalM($rentalM = null)
    {
        $this->rentalM = $rentalM;

        return $this;
    }

    /**
     * Get rentalM.
     *
     * @return int|null
     */
    public function getRentalM()
    {
        return $this->rentalM;
    }

    /**
     * Set nds.
     *
     * @param string $nds
     *
     * @return Address
     */
    public function setNds($nds)
    {
        $this->nds = $nds;

        return $this;
    }

    /**
     * Get nds.
     *
     * @return string
     */
    public function getNds()
    {
        return $this->nds;
    }

    /**
     * Set totalPayment.
     *
     * @param int|null $totalPayment
     *
     * @return Address
     */
    public function setTotalPayment($totalPayment = null)
    {
        $this->totalPayment = $totalPayment;

        return $this;
    }

    /**
     * Get totalPayment.
     *
     * @return int|null
     */
    public function getTotalPayment()
    {
        return $this->totalPayment;
    }

    /**
     * Set contactPerson.
     *
     * @param string $contactPerson
     *
     * @return Address
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson.
     *
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set percent.
     *
     * @param string $percent
     *
     * @return Address
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent.
     *
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Address
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image.
     *
     * @param UploadedFile $image
     *
     * @return Address
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set state.
     *
     * @param string $state
     *
     * @return Address
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return Address
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }


    public function getImagePath(){
        return '../uploads/uploads/object/';
    }

}
