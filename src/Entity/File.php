<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    #[ORM\Column]
    private ?int $maxSize = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Directory::class, mappedBy: 'files')]
    private Collection $directories;

    public function __construct()
    {
        $this->directories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getMaxSize(): ?int
    {
        return $this->maxSize;
    }

    public function setMaxSize(int $maxSize): static
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
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

    /**
     * @return Collection<int, Directory>
     */
    public function getDirectories(): Collection
    {
        return $this->directories;
    }

    public function addDirectory(Directory $directory): static
    {
        if (!$this->directories->contains($directory)) {
            $this->directories->add($directory);
            $directory->addFile($this);
        }

        return $this;
    }

    public function removeDirectory(Directory $directory): static
    {
        if ($this->directories->removeElement($directory)) {
            $directory->removeFile($this);
        }

        return $this;
    }
}
