<?php

namespace App\Service\Mashup;

use App\Entity\Mashup;
use App\Repository\MashupRepository;

class DeleteMashup
{
    private MashupRepository $mashupRepository;

    public function __construct(MashupRepository $mashupRepository)
    {
        $this->mashupRepository = $mashupRepository;
    }

    /**
     * @param Mashup $mashup
     * @return void
     */
    public function deleteMashup(Mashup $mashup): void
    {
        $this->mashupRepository->removeMashup($mashup);
    }
}