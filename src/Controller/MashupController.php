<?php

namespace App\Controller;

use App\DTO\Mashup\MashupRequest;
use App\DTO\Mashup\MashupsSearchRequest;
use App\Entity\Mashup;
use App\Service\Mashup\DeleteMashup;
use App\Service\Mashup\ManagerMashup;
use App\Service\Mashup\SearchMashup;
use App\Service\Validation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;


class MashupController extends ApiController
{

    private const GROUPS = ['mashup', 'identity'];

    /**
     * @param MashupRequest $data
     * @param Validation $validator
     * @param ManagerMashup $managerMashup
     * @return JsonResponse
     * @throws ExceptionInterface
     * @ParamConverter(name="data", converter="json_converter")
     * @IsGranted({ROLE_AUTHOR, ROLE_ADMIN})
     */
    public function add(MashupRequest $data, Validation $validator, ManagerMashup $managerMashup): JsonResponse
    {
        $user = $this->getUser();
        $validator->validate($data);
        $managerMashup->addMashup($data, $user);
        return $this->respondCreated($this->serialize());
    }

    /**
     * @param MashupRequest $data
     * @param Mashup $mashup
     * @param ManagerMashup $managerMashup
     * @return JsonResponse
     * @throws ExceptionInterface
     * @ParamConverter(name="data", converter="json_converter")
     * @IsGranted({ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function update(MashupRequest $data, Mashup $mashup, ManagerMashup $managerMashup): JsonResponse
    {
        //todo Добавить проверку на редактирования своих треков.
        $user = $this->getUser();
        $managerMashup->updateMashup($data, $mashup, $user);
        return $this->respondOk($this->serialize());
    }

    /**
     * @param Mashup $mashup
     * @return JsonResponse
     * @throws ExceptionInterface
     * @IsGranted({ROLE_USER, ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function show(Mashup $mashup): JsonResponse
    {
        return $this->respondOk($this->serialize($mashup, self::GROUPS));
    }

    /**
     * @param Mashup $mashup
     * @param DeleteMashup $deleteMashup
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function delete(Mashup $mashup, DeleteMashup $deleteMashup): JsonResponse
    {

        $deleteMashup->deleteMashup($mashup);
        return $this->respondDeleted($this->serialize());
    }

    /**
     * @param MashupsSearchRequest $data
     * @param SearchMashup $searchMashup
     * @ParamConverter(name="data", converter="query_converter")
     * @return JsonResponse
     * @throws ExceptionInterface
     * @IsGranted({ROLE_USER, ROLE_AUTHOR, ROLE_MANAGER, ROLE_ADMIN})
     */
    public function search(MashupsSearchRequest $data, SearchMashup $searchMashup): JsonResponse
    {
        return $this->respondOk($this->serialize($searchMashup->search($data), self::GROUPS));
    }
}