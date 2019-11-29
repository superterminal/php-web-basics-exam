<?php

namespace App\Data;


class TripDTO
{

    private const MIN_TOTAL_SEATS = 1;
    private const MAX_TOTAL_SEATS = 10;

    private const MIN_PRICE_LENGTH = 1;
    private const MAX_PRICE_LENGTH = 50;

    private const MIN_FROM_TOWN_LENGTH = 4;
    private const MAX_FROM_TOWN_LENGTH = 255;

    private const MIN_TO_TOWN_LENGTH = 4;
    private const MAX_TO_TOWN_LENGTH = 255;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var int
     */
    private $totalSeats;

    /**
     * @var int
     */
    private $takenSeats;

    /**
     * @var bool
     */
    private $allowedSmokers;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $travelDate;

    /**
     * @var CarDTO
     */
    private $carMaker;

    /**
     * @var UserDTO
     */
    private $user;

    /**
     * @var string
     */
    private $fromTown;

    /**
     * @var string
     */
    private $toTown;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }

    /**
     * @param int $totalSeats
     * @throws \Exception
     */
    public function setTotalSeats(int $totalSeats): void
    {
        DTOValidator::validate(self::MIN_TOTAL_SEATS,
            self::MAX_TOTAL_SEATS, $totalSeats, "length", "Number");
        $this->totalSeats = $totalSeats;
    }

    /**
     * @return int
     */
    public function getTakenSeats(): ?int
    {
        return $this->takenSeats;
    }

    /**
     * @param int $takenSeats
     */
    public function setTakenSeats(int $takenSeats): void
    {
        $this->takenSeats = $takenSeats;
    }

    /**
     * @return bool
     */
    public function getAllowedSmokers(): ?bool
    {
        return $this->allowedSmokers;
    }

    /**
     * @param bool $allowedSmokers
     */
    public function setAllowedSmokers(bool $allowedSmokers): void
    {
        $this->allowedSmokers = $allowedSmokers;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @throws \Exception
     */
    public function setPrice(float $price): void
    {
        DTOValidator::validate(0, 0, $price, "isNegative", "Price");
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getTravelDate(): string
    {
        return $this->travelDate;
    }


    /**
     * @param string $travelDate
     */
    public function setTravelDate(string $travelDate): void
    {
        $this->travelDate = $travelDate;
    }

    /**
     * @return CarDTO
     */
    public function getCarMaker(): CarDTO
    {
        return $this->carMaker;
    }

    /**
     * @param CarDTO $carMaker
     */
    public function setCarMaker(CarDTO $carMaker): void
    {
        $this->carMaker = $carMaker;
    }

    /**
     * @return UserDTO
     */
    public function getUser(): UserDTO
    {
        return $this->user;
    }

    /**
     * @param UserDTO $user
     */
    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getFromTown(): string
    {
        return $this->fromTown;
    }

    /**
     * @param string $fromTown
     * @throws \Exception
     */
    public function setFromTown(string $fromTown): void
    {
        DTOValidator::validate(self::MIN_FROM_TOWN_LENGTH, self::MAX_FROM_TOWN_LENGTH,
            $fromTown, "text", "From Town");
        $this->fromTown = $fromTown;
    }

    /**
     * @return string
     */
    public function getToTown(): string
    {
        return $this->toTown;
    }

    /**
     * @param string $toTown
     * @throws \Exception
     */
    public function setToTown(string $toTown): void
    {
        DTOValidator::validate(self::MIN_TO_TOWN_LENGTH, self::MAX_TO_TOWN_LENGTH,
            $toTown, "text", "To Town");
        $this->toTown = $toTown;
    }
}