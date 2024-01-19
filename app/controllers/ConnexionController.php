<?php
namespace App\Controllers;
use Config\Database;

class ConnexionController {

    public function login() {
        session_destroy();
        require("../app/views/connexion/connexion.php");
    }

    public function verifLogin() {
        $_SESSION["login"]="connected";
        header("Location: /accueil");
    }

    public function disconnect() {
        session_destroy();
        header("Location: /connexion");
        exit();
    }

}