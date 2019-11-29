<?php /** @var \App\Data\TripDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>

<h1>All Trips</h1>

<a href="add_trip.php">Add new trip</a> |
<a href="profile.php">My Profile</a> |
<a href="logout.php">logout</a>

<br /><br />

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<table border="1">
    <thead>
    <tr>
        <th>Car</th>
        <th>From</th>
        <th>To</th>
        <th>Travel Date</th>
        <th>Seats</th>
        <th>Allow Smokers</th>
        <th>Price</th>
        <th>Status</th>
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
            <td><?= $tripDTO->getAllowedSmokers() === true ? 'Yes' : 'No' ?></td>
            <td><?= $tripDTO->getPrice() ?></td>
            <?php if ($tripDTO->getTotalSeats() === $tripDTO->getTakenSeats()): ?>
                <td>Full</td>
            <?php else: ?>
                <td><a href="add_seat.php?id=<?= $tripDTO->getId(); ?>">Join</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>