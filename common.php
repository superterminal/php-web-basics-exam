<?php

session_start();
spl_autoload_register();

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);

$db = new \Database\PDODatabase($pdo);
$userRepository = new \App\Repository\UserRepository($db, $dataBinder);
$carRepository = new \App\Repository\Cars\CarRepository($db, $dataBinder);
$tripRepository = new \App\Repository\Trips\TripRepository($db, $dataBinder);

$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\UserService($userRepository, $encryptionService);
$tripService = new \App\Service\Trips\TripService($tripRepository, $userService);
$carService = new \App\Service\Cars\CarService($carRepository);

$userHttpHandler = new \App\Http\UserHttpHandler($template, $dataBinder, $userService);
$tripHttpHandler = new \App\Http\TripHttpHandler($template, $dataBinder,
        $tripService, $userService, $carService);