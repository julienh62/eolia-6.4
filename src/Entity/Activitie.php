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
}
