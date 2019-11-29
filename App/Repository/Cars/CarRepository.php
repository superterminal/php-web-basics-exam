<?php

namespace App\Repository\Cars;

use App\Data\CarDTO;
use App\Repository\DatabaseAbstract;

class CarRepository extends DatabaseAbstract implements CarRepositoryInterface
{

    /**
     * @return \Generator|CarDTO[]
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "
                SELECT 
                    id,
                    maker
                FROM cars
            ")->execute()
                ->fetch(CarDTO::class);
    }

    public function findOneById(int $id): CarDTO
    {
        return $this->db->query(
            "
                SELECT
                    id,
                    maker
                FROM cars
                WHERE id = ?
            ")->execute([$id])
                ->fetch(CarDTO::class)
                ->current();
    }
}