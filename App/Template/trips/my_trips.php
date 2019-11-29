<?php /** @var \App\Data\TripDTO[] $data */ ?>

<h1>My Trips</h1>

<a href="add_trip.php">Add new trip</a> |
<a href="profile.php">My Profile</a> |
<a href="logout.php">logout</a>

<br /><br />

<table border="1">
    <thead>
    <tr>
        <th>Car</th>
        <th>From</th>
        <th>To</th>
        <th>Travel Date</th>
        <th>Seats</th>
        <th>Trip Budget</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($data as $tripDTO): ?>
        <tr>
            <td><?= $tripDTO->getCarMaker()->getMaker()?></td>
            <td><?= $tripDTO->getFromTown() ?></td>
            <td><?= $tripDTO->getToTown() ?></td>
            <td><?= $tripDTO->getTravelDate() ?></td>
            <td><?= $tripDTO->getTakenSeats() ?> / <?= $tripDTO->getTotalSeats()?></td>
            <td><?= $tripDTO->getTakenSeats() * $tripDTO->getPrice() ?></td>
            <td><a href="edit_trip.php?id=<?= $tripDTO->getId(); ?>">edit trip</a></td>
            <td><a href="delete_trip.php?id=<?= $tripDTO->getId(); ?>">delete trip</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>