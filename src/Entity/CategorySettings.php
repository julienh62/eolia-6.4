<?php

namespace App\Entity;

use App\Repository\CategorySettingsRepository;
use Doctrine\ORM\Mapping as ORM;

//#[ORM\Entity(repositoryClass: CategorySettingsRepository::class)]
#[ORM\Entity]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "category_settings" => "CategorySettings",
    "activitie_category_settings" => "ActivitieCategorySettings"
])]
class CategorySettings
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

    #[ORM\OneToOne(mappedBy: 'categorySetting', cascade: ['persist', 'remove'])]
    private ?Category $category = null;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        // unset the owning side of the relation if necessary
        if ($category === null && $this->category !== null) {
            $this->category->setCategorySetting(null);
        }

        // set the owning side of the relation if necessary
        if ($category !== null && $category->getCategorySetting() !== $this) {
            $category->setCategorySetting($this);
        }

        $this->category = $category;

        return $this;
    }
}
