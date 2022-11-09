<?php

namespace App\Service\Mashup;

use App\DTO\Mashup\MashupRequest;
use App\Entity\Mashup;
use App\Repository\AuthorRepository;
use App\Repository\IdentityRepository;
use App\Repository\MashupRepository;
use App\Repository\TagRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ManagerMashup
{
    private AuthorRepository $authorRepository;

    private TagRepository $tagRepository;

    private IdentityRepository $identityRepository;

    private MashupRepository $mashupRepository;

    public function __construct(
        AuthorRepository   $authorRepository,
        TagRepository      $tagRepository,
        IdentityRepository $identityRepository,
        MashupRepository   $mashupRepository
    )
    {
        $this->mashupRepository = $mashupRepository;
        $this->authorRepository = $authorRepository;
        $this->tagRepository = $tagRepository;
        $this->identityRepository = $identityRepository;
    }

    /**
     * @param MashupRequest $requestData
     * @param UserInterface $user
     * @return void
     */
    public function addMashup(MashupRequest $requestData, UserInterface $user,): void
    {
        $data = $this->prepareData($requestData, $user);
        $this->mashupRepository->saveMashup($data['name'], $data['authors'], $data['tags'], $data['user']);
    }

    /**
     * @param MashupRequest $requestData
     * @param Mashup $mashup
     * @param UserInterface $user
     * @return void
     */
    public function updateMashup(MashupRequest $requestData, Mashup $mashup, UserInterface $user): void
    {
        $data = $this->prepareData($requestData, $user);
        $this->mashupRepository->updateMashup($mashup, $data['name'], $data['authors'], $data['tags'], $data['user']);
    }

    /**
     * @param MashupRequest $data
     * @param UserInterface $user
     * @return array
     */
    private function prepareData(MashupRequest $data, UserInterface $user): array
    {
        $preparingData = [];
        $preparingData['name'] = $data->getName();
        $authorsIds = $data->getAuthors();
        $tagsIds = $data->getTags();

        foreach ($authorsIds as $authorId) {
            $preparingData['authors'][] = $this->authorRepository->find($authorId);
        }

        foreach ($tagsIds as $tagId) {
            $preparingData['tags'][] = $this->tagRepository->find($tagId);
        }
        $preparingData['user'] = $this->identityRepository->find($user->getId());
        return $preparingData;
    }
}