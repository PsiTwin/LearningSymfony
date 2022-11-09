<?php

namespace App\Controller;

use App\Entity\Tag;
use App\DTO\Tag\TagCreationRequest;
use App\DTO\Tag\TagsSearch;
use App\DTO\Tag\TagUpdationRequest;
use App\Service\Tag\AddTag;
use App\Service\Tag\DeleteTag;
use App\Service\Tag\TagSearch;
use App\Service\Tag\UpdateTag;
use App\Service\Validation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class TagController extends ApiController
{
    /**
     * @param TagCreationRequest $data
     * @param Validation $validator
     * @param AddTag $addTag
     * @return JsonResponse
     * @ParamConverter(name="data", converter="json_converter")
     * @throws ExceptionInterface
     * @IsGranted({ROLE_MANAGER, ROLE_ADMIN})
     */
    public function add(TagCreationRequest $data, Validation $validator, AddTag $addTag): JsonResponse
    {
        $addTag->addTag($data, $validator);

        return $this->respondCreated($this->serialize());
    }

    /**
     * @param TagUpdationRequest $data
     * @param Tag $tag
     * @param UpdateTag $updateTag
     * @return JsonResponse
     * @ParamConverter(name="data", converter="json_converter")
     * @throws ExceptionInterface
     * @IsGranted({ROLE_MANAGER, ROLE_ADMIN})
     */
    public function update(TagUpdationRequest $data, Tag $tag, UpdateTag $updateTag): JsonResponse
    {
        $updateTag->updateTag($data, $tag);

        return $this->respondOk($this->serialize());
    }

    /**
     * @param Tag $tag
     * @return JsonResponse
     * @throws ExceptionInterface
     * @IsGranted({ROLE_USER, ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function show(Tag $tag): JsonResponse
    {
        return $this->respondOk($this->serialize($tag));
    }

    /**
     * @param Tag $tag
     * @param DeleteTag $deleteTag
     * @return JsonResponse
     * @throws ExceptionInterface
     * @IsGranted({ROLE_MANAGER, ROLE_ADMIN})
     */
    public function delete(Tag $tag, DeleteTag $deleteTag): JsonResponse
    {
        $deleteTag->deleteTag($tag);

        return $this->respondDeleted($this->serialize());
    }

    /**
     * @param TagsSearch $data
     * @param TagSearch $tagList
     * @ParamConverter(name="data", converter="query_converter")
     * @return JsonResponse
     * @throws ExceptionInterface
     * @IsGranted({ROLE_USER, ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function search(TagsSearch $data, TagSearch $tagList): JsonResponse
    {
        return $this->respondOk($this->serialize($tagList->search($data)));
    }
}