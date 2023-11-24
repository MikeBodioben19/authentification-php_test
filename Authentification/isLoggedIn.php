<?php

function isLoggedIn()
{
    $pdo = require_once './database.php';
    $sessionId = $_COOKIE["session"] ?? '';
    $signature = $_COOKIE["signature"] ?? '';



    if ($sessionId && $signature) {
        $hash = hash_hmac('sha256', $sessionId, 'krypton');
        $match = hash_equals($signature, $hash);

        if ($match) {

            $sessionStatement = $pdo->prepare('SELECT * FROM session WHERE idsession= :idsession');
            $sessionStatement->bindValue(':idsession', $sessionId);

            $sessionStatement->execute();

            $session = $sessionStatement->fetch();

            if ($session) {

                $userStatement = $pdo->prepare('SELECT * FROM user WHERE iduser= :iduser');
                $userStatement->bindValue(':iduser', $session['userid']);
                $userStatement->execute();
                $user = $userStatement->fetch();
            }
        }
    }
    return $user ?? false;
}
