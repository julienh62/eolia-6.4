<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffRepository::class)]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;


    #[ORM\ManyToMany(targetEntity: Calendar::class, inversedBy: 'staffs')]
    private $calendars;


    public function __construct()
    {
        $this->calendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->fullName;
    }
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): static
    {
        $this->calendars = $this->calendars;

        if (!$this->calendars->contains($calendar)) {
            $this->calendars->add($calendar);
            $calendar->addStaff($this);
        }

        return $this;
    }

    public function setCalendar(?Calendar $calendar): static
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function removeCalendar(Calendar $calendar): static
    {
        if ($this->calendars->removeElement($calendar)) {
            // Assurez-vous de retirer le membre du personnel du calendrier si nécessaire
            $calendar->removeStaff($this);
        }

        return $this;
    }

  //  /**
 //    * @return Collection<int, Calendar>
 //    */
  /*  public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): static
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars->add($calendar);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): static
    {
        $this->calendars->removeElement($calendar);

        return $this;
    } /*/
}
