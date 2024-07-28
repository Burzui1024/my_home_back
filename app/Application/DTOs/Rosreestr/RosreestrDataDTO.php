<?php

declare(strict_types=1);

namespace App\Application\DTOs\Rosreestr;

class RosreestrDataDTO
{
    /**
     *
     * @param string $cadastar_number
     * @param string $date_of_assignment_cadaster_number
     * @param string $address
     * @param float $square
     * @param int $floor
     * @param float $cadastral_value
     * @param string $date_of_determination_of_cadastral_value
     */
    public function __construct(
        private readonly string $cadastar_number,
        private readonly string $date_of_assignment_cadaster_number,
        private readonly string $address,
        private readonly float  $square,
        private readonly int    $floor,
        private readonly float  $cadastral_value,
        private readonly string $date_of_determination_of_cadastral_value
    )
    {
    }

    /**
     * @return string
     */
    public function getCadastarNumber(): string
    {
        return $this->cadastar_number;
    }

    /**
     * @return string
     */
    public function getDateOfAssignmentCadasterNumber(): string
    {
        return $this->date_of_assignment_cadaster_number;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getSquare(): float
    {
        return $this->square;
    }

    /**
     * @return int
     */
    public function getFloor(): int
    {
        return $this->floor;
    }

    /**
     * @return float
     */
    public function getCadastralValue(): float
    {
        return $this->cadastral_value;
    }

    /**
     * @return string
     */
    public function getDateOfDeterminationOfCadastralValue(): string
    {
        return $this->date_of_determination_of_cadastral_value;
    }

    /**
     * @return object[]
     */
    public function toObject(): array
    {
        return [
            (object)[
                'group_name' => 'Общая информация',
                'data' => [
                    (object)['name' => 'Кадастровый номер', 'value' => $this->getCadastarNumber()],
                    (object)['name' => 'Дата присвоения кадастрового номера', 'value' => $this->getDateOfAssignmentCadasterNumber()],
                ]
            ],
            (object)[
                'group_name' => 'Характеристики объекта',
                'data' => [
                    (object)['name' => 'Адрес (местоположение)', 'value' => $this->getAddress()],
                    (object)['name' => 'Площадь,', 'value' => $this->getSquare().' кв.м'],
                    (object)['name' => 'Этаж', 'value' => $this->getFloor()],
                ]
            ],
            (object)[
                'group_name' => 'Сведения о кадастровой стоимости',
                'data' => [
                    (object)['name' => 'Кадастровая стоимость (руб)', 'value' => number_format($this->getCadastralValue(), 2, ',', ' '). ' руб.'],
                    (object)['name' => 'Дата определения', 'value' => $this->getDateOfDeterminationOfCadastralValue()],
                ]
            ]
        ];
    }


}
