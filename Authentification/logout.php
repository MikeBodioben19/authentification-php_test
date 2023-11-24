<?php
$pdo = require_once './database.php';

$sessionId = $_COOKIE['session'] ?? '';
echo $sessionId;

if ($sessionId) {
    $statement = $pdo->prepare('DELETE FROM session WHERE idsession = :idsession');
    $statement->bindValue(':idsession', $sessionId);
    $statement->execute();

    setcookie('session', '', time() - 1);
    header('Location : /login.php', true, 301);
}
