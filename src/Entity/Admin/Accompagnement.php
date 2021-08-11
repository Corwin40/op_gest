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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAcc::class, inversedBy="accompagnements")
     */
    private $TypeAcc;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeAcc(): ?TypeAcc
    {
        return $this->TypeAcc;
    }

    public function setTypeAcc(?TypeAcc $TypeAcc): self
    {
        $this->TypeAcc = $TypeAcc;

        return $this;
    }
}
