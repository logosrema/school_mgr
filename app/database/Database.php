<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = 'localhost';
        $dbname = 'school_mg';  
        $username = 'root';      
        $password = '';       

        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    // Singleton: one instance reused everywhere
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    // SELECT all rows
    public static function select($query, $params = []) {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SELECT one row
    public static function selectOne($query, $params = []) {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // INSERT a record
    public static function insert($query, $params = []) {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $pdo->lastInsertId(); // Return inserted ID
    }

    // UPDATE a record
    public static function update($query, $params = []) {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($query);
        return $stmt->execute($params); // Returns true/false
    }

    // DELETE a record
    public static function delete($query, $params = []) {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($query);
        return $stmt->execute($params); // Returns true/false
    }
}
