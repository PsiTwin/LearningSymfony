<?php

namespace App\DTO\Tag;

use Symfony\Component\Validator\Constraints as Assert;

class TagUpdationRequest
{
    private int $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 225,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     *     )
     */
    private ?string $name = null;

    private ?bool $isHidden = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool|null
     */
    public function isHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool $isHidden
     * @return void
     */
    public function setIsHidden(bool $isHidden): void
    {
        $this->isHidden = $isHidden;
    }
}
