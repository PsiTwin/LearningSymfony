<?php

namespace App\Service\Author;

use App\DTO\Author\AuthorUpdationRequest;
use App\Entity\Author;
use App\Repository\AuthorRepository;

class UpdateAuthor
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $tagRepository)
    {
        $this->authorRepository = $tagRepository;
    }

    /**
     * @param AuthorUpdationRequest $data
     * @param Author $author
     * @return void
     */
    public function updateAuthor(AuthorUpdationRequest $data, Author $author): void
    {
        if ($data->getName() !== null) {
            $author->setName($data->getName());
        }
        if ($data->isBanned() !== null) {
            $author->setIsBanned($data->isBanned());
        }

        $this->authorRepository->updateAuthor($author);
    }
}