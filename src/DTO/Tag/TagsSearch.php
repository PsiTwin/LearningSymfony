<?php

namespace App\DTO\Tag;

class TagsSearch
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