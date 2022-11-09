<?php

namespace App\Entity;

use App\Repository\MashupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MashupRepository::class)
 */
class Mashup
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
     * @ORM\Column(type="string", length=255)
     * @Groups("mashup")
     */
    private string $file;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="mashup")
     * @Groups("mashup")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="mashup")
     * @Groups("mashup")
     */
    private $tag;

    /**
     * @ManyToOne(targetEntity="Identity")
     * @ORM\JoinColumn(nullable=false, name="id_creator", referencedColumnName="id")
     * @Groups("mashup")
     */
    private Identity $createdBy;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->tag = new ArrayCollection();
    }

    public function getCreatedBy(): Identity
    {
        return $this->createdBy;
    }

    public function setCreatedBy(Identity $createdBy): void
    {
        $this->createdBy = $createdBy;
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

    public function getFile(): string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Author $author): self
    {

        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }
        return $this;
    }

    public function removeAuthor(Author $author): self
    {
        $this->author->removeElement($author);
        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);
        return $this;
    }
}
