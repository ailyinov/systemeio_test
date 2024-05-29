<?php

namespace App\Entity;

use App\Repository\TaxIdRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxIdRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TaxId
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $country_code;

    #[ORM\Column]
    private int $percent;

    #[ORM\Column(length: 255)]
    private string $format;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $updated;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $created;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): static
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
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

    public function getPercent(): int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): static
    {
        $this->percent = $percent;

        return $this;
    }
}
