<?php

namespace App\Service\Trips;


use App\Data\TripDTO;
use App\Data\UserDTO;

interface TripServiceInterface
{
    public function add(TripDTO $tripDTO) : bool;
    public function edit(TripDTO $tripDTO) : bool;
    public function delete(int $id) : bool;

    /**
     * @return \Generator|TripDTO[]
     */
    public function getAll() : \Generator;

    public function getOneById(int $id) : TripDTO;

    public function getAllByAuthor();

    public function addSeat(TripDTO $tripDTO, int $id);

    public function getTakenSeats(int $id): array ;
}