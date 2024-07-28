<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Application\Services\Rosreestr\Interface\RosreestrGetDataInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;

class RosreestrController extends BaseController
{
    public function __construct(private readonly RosreestrGetDataInterface $rosreestrGetData)
    {
    }

    /**
     * @param $cadastral_number
     * @return JsonResponse
     */
    public function getInformationByNumber($cadastral_number): JsonResponse
    {
        try {
            return $this->sendResponse(
                $this->rosreestrGetData->getDataFromCadasterNumber(
                    $cadastral_number)->toObject(),
                'data is loaded');

        } catch (RequestException $exception) {
            return $this->sendError($exception->getMessage());
        }
    }
}
