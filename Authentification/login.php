<?php
$pdo = require_once './database.php';


const ERROR_REQUIRED = 'Please fill this field';
const ERROR_TITLE_TOO_SHORT = 'The username is too short';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $input = filter_input_array(
        INPUT_POST,
        [
            'email' => FILTER_SANITIZE_EMAIL
        ]
    );
    $email = $input['email'] ?? '';
    $password = $_POST['password'] ?? '';


    if ( !$email && !$password) {
        $error = ERROR_REQUIRED;
    } else {
        $statementUser = $pdo->prepare('SELECT * FROM user WHERE email =:email ');
        $statementUser->bindValue(':email', $email);
        $statementUser->execute();
        $user = $statementUser->fetch();
        $hash=  $user['password'];
        $userId=  $user['iduser'];

   

        

        if(password_verify($password,$hash)){
            $sessionId = bin2hex(random_bytes(32));
            $statementSession = $pdo -> prepare('INSERT INTO session VALUES (:idsession, :userid)');
            $statementSession -> bindValue(':userid',$userId);
            $statementSession -> bindValue(':idsession',$sessionId);
            $statementSession ->execute();

            $signature = hash_hmac('sha256', $sessionId,'krypton');

            setcookie('session',$sessionId,time() + 60*60*24*14,"","",false,true);
            setcookie('signature',$signature,time() + 60*60*24*14,"","",false,true);
            
            header('Location : /profile.php',true,301);
        }else{
            $error = "wrong password !"; 
        }

    }


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
        <a href="/register.php">Sign in</a>
        <a href="/login.php">Login</a>
        <!-- <a href="/logout.php">Logout</a> -->
        <!-- <a href="/profile.php">Profile</a> -->
    </nav>

    <h1>Log in</h1>

    <form action="/login.php" method="POST">
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