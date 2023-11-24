<?php

// require_once './login.php';
require_once './isLoggedIn.php';

$currentUser = isLoggedIn();
// $pdo = require_once './database.php';

// $sessionId = $_COOKIE["session"]?? '';
// if ($sessionId) {

//     $sessionStatement = $pdo->prepare('SELECT * FROM session WHERE idsession= :idsession');
//     $sessionStatement->bindValue(':idsession', $sessionId);

//     $sessionStatement->execute();

//     $session = $sessionStatement->fetch();

//     if ($session) {

//         $userStatement = $pdo->prepare('SELECT * FROM user WHERE iduser= :iduser');
//         $userStatement->bindValue(':iduser', $session['userid']);
//         $userStatement->execute();
//         $user = $userStatement->fetch();
//     }
// }
// print_r($currentUser);

// if (!$session || !$sessionId || !$user) {
    if(!$currentUser){
    header('Location : /login.php', true, 301);
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
        <a href="/">Home</a> 
        <!-- <a href="/register.php">Sign in</a> -->
        <!-- <a href="/login.php">Login</a> -->
        <a href="/logout.php">Logout</a>
        <a href="/profile.php">Profile</a>
    </nav>

    <!-- <h1>Profile <?php $user['iduser'] ?></h1> -->
    <!-- <h2>Hello <?php $user['email'] ?> -->
    <h1>Profile <?php $currentUser['iduser'] ?></h1>
    <h2>Hello <?php $currentUser['email'] ?>
    </h2>
</body>

</html>