<?php

namespace App\Entity;

use App\Repository\ActivitieCategorySettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitieCategorySettingsRepository::class)]
class ActivitieCategorySettings extends CategorySettings
{


    #[ORM\Column]
    private ?int $price = null;



    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }
}
