<?php

namespace App\Repository\Trips;

use App\Data\CarDTO;
use App\Data\TripDTO;
use App\Data\UserDTO;
use App\Repository\DatabaseAbstract;

class TripRepository extends DatabaseAbstract implements TripRepositoryInterface
{

    public function insert(TripDTO $tripDTO): bool
    {
        $this->db->query(
            "INSERT INTO trips(
                    price, 
                    total_seats,
                    taken_seats,
                    car_id,
                    from_town,
                    to_town,
                    user_id,
                    allowed_smokers,
                    travel_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ")->execute([
                $tripDTO->getPrice(),
                $tripDTO->getTotalSeats(),
                $tripDTO->getTakenSeats(),
                $tripDTO->getCarMaker()->getId(),
                $tripDTO->getFromTown(),
                $tripDTO->getToTown(),
                $tripDTO->getUser()->getId(),
                $tripDTO->getAllowedSmokers(),
                $tripDTO->getTravelDate()
            ]);

        return true;
    }

    public function update(TripDTO $tripDTO, int $id): bool
    {

        $this->db->query(
            "
                UPDATE trips
                SET
                    total_seats = ?,
                    taken_seats = ?,
                    allowed_smokers = ?,
                    price = ?,
                    travel_date = ?,
                    car_id = ?,
                    from_town = ?,
                    to_town = ?
                WHERE id = ?
            ")->execute([
                $tripDTO->getTotalSeats(),
                $tripDTO->getTakenSeats(),
                $tripDTO->getAllowedSmokers(),
                $tripDTO->getPrice(),
                $tripDTO->getTravelDate(),
                $tripDTO->getCarMaker()->getId(),
                $tripDTO->getFromTown(),
                $tripDTO->getToTown(),
                $id
        ]);

        return true;
    }

    public function remove(int $id): bool
    {
        $this->db->query(
            "
                DELETE FROM trips
                WHERE id = ?
            ")->execute([$id]);

        return true;
    }

    /**
     * @return \Generator|TripDTO[]
     */
    public function findAll(): \Generator
    {
        $lazyTripResult = $this->db->query(
            "
            SELECT
                t.id as tripId,
                t.price,
                t.total_seats,
                t.taken_seats,
                t.car_id,
                t.from_town,
                t.to_town,
                t.user_id,
                t.travel_date,
                t.allowed_smokers,
                u.username,
                u.id AS userId,
                c.id AS carId,
                c.maker
            FROM trips AS t
            INNER JOIN cars c on t.car_id = c.id
            INNER JOIN users u on t.user_id = u.id
            ORDER BY t.travel_date ASC
            "
        )->execute()
            ->fetchAssoc();

        foreach ($lazyTripResult as $row) {
            /**
             * @var TripDTO $trip
             * @var CarDTO $car
             * @var UserDTO $user
             */

            $trip = $this->dataBinder->bind($row, TripDTO::class);
            $car = $this->dataBinder->bind($row, CarDTO::class);
            $user = $this->dataBinder->bind($row, UserDTO::class);

            $trip->setId($row['tripId']);
            $car->setId($row['carId']);
            $user->setId($row['userId']);

            $trip->setUser($user);
            $trip->setCarMaker($car);

            yield $trip;

        }
    }

    public function findOneById(int $id): TripDTO
    {
        $row = $this->db->query(
            "
                SELECT
                t.id as tripId,
                t.price,
                t.total_seats,
                t.taken_seats,
                t.car_id,
                t.from_town,
                t.to_town,
                t.user_id,
                t.travel_date,
                t.allowed_smokers,
                u.username,
                u.password,
                u.money_spent,
                u.first_name,
                u.last_name,
                u.id AS userId,
                c.id AS carId,
                c.maker
            FROM trips AS t
            INNER JOIN cars c on t.car_id = c.id
            INNER JOIN users u on t.user_id = u.id
            WHERE t.id = ?
            ORDER BY t.travel_date ASC
            "
        )->execute([$id])
            ->fetchAssoc()
                ->current();

        /** @var TripDTO $trip */
        /** @var UserDTO $user */
        /** @var CarDTO $car */

        $trip = $this->dataBinder->bind($row, TripDTO::class);
        $user = $this->dataBinder->bind($row, UserDTO::class);
        $car = $this->dataBinder->bind($row, CarDTO::class);
        $trip->setId($row['tripId']);
        $user->setId($row['userId']);
        $car->setId($row['carId']);
        $trip->setCarMaker($car);
        $trip->setUser($user);

        return $trip;
    }

    /**
     * @param int $id
     * @return \Generator|TripDTO[]
     */
    public function findAllByAuthorId(int $id): \Generator
    {
        $lazyTripResult = $this->db->query(
            "
            SELECT
                t.id as tripId,
                t.price,
                t.total_seats,
                t.taken_seats,
                t.car_id,
                t.from_town,
                t.allowed_smokers,
                t.to_town,
                t.user_id,
                t.travel_date,
                u.username,
                u.id AS userId,
                c.id AS carId,
                c.maker
            FROM trips AS t
            INNER JOIN cars c on t.car_id = c.id
            INNER JOIN users u on t.user_id = u.id
            WHERE t.user_id = ?
            ORDER BY t.travel_date ASC
            "
        )->execute([$id])
            ->fetchAssoc();

        foreach ($lazyTripResult as $row) {
            /**
             * @var TripDTO $trip
             * @var CarDTO $car
             * @var UserDTO $user
             */
            $trip = $this->dataBinder->bind($row, TripDTO::class);
            $car = $this->dataBinder->bind($row, CarDTO::class);
            $user = $this->dataBinder->bind($row, UserDTO::class);

            $trip->setId($row['tripId']);
            $car->setId($row['carId']);
            $user->setId($row['userId']);

            $trip->setUser($user);
            $trip->setCarMaker($car);

            yield $trip;

        }
    }

    public function addSeat(TripDTO $tripDTO, int $id): bool
    {
        $this->db->query(
            "UPDATE trips
                   SET taken_seats = ?
                   WHERE id = ?"
        )->execute([
            $tripDTO->getTakenSeats(),
            $id
        ]);

        return true;
    }

    public function getTakenSeats(int $id): array
    {
        return $this->db->query(
            "SELECT 
                        taken_seats
                   FROM trips
                   WHERE id = ?
        ")->execute([$id])
            ->fetchAssoc()
                ->current();

    }
}