<?php

namespace App\Service\Tag;

use App\DTO\Tag\TagUpdationRequest;
use App\Entity\Tag;
use App\Repository\TagRepository;

class UpdateTag
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param TagUpdationRequest $data
     * @param Tag $tag
     * @return void
     */
    public function updateTag(TagUpdationRequest $data, Tag $tag): void
    {
        if ($data->getName() !== null) {
            $tag->setName($data->getName());
        }
        if ($data->isHidden() !== null) {
            $tag->setHidden($data->isHidden());
        }
        $this->tagRepository->updateTag($tag);
    }
}