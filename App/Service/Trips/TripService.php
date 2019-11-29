<?php

namespace App\Service\Trips;

use App\Data\TripDTO;
use App\Repository\Trips\TripRepositoryInterface;
use App\Service\UserServiceInterface;

class TripService implements TripServiceInterface
{

    /**
     * @var TripRepositoryInterface
     */
    private $tripRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(TripRepositoryInterface $tripRepository, UserServiceInterface $userService)
    {
        $this->tripRepository = $tripRepository;
        $this->userService = $userService;
    }

    public function add(TripDTO $tripDTO): bool
    {
        return $this->tripRepository->insert($tripDTO);
    }

    public function edit(TripDTO $tripDTO): bool
    {
        return $this->tripRepository->update($tripDTO, $tripDTO->getId());
    }

    public function addSeat(TripDTO $tripDTO, int $id): bool
    {
        return $this->tripRepository->addSeat($tripDTO, $id);
    }

    public function getTakenSeats(int $id): array
    {
        return $this->tripRepository->getTakenSeats($id);
    }

    public function delete(int $id): bool
    {
        return $this->tripRepository->remove($id);
    }

    /**
     * @return \Generator|TripDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->tripRepository->findAll();
    }

    public function getOneById(int $id): TripDTO
    {
        return $this->tripRepository->findOneById($id);
    }

    public function getAllByAuthor()
    {
        $currentUser = $this->userService->currentUser();

        return $this->tripRepository->findAllByAuthorId($currentUser->getId());
    }
}