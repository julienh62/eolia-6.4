<?php

namespace App\Entity;

use App\Repository\StaffScheduleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffScheduleRepository::class)]
class StaffSchedule extends Calendar
{
    #[ORM\OneToOne(mappedBy: 'staffSchedule', cascade: ['persist', 'remove'])]
    private ?StaffScheduleSettings $staffScheduleSettings = null;

    public function __toString()
    {
        return $this->title;
    }
    public function getStaffScheduleSettings(): ?StaffScheduleSettings
    {
        return $this->staffScheduleSettings;
    }

    public function setStaffScheduleSettings(StaffScheduleSettings $staffScheduleSettings): static
    {
        // set the owning side of the relation if necessary
        if ($staffScheduleSettings->getStaffSchedule() !== $this) {
            $staffScheduleSettings->setStaffSchedule($this);
        }

        $this->staffScheduleSettings = $staffScheduleSettings;

        return $this;
    }
}
