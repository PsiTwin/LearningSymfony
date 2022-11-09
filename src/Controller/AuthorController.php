<?php

namespace App\Controller;

use App\DTO\Author\AuthorCreationRequest;
use App\DTO\Author\AuthorUpdationRequest;
use App\Entity\Author;
use App\Service\Author\AddAuthor;
use App\Service\Author\AuthorSearch;
use App\Service\Author\DeleteAuthor;
use App\Service\Author\UpdateAuthor;
use App\Service\Validation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AuthorController extends ApiController
{
    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer);
    }

    /**
     * @param AuthorCreationRequest $data
     * @param Validation $validator
     * @param AddAuthor $addAuthor
     * @return JsonResponse
     * @ParamConverter(name="data", converter="json_converter")
     * @throws ExceptionInterface
     * @IsGranted({ROLE_MANAGER, ROLE_ADMIN})
     */
    public function add(AuthorCreationRequest $data, Validation $validator, AddAuthor $addAuthor): JsonResponse
    {
        $addAuthor->addAuthor($data, $validator);
        return $this->respondCreated($this->serialize());
    }

    /**
     * @param AuthorUpdationRequest $data
     * @param Author $author
     * @param UpdateAuthor $updateAuthor
     * @return JsonResponse
     * @ParamConverter(name="data", converter="json_converter")
     * @throws ExceptionInterface
     * @IsGranted({ROLE_MANAGER, ROLE_ADMIN})
     */
    public function update(AuthorUpdationRequest $data, Author $author, UpdateAuthor $updateAuthor): JsonResponse
    {
        $updateAuthor->updateAuthor($data, $author);
        return $this->respondOk($this->serialize());
    }

    /**
     * @param Author $author
     * @return JsonResponse
     * @throws ExceptionInterface
     * @IsGranted({ROLE_USER, ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function show(Author $author): JsonResponse
    {
        return $this->respondOk($this->serialize($author));
    }

    /**
     * @param Author $author
     * @param DeleteAuthor $deleteAuthor
     * @return JsonResponse
     * @IsGranted({ROLE_MANAGER, ROLE_ADMIN})
     */
    public function delete(Author $author, DeleteAuthor $deleteAuthor): JsonResponse
    {
        $deleteAuthor->deleteAuthor($author);
        return $this->respondDeleted();
    }

    /**
     * @param AuthorSearch $authorList
     * @param AuthorSearch $authorSearch
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @IsGranted({ROLE_USER, ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function search(AuthorSearch $authorList, AuthorSearch $authorSearch, SerializerInterface $serializer): JsonResponse
    {
        return $authorSearch->getAuthorsList($authorList, $serializer);
    }
}