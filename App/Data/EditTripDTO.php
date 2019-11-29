<?php

namespace App\Data;


class EditTripDTO
{
    /**
     * @var TripDTO
     */
    private $trip;

    /**
     * @var CarDTO[]
     */
    private $cars;

    /**
     * @return TripDTO
     */
    public function getTrip(): TripDTO
    {
        return $this->trip;
    }

    /**
     * @param TripDTO $trip
     */
    public function setTrip(TripDTO $trip): void
    {
        $this->trip = $trip;
    }

    /**
     * @return TripDTO
     */

    /**
     * @return CarDTO[]
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param CarDTO[] $cars
     */
    public function setCars($cars): void
    {
        $this->cars = $cars;
    }


}