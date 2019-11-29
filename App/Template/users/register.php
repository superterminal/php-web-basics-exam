<?php /** @var array $errors |null */ ?>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<h1>Register New User</h1>

<form method="post">
    <label>
        Username: <input type="text" name="username"/> <br />
    </label>
    <label>
        Password: <input type="text" name="password"/> <br />
    </label>
    <label>
        Confirm Password: <input type="text" name="confirm_password"/> <br />
    </label>
    <label>
        First Name: <input type="text" name="first_name"/><br />
    </label>
    <label>
        Last Name: <input type="text" name="last_name"/><br />
    </label>
    <input type="submit" name="register" value="Register"/> <br />

</form>
