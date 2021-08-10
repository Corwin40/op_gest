<?php

namespace App\Entity\Admin;

use App\Repository\Admin\AccompagnementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccompagnementRepository::class)
 */
class Accompagnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $accompagnement = [];

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccompagnement(): ?array
    {
        return $this->accompagnement;
    }

    public function setAccompagnement(array $accompagnement): self
    {
        $this->accompagnement = $accompagnement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
