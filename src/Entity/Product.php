<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private float $price;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTime $updated;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTime $created;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @NOTE: price must not be float in a real app
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    public function setUpdated(): static
    {
        $this->updated = new DateTime("now");

        return $this;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updated = new \DateTime("now");
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->created = new \DateTime("now");
        $this->onPreUpdate();
    }
}
