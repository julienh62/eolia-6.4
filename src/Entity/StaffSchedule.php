<?php

namespace App\Entity;

use App\Repository\StaffScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffScheduleRepository::class)]
class StaffSchedule extends Calendar
{

}
