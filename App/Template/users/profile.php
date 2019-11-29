<?php /** @var \App\Data\UserDTO $data */ ?>

<h1>Hello, <?= $data->getUsername(); ?></h1>

<a href="add_trip.php">Add new Trip</a> |
        <a href="logout.php">logout</a>

<br /><br />

<a href="my_trips.php">My Trips</a> <br />
<a href="all_trips.php">All Trips</a>

<br /><br />
<span>Money spent: <?= $data->getMoneySpent(); ?></span>