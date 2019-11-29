<?php /** @var \App\Data\CarDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>

<h1>Add Trip</h1>

<a href="profile.php">My Profile</a><br/><br />

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    Total Seats: <input type="text" name="totalSeats"/> <br />
    Allowed Smoking: <input type="checkbox" name="allowedSmokers" value="yes"/><br />
    Price: <input type="text" name="price"><br>
    Travel Date: <input type="date" name="travelDate"/><br />
    Car Maker: <select name="car_id"><br />
                <?php foreach ($data as $car): ?>
                    <option value="<?= $car->getId(); ?>">
                        <?= $car->getMaker(); ?>
                    </option>
                <?php endforeach; ?>
           </select><br />
    From Town: <input type="text" name="fromTown"/><br />
    To Town: <input type="text" name="toTown"/><br />
    <input type="submit" value="Add" name="add" /><br />
</form>
