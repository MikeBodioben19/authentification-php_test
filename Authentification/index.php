<?php

// require_once './profile.php';
require_once './isLoggedIn.php';

$currentUser = isLoggedIn();


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
        <a href="/">Home</a>
        <?php if ($currentUser) : ?>
            <a href="/logout.php">Logout</a>
            <a href="/profile.php">Profile</a>
        <?php else : ?>
            <a href="/register.php">Sign in</a>
            <a href="/login.php">Login</a>
        <?php endif ?>
    </nav>

    <h1>Homepage</h1>
</body>

</html>