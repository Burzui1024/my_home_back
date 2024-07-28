<?php

namespace App\Application\Services\Rosreestr\Interface;

use App\Application\DTOs\Rosreestr\RosreestrDataDTO;
use Illuminate\Http\Client\RequestException;

interface RosreestrGetDataInterface
{
    /**
     * @param string $cadaster_number
     * @return RosreestrDataDTO
     * @throws RequestException
     */
    public function getDataFromCadasterNumber(string $cadaster_number): RosreestrDataDTO;
}
