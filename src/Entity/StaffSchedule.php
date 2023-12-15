<?php

namespace App\Entity;

use App\Repository\StaffScheduleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffScheduleRepository::class)]
class StaffSchedule extends Calendar
{

}
