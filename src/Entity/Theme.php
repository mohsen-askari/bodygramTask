<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ThemeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
#[
    ApiResource(
        operations: [
            new Get(),
            new Post(),
            new Patch(),
            new Put(),
            new GetCollection()
        ]
    ),

    ApiFilter(  
        SearchFilter::class, 
        properties:[
            "name" => SearchFilter::STRATEGY_PARTIAL,
            "isDefault" => SearchFilter::STRATEGY_IPARTIAL
        ]
    )
]

class Themes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name;

    #[ORM\Column]
    private array $colors = [];

    #[ORM\Column]
    private ?bool $isDefault = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getColors(): array
    {
        return $this->colors;
    }

    public function setColors(array $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    public function isDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): static
    {
        $this->isDefault = $isDefault;

        return $this;
    }
}
