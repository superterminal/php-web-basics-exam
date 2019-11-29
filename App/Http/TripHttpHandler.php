<?php

namespace App\Http;

use App\Data\EditTripDTO;
use App\Data\TripDTO;
use App\Data\UserDTO;
use App\Service\Cars\CarServiceInterface;
use App\Service\Trips\TripServiceInterface;
use App\Service\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class TripHttpHandler extends UserHttpHandlerAbstract
{
    /**
     * @var TripServiceInterface
     */
    private $tripService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var CarServiceInterface
     */
    private $carService;

    public function __construct(TemplateInterface $template,
                                DataBinderInterface $dataBinder,
                                TripServiceInterface $tripService,
                                UserServiceInterface $userService,
                                CarServiceInterface $carService)
    {
        parent::__construct($template, $dataBinder);
        $this->tripService = $tripService;
        $this->userService = $userService;
        $this->carService = $carService;
    }

    public function add(array $formData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        if (isset($formData['add'])) {
            $this->handleInsertProcess($formData);
        } else {
            $cars = $this->carService->getAll();
            $this->render("trips/add_trip", $cars);
        }
    }

    private function handleInsertProcess(array $formData)
    {
        try {
            $currentUser = $this->userService->currentUser();
            $car = $this->carService->getOneById($formData['car_id']);
            /** @var TripDTO $trip*/
            $trip = $this->dataBinder->bind($formData, TripDTO::class);
            $trip->setCarMaker($car);
            $trip->setUser($currentUser);
            $trip->setTakenSeats(0);

            if (isset($formData['allowedSmokers'])) {
                $flag = 1;
            } else {
                $flag = 0;
            }

            $trip->setAllowedSmokers($flag);

            $this->tripService->add($trip);
            $this->redirect("my_trips.php");
        } catch (\Exception $ex) {
            $cars = $this->carService->getAll();
            $this->render("trips/add_trip", $cars, [$ex->getMessage()]);
        }
    }

    public function allTripsByAuthor()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        try {
            $trips = $this->tripService->getAllByAuthor();
            $this->render("trips/my_trips", $trips);
        } catch (\Exception $ex) {
            $trips = $this->tripService->getAllByAuthor();
            $this->render("trips/my_trips", $trips, [$ex->getMessage()]);
        }
    }

    public function allTrips()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        try {
            $trips = $this->tripService->getAll();
            $this->render("trips/all_trips", $trips);
        } catch (\Exception $ex) {
            $trips = $this->tripService->getAll();
            $this->render("trips/all_trips", $trips, [$ex->getMessage()]);
        }
    }

    public function edit($formData = [], $getData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData, $getData);
        } else {
            $trip = $this->tripService->getOneById($getData['id']);
            $car = $this->carService->getAll();

            $editTripDTO = new EditTripDTO();
            $editTripDTO->setCars($car);
            $editTripDTO->setTrip($trip);

            $this->render("trips/edit_trip", $editTripDTO);
        }
    }

    private function handleEditProcess(array $formData, array $getData)
    {
        try {
            $car = $this->carService->getOneById($formData['car_id']);
            $user = $this->userService->currentUser();
            /** @var TripDTO $trip */

            $trip = $this->dataBinder->bind($formData, TripDTO::class);
            $trip->setCarMaker($car);
            $trip->setUser($user);
            $trip->setId($getData['id']);
            $takenSeats = $this->tripService->getTakenSeats($trip->getId())['taken_seats'];
            $trip->setTakenSeats($takenSeats);

            if (isset($formData['allowedSmokers'])) {
                $flag = 1;
            } else {
                $flag = 0;
            }

            $trip->setAllowedSmokers($flag);

            $this->tripService->edit($trip);
            $this->redirect("my_trips.php");
        } catch (\Exception $ex) {
            $trip = $this->tripService->getOneById($getData['id']);
            $editTripDTO = new EditTripDTO();
            $editTripDTO->setTrip($trip);
            $editTripDTO->setCars($this->carService->getAll());

            $this->render("trips/edit_trip", $editTripDTO, [$ex->getMessage()]);
        }
    }

    public function delete($getData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        $currentUser = $this->userService->currentUser();
        $currentTrip = $this->tripService->getOneById($getData['id']);

        if ($currentUser->getId() === $currentTrip->getUser()->getId()) {
            $this->tripService->delete($getData['id']);
            $this->redirect("my_trips");
        } else {
            $myTrips = $this->tripService->getAllByAuthor();
            $this->render("trips/all_trips", $myTrips, ['Cant delete trip']);
        }
    }

    public function addSeat($getData = [])
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        $currentTrip = $this->tripService->getOneById($getData['id']);
        $currentUser = $this->userService->currentUser();

        if ($currentTrip->getTotalSeats() > $currentTrip->getTakenSeats()) {
            $currentSeats = $currentTrip->getTakenSeats();
            $currentSeats++;
            $currentTrip->setTakenSeats($currentSeats);
            $this->tripService->addSeat($currentTrip, $currentTrip->getId());
            $this->addMoneyToCurrentUser($currentTrip, $currentUser);
            $this->redirect("all_trips");
        } else {
            $this->render("trips/all_trips", $this->tripService->getAll());
        }
    }

    private function addMoneyToCurrentUser(TripDTO $currentTrip, UserDTO $currentUser)
    {
        $currentMoneySpent = $currentUser->getMoneySpent();
        $currentMoneySpent += $currentTrip->getPrice();
        $currentUser->setMoneySpent($currentMoneySpent);
        return $this->userService->addMoneyToTotal($currentUser);
    }
}