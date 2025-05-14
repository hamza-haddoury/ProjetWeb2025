<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getUsersFile() {
    return 'users.csv';
}


function exist($login) {
    $file = fopen(getUsersFile(), 'r');
    if (!$file) return false;

    while (($data = fgetcsv($file)) !== false) {
        if (count($data) >= 1 && $data[0] === $login) {
            fclose($file);
            return true;
        }
    }

    fclose($file);
    return false;
}

function loginOk($login, $mdp) {
    $file = fopen(getUsersFile(), 'r');
    if (!$file) return false;

    while (($data = fgetcsv($file)) !== false) {
        if (count($data) >= 2 && $data[0] === $login && $data[1] === $mdp) {
            fclose($file);
            return true;
        }
    }

    fclose($file);
    return false;
}


function getUserData($login) {
    $file = fopen(getUsersFile(), 'r');
    if (!$file) return null;

    while (($data = fgetcsv($file)) !== false) {
        if (count($data) >= 5 && $data[0] === $login) {
            fclose($file);
            return [
                'login' => $data[0],
                'mdp' => $data[1],
                'email' => $data[2],
            ];
        }
    }

    fclose($file);
    return null;
}


function addUser($login, $mdp, $email) {
    if (exist($login)) {
        return false;
    }

    $file = fopen(getUsersFile(), 'a');
    if (!$file) {
        echo "Erreur lors de l'ouverture du fichier utilisateurs.";
        return false;
    }

    // Saut de ligne avant d’ajouter la nouvelle ligne
    fwrite($file, PHP_EOL);
    
    fputcsv($file, [trim($login), trim($mdp), trim($email)]);
    fclose($file);
    return true;
}



