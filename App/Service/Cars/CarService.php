<?php


namespace App\Service\Cars;


use App\Data\CarDTO;
use App\Repository\Cars\CarRepositoryInterface;

class CarService implements CarServiceInterface
{
    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return \Generator|CarDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->carRepository->findAll();
    }

    public function getOneById(int $id): CarDTO
    {
        return $this->carRepository->findOneById($id);
    }
}