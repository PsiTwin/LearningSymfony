<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("mashup")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups("mashup")
     */
    private string $name;

    /**
     * @ORM\Column(type="boolean")
     * @Ignore
     */
    private bool $isBanned;

    /**
     * @ORM\ManyToMany(targetEntity=Mashup::class, mappedBy="author")
     * @Ignore
     */
    private $mashup;

    public function __construct()
    {
        $this->mashup = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isIsBanned(): ?bool
    {
        return $this->isBanned;
    }

    public function setIsBanned(bool $isBanned): self
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'isBanned' => $this->isIsBanned()
        ];
    }

    /**
     * @return Collection<int, Mashup>
     */
    public function getMashup(): Collection
    {
        return $this->mashup;
    }

    public function addMashup(Mashup $mashup): self
    {
        if (!$this->mashup->contains($mashup)) {
            $this->mashup[] = $mashup;
            $mashup->addAuthor($this);
        }

        return $this;
    }

    public function removeMashup(Mashup $mashup): self
    {
        if ($this->mashup->removeElement($mashup)) {
            $mashup->removeAuthor($this);
        }

        return $this;
    }
}
