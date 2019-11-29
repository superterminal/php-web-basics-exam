<?php /** @var \App\Data\EditTripDTO $data */ ?>
<?php /** @var array $errors |null */ ?>

<h1>Edit Trip</h1>

<a href="profile.php">My Profile</a><br/><br/>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    Total Seats: <input type="text" name="totalSeats" value="<?= $data->getTrip()->getTotalSeats()?>"/> <br />
    Allowed Smoking: <input type="checkbox" <?= $data->getTrip()->getAllowedSmokers() === 1 ? "checked" : "" ?> value="Yes" name="allowedSmokers" /><br>
    Price: <input type="text" name="price" value="<?= $data->getTrip()->getPrice()?>" ><br>
    Travel Date: <input type="date" name="travelDate" value="<?= $data->getTrip()->getTravelDate()?>"/><br />
    Car Maker: <select name="car_id"><br />
        <?php foreach ($data->getCars() as $car): ?>
            <?php if ($data->getTrip()->getCarMaker()->getId() === $car->getId()): ?>
                <option selected="selected" value="<?= $car->getId(); ?>"><?= $car->getMaker(); ?></option>
            <?php else: ?>
                <option value="<?= $car->getId(); ?>"><?= $car->getMaker(); ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select><br />
    From Town: <input type="text" name="fromTown" value="<?= $data->getTrip()->getFromTown()?>"/><br />
    To Town: <input type="text" name="toTown" value="<?= $data->getTrip()->getToTown()?>"/><br />
    <input type="submit" value="Edit" name="edit" /><br />
</form>