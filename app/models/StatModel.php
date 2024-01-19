<?php
namespace App\Models;
use Config\Database;
use App\Class\User;
use App\Class\Feedback;
use DateTime;

class StatModel {

    private static function calculAge($dateNaissance) {
        $dateActuelle = new DateTime();
        $dateNaissance = new DateTime($dateNaissance);
        $difference = $dateActuelle->diff($dateNaissance);
        return $difference->y;
    }

    private static function calculAgeCondition($field, $operator, $value) {
        return "calculAge($field) $operator $value";
    }

    public static function getUnder25Men(){
        $sql = "SELECT COUNT(*) as count FROM user WHERE ". self::calculAgeCondition("birthDay", "<", 25) ." AND gender = 1";
        $res = Database::getInstance()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public static function getUnder25Women(){
        $sql = "SELECT COUNT(*) as count FROM user WHERE ". self::calculAgeCondition("birthDay", "<", 25) ." AND gender = 2";
        $res = Database::getInstance()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public static function getBetween25_50Men(){
        $sql = "SELECT COUNT(*) as count FROM user WHERE ". self::calculAge(birthDay)." BETWEEN 25 AND 50 AND gender = 1";
        $res = Database::getInstance()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public static function getBetween25_50Women(){
        $sql = "SELECT COUNT(*) as count FROM user WHERE ". self::calculAge(birthDay)." BETWEEN 25 AND 50 AND gender = 2";
        $res = Database::getInstance()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public static function getOver50Men(){
        $sql = "SELECT COUNT(*) as count FROM user WHERE ". self::calculAgeCondition("birthDay", ">", 50) ." AND gender = 1";
        $res = Database::getInstance()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public static function getOver50Women(){
        $sql = "SELECT COUNT(*) as count FROM user WHERE ". self::calculAgeCondition("birthDay", ">", 50) ." AND gender = 2";
        $res = Database::getInstance()->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }



}