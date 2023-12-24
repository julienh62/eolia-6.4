<?php

namespace App\Entity;

use App\Repository\StaffScheduleSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffScheduleSettingsRepository::class)]
class StaffScheduleSettings
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

    #[ORM\OneToOne(inversedBy: 'staffScheduleSettings', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?StaffSchedule $staffSchedule = null;

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

    public function getStaffSchedule(): ?StaffSchedule
    {
        return $this->staffSchedule;
    }

    public function setStaffSchedule(StaffSchedule $staffSchedule): static
    {
        $this->staffSchedule = $staffSchedule;

        return $this;
    }
}
