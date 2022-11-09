<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("mashup")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("mashup")
     */
    private string $name;

    /**
     * @ORM\Column(type="boolean", name="is_hidden")
     */
    private bool $hidden;

    /**
     * @ORM\ManyToMany(targetEntity=Mashup::class, mappedBy="tag")
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

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): self
    {
        $this->hidden = $hidden;

        return $this;
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
            $mashup->addTag($this);
        }

        return $this;
    }

    public function removeMashup(Mashup $mashup): self
    {
        if ($this->mashup->removeElement($mashup)) {
            $mashup->removeTag($this);
        }

        return $this;
    }
}
