<?php

namespace App\Repository\Trips;

use App\Data\TripDTO;
use App\Data\UserDTO;

interface TripRepositoryInterface
{
    public function insert(TripDTO $tripDTO): bool;
    public function update(TripDTO $tripDTO, int $id);
    public function remove(int $id): bool;

    /**
     * @return \Generator|TripDTO[]
     */
    public function findAll(): \Generator;

    public function findOneById(int $id): TripDTO;

    /**
     * @param int $id
     * @return \Generator|TripDTO[]
     */
    public function findAllByAuthorId(int $id): \Generator;

    public function addSeat(TripDTO $tripDTO, int $id): bool;

    public function getTakenSeats(int $id): array;
}