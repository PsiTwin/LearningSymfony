<?php

namespace App\Service\Tag;

use App\Entity\Tag;
use App\Repository\TagRepository;

class DeleteTag
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Tag $tag
     * @return void
     */
    public function deleteTag(Tag $tag): void
    {
        $this->tagRepository->removeTag($tag);
    }
}