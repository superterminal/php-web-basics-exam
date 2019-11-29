<?php


namespace App\Service\Cars;


use App\Data\CarDTO;

interface CarServiceInterface
{
    /**
     * @return \Generator|CarDTO[]
     */
    public function getAll(): \Generator;

    public function getOneById(int $id): CarDTO;
}