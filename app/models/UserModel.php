<?php
namespace App\Models;
use Config\Database;
use App\Class\User;
use App\Class\Feedback;

class UserModel {

    public static function getUsers() {
        try {
            $users = [];
            $res = Database::getInstance()->prepare("SELECT * FROM user ORDER BY lastName");
            $res->execute();
            if($res->rowCount() === 0) {
                Feedback::setError("Aucun usager n'existe");
                return;
            }
            while($user = $res->fetch()) {
                $users[] = new User($user);
            }
            return $users;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUserById($id) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM user WHERE idUser = :idUser");
            $res->execute(array("idUser" => $id));
            if(!$userData = $res->fetch()){
                Feedback::setError("Aucun usager n'existe pour cet identifiant");
                return;
            }else{
                $user = new User($userData);
                return $user;
            }
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUsersByFilter() {
        try {
            $users = [];
            $sql="SELECT * FROM user WHERE 1=1";
            if (!empty($_POST['lastName'])) 
                $sql .= " AND lastName = :lastName";
            if (!empty($_POST['firstName'])) 
                $sql .= " AND firstName = :firstName";
            if (!empty($_POST['city'])) 
                $sql .= " AND city = :city";
            if (!empty($_POST['postalCode'])) 
                $sql .= " AND postalCode = :postalCode";
            if (!empty($_POST['gender'])) 
                $sql .= " AND gender = :gender";
            if (!empty($_POST['idDoctor'])) 
                $sql .= " AND idDoctor = :idDoctor";
            $sql .= " ORDER BY lastName";

            $res = Database::getInstance()->prepare($sql);

            if (!empty($_POST['lastName']))
                $res->bindParam(':lastName', $_POST['lastName']);
            if (!empty($_POST['firstName'])) 
                $res->bindParam(':firstName', $_POST['firstName']);
            if (!empty($_POST['city']))
                $res->bindParam(':city', $_POST['city']);
            if (!empty($_POST['postalCode'])) 
                $res->bindParam(':postalCode', $_POST['postalCode']);
            if (!empty($_POST['gender'])) 
                $res->bindParam(':gender', $_POST['gender']);
            if (!empty($_POST['idDoctor'])) 
                $res->bindParam(':idDoctor', $_POST['idDoctor']);

            $res->execute();
            if($res->rowCount() === 0) {
                Feedback::setError("Aucun usager n'existe pour ce filtrage");
                return;
            }
            while($user = $res->fetch()) {
                $users[] = new User($user);
            }
            return $users;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addUser(array $args) {
        try {
            $keys = ["gender", "lastName", "firstName", "city", "adress", "postalCode", "birthPlace", "birthDay", "secuNum", "idDoctor"];
    
            Database::getInstance()
                ->prepare("INSERT INTO user (gender, lastName, firstName, city, adress, postalCode, birthPlace, birthDay, secuNum, idDoctor)
                           VALUES (:gender, :lastName, :firstName, :city, :adress, :postalCode, :birthPlace, :birthDay, :secuNum, :idDoctor)")
                ->execute(array_intersect_key($args, array_flip($keys)));
    
            Feedback::setSuccess("Ajout de l'utilisateur enregistré.");
        } catch (\Exception $e) {
            throw $e;
            Feedback::setError("Une erreur s'est produite lors de l'ajout de l'utilisateur.");
        }
    }

    public static function deleteUser(){
        try {
            Database::getInstance()
                ->prepare("DELETE FROM user WHERE idUser = :idUser")
                ->execute(["idUser" => $_POST["idUser"]]);
            Feedback::setSuccess("Suppression de l'utilisateur enregistrée.");
        } catch (\Exception $e) {
            throw $e;
            Feedback::setError("Une erreur s'est produite lors de la suppression de l'utilisateur.");
        }
    }

}