<?php

namespace App\DTO\Author;

class AuthorsSearch
{

    private ?bool $isHidden = null;

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