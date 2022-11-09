<?php

namespace App\Service\Tag;

use App\DTO\Tag\TagCreationRequest;
use App\Repository\TagRepository;
use App\Service\Validation;

class AddTag
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param TagCreationRequest $data
     * @param Validation $validator
     * @return void
     */
    public function addTag(TagCreationRequest $data, Validation $validator): void
    {
        $name = $data->getName();
        $isHidden = $data->isHidden();
        $validator->validate($data);
        $this->tagRepository->saveTag($name, $isHidden);
    }
}