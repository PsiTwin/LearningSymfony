<?php

namespace App\Service\Author;

use App\DTO\Author\AuthorCreationRequest;
use App\Repository\AuthorRepository;
use App\Service\Validation;

class AddAuthor
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param AuthorCreationRequest $data
     * @param Validation $validator
     * @return void
     */
    public function addAuthor(AuthorCreationRequest $data, Validation $validator): void
    {
        $name = $data->getName();
        $validator->validate($data);
        $this->authorRepository->saveAuthor($name);
    }
}