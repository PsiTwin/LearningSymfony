<?php

namespace App\Service\Tag;

use App\DTO\Tag\TagsSearch;
use App\Entity\Tag;
use App\Repository\TagRepository;

class TagSearch
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param TagsSearch $data
     * @return Tag[]
     */
    public function search(TagsSearch $data): array
    {
        $hidden = $data->isHidden();
        if ($hidden !== null) {
            $models = $this->tagRepository->findBy(
                ['isHidden' => $hidden]);
        } else {
            $models = $this->tagRepository->findAll();
        }
        return $models;
    }
}