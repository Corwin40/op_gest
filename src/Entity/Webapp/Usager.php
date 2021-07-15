<?php

namespace App\Entity\Webapp;

use App\Repository\Webapp\UsagerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsagerRepository::class)
 */
class Usager
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $countUsager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCountUsager(): ?int
    {
        return $this->countUsager;
    }

    public function setCountUsager(int $countUsager): self
    {
        $this->countUsager = $countUsager;

        return $this;
    }
}
