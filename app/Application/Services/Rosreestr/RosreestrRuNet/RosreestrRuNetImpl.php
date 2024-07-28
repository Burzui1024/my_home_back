<?php

declare(strict_types=1);

namespace App\Application\Services\Rosreestr\RosreestrRuNet;

use App\Application\DTOs\Rosreestr\RosreestrDataDTO;
use App\Application\Services\Rosreestr\Exceptions\RosreestrRuNetException;
use App\Application\Services\Rosreestr\Interface\RosreestrGetDataInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class RosreestrRuNetImpl implements RosreestrGetDataInterface
{


    /**
     * @param string $cadaster_number
     * @return RosreestrDataDTO
     * @throws RosreestrRuNetException
     */
    public function getDataFromCadasterNumber(string $cadaster_number): RosreestrDataDTO
    {
        // TODO: Implement get() method.
        $url = str_replace("{cadaster_number}", $cadaster_number, config('roseestr.getDataFromCadaster'));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
            ->withQueryParameters(['token' => env('API_TOKEN')])
            ->timeout(120)
            ->get($url);

        //Нормального описания ошибок я не нашел у них на сайте.
        if ($response->failed()) {
            throw new RosreestrRuNetException('RosreestrRuNet Error');
        }

        $data = json_decode($response->body());

        if (isset($data->errorCode)) {
            throw new RosreestrRuNetException($data->errorCode);
        }
        if (!isset($data->gkn->objectData)) {
            throw new RosreestrRuNetException('Field "gkn->objectData" not found' );
        }
        if (!isset($data->gkn->objectData->flat)) {
            throw new RosreestrRuNetException('Field "gkn->objectData->flat" not found' );
        }
        if (!isset($data->egrp->premisesData)) {
            throw new RosreestrRuNetException('Field "egrp->premisesData" not found' );
        }

        return new RosreestrDataDTO(
            $data->gkn->objectData->cadNum,
            Carbon::parse($data->gkn->objectData->dateCreated)->format('d.m.Y'),
            $data->gkn->objectData->objectAddress,
            (float)$data->egrp->premisesData->areaValue,
            (int)$data->egrp->premisesData->premisesFloor,
            (float)$data->gkn->objectData->flat->cadCostValue,
            Carbon::parse($data->gkn->objectData->flat->ccDateValuation)->format('d.m.Y'),
        );
    }
}
