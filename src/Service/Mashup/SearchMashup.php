<?php

namespace App\Service\Mashup;

use App\DTO\Mashup\MashupsSearchRequest;
use App\Repository\MashupRepository;

class SearchMashup
{
    private MashupRepository $mashupRepository;

    public function __construct(MashupRepository $mashupRepository)
    {
        $this->mashupRepository = $mashupRepository;
    }

    public function search(MashupsSearchRequest $data): array
    {
        return $this->mashupRepository->searchMashups($data->getName(), $data->getAuthor(), $data->getTag());
    }
}