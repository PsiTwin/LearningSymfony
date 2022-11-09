<?php

namespace App\Service\Author;

use App\Entity\Author;
use App\Repository\AuthorRepository;

class DeleteAuthor
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param Author $author
     * @return void
     */
    public function deleteAuthor(Author $author): void
    {
        $this->authorRepository->removeAuthor($author);
    }
}