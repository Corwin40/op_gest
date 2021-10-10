<?php

namespace App\Entity\Admin;

use App\Repository\Admin\FormposteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FormposteRepository::class)
 * @ORM\HasLifecycleCallbacks()

 */
class Formposte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="l'adresse rentrée n'est pas au bon format")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Il nous faut au moins un numéro de téléphone")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $questions = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $besoins = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRgpd = false;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $internet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $computer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mediadevice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $printdevice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $otherdevice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getQuestions(): ?array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    public function getBesoins(): ?array
    {
        return $this->besoins;
    }

    public function setBesoins(array $besoins): self
    {
        $this->besoins = $besoins;

        return $this;
    }

    public function getIsRgpd(): ?bool
    {
        return $this->isRgpd;
    }

    public function setIsRgpd(bool $isRgpd): self
    {
        $this->isRgpd = $isRgpd;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DatetimeImmutable('now');
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DatetimeImmutable('now');
        return $this;
    }

    public function getInternet(): ?string
    {
        return $this->internet;
    }

    public function setInternet(string $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    public function getComputer(): ?string
    {
        return $this->computer;
    }

    public function setComputer(string $computer): self
    {
        $this->computer = $computer;

        return $this;
    }

    public function getMediadevice(): ?string
    {
        return $this->mediadevice;
    }

    public function setMediadevice(string $mediadevice): self
    {
        $this->mediadevice = $mediadevice;

        return $this;
    }

    public function getPrintdevice(): ?string
    {
        return $this->printdevice;
    }

    public function setPrintdevice(string $printdevice): self
    {
        $this->printdevice = $printdevice;

        return $this;
    }

    public function getOtherdevice(): ?string
    {
        return $this->otherdevice;
    }

    public function setOtherdevice(string $otherdevice): self
    {
        $this->otherdevice = $otherdevice;

        return $this;
    }
}
