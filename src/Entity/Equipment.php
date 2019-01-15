<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentRepository")
 */
class Equipment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Accomodation", mappedBy="equipments")
     */
    private $accomodation_equipments;

    public function __construct()
    {
        $this->accomodation_equipments = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection|Accomodation[]
     */
    public function getAccomodationEquipments(): Collection
    {
        return $this->accomodation_equipments;
    }

    public function addAccomodationEquipment(Accomodation $accomodationEquipment): self
    {
        if (!$this->accomodation_equipments->contains($accomodationEquipment)) {
            $this->accomodation_equipments[] = $accomodationEquipment;
            $accomodationEquipment->addEquipment($this);
        }

        return $this;
    }

    public function removeAccomodationEquipment(Accomodation $accomodationEquipment): self
    {
        if ($this->accomodation_equipments->contains($accomodationEquipment)) {
            $this->accomodation_equipments->removeElement($accomodationEquipment);
            $accomodationEquipment->removeEquipment($this);
        }

        return $this;
    }
}
