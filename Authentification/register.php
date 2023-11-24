<?php
$pdo = require_once './database.php';


const ERROR_REQUIRED = 'Please fill this field';
const ERROR_TITLE_TOO_SHORT = 'The username is too short';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = filter_input_array(
        INPUT_POST,
        [
            'username' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL
        ]
    );

    $username = $input['username'] ?? '';
    $email = $input['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // if (!$username) {
    //     $error = ERROR_TITLE_TOO_SHORT;
    // } elseif (mb_strlen($username) < 3) {
    //     $error = ERROR_REQUIRED;
    // };
    if (!$username && !$email && !$password) {
        $error = ERROR_REQUIRED;
    } else {
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $statement = $pdo->prepare('INSERT INTO user VALUES(
            DEFAULT,
                :email,
                :username,
                :password
            )');

        $statement->bindValue(':email', $email);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashedPwd);

        $statement->execute();

        header("Location : /login.php",true,301);

    }

    // $statement = $pdo->prepare('INSERT INTO user VALUES(
    //     DEFAULT,
    //     :email,
    //     :username,
    //     :password
    // )');

    // $statement->bindValue(':email', $email);
    // $statement->bindValue(':username', $username);
    // $statement->bindValue(':password', $password);

    // $statement->execute();

    // header('Location : ./login.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesignLab</title>
</head>

<body>
    <nav>
        <a href="/index.php">Home</a>
        <a href="/register.php">Sign in</a>
        <a href="/login.php">Login</a>
        <!-- <a href="/logout.php">Logout</a> -->
        <!-- <a href="/profile.php">Profile</a> -->
    </nav>

    <h1>Sign in</h1>

    <form action="/register.php" method="POST">
        <label for="username">Your username</label>
        <input type="text" placeholder="Username" name="username" value="<?= $username ?? '' ?>">
        <?php if ($error) : ?>
            <p class="text-error"><?= $error ?></p>
        <?php endif; ?>
        <label for="email">Your email</label>
        <input type="text" placeholder="Email" name="email" value="<?= $email ?? '' ?>">
        <?php if ($error) : ?>
            <p class="text-error"><?= $error ?></p>
        <?php endif; ?>
        <label for="password">Your password</label>
        <input type="password" placeholder="Password" name="password">
        <?php if ($error) : ?>
            <p class="text-error"><?= $error ?></p>
        <?php endif; ?>
        <button>Submit</button>
    </form>
</body>

</html>