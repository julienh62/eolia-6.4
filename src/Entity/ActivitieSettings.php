<?php

namespace App\Entity;

use App\Repository\ActivitieSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitieSettingsRepository::class)]
class ActivitieSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $textColor = null;

    #[ORM\Column(length: 255)]
    private ?string $borderColor = null;

    #[ORM\Column(length: 255)]
    private ?string $backGroundColor = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\OneToOne(inversedBy: 'activitieSettings', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activitie $activitie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }




    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): static
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->borderColor;
    }

    public function setBorderColor(string $borderColor): static
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    public function getBackGroundColor(): ?string
    {
        return $this->backGroundColor;
    }

    public function setBackGroundColor(string $backGroundColor): static
    {
        $this->backGroundColor = $backGroundColor;

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

    public function getActivitie(): ?Activitie
    {
        return $this->activitie;
    }

    public function setActivitie(Activitie $activitie): static
    {
        $this->activitie = $activitie;

        return $this;
    }
}
