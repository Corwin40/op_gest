<?php

namespace App\Entity\Admin;

use App\Repository\Admin\TypeAccRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeAccRepository::class)
 */
class TypeAcc
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Accompagnement::class, mappedBy="TypeAcc")
     */
    private $accompagnements;

    public function __construct()
    {
        $this->accompagnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Accompagnement[]
     */
    public function getAccompagnements(): Collection
    {
        return $this->accompagnements;
    }

    public function addAccompagnement(Accompagnement $accompagnement): self
    {
        if (!$this->accompagnements->contains($accompagnement)) {
            $this->accompagnements[] = $accompagnement;
            $accompagnement->setTypeAcc($this);
        }

        return $this;
    }

    public function removeAccompagnement(Accompagnement $accompagnement): self
    {
        if ($this->accompagnements->removeElement($accompagnement)) {
            // set the owning side to null (unless already changed)
            if ($accompagnement->getTypeAcc() === $this) {
                $accompagnement->setTypeAcc(null);
            }
        }

        return $this;
    }
}
