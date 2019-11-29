<?php

namespace App\Repository\Cars;

use App\Data\CarDTO;

interface CarRepositoryInterface
{

    /**
     * @return \Generator|CarDTO[]
     */
    public function findAll(): \Generator;

    public function findOneById(int $id): CarDTO;
}