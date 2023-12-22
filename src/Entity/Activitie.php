<?php

namespace App\Entity;

use App\Repository\ActivitieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ActivitieRepository::class)]
class Activitie extends Calendar
{

    #[ORM\Column]
    protected ?int $stock = null;

    #[ORM\Column]
    protected ?int $price = null;

    #[ORM\Column]
    protected ?int $modifiedPrice = null;

    #[ORM\OneToOne(mappedBy: 'activitie', cascade: ['persist', 'remove'])]
    private ?ActivitieSettings $activitieSettings = null;


    public function __toString()
    {
        return $this->title;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getModifiedPrice(): ?int
    {
        return $this->modifiedPrice;
    }

    public function setModifiedPrice(int $modifiedPrice): static
    {
        $this->modifiedPrice = $modifiedPrice;

        return $this;
    }

    public function getActivitieSettings(): ?ActivitieSettings
    {
        return $this->activitieSettings;
    }

    public function setActivitieSettings(ActivitieSettings $activitieSettings): static
    {
        // set the owning side of the relation if necessary
        if ($activitieSettings->getActivitie() !== $this) {
            $activitieSettings->setActivitie($this);
        }

        $this->activitieSettings = $activitieSettings;

        return $this;
    }
}
