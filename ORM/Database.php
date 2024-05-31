<?php
// Database.php

class Database {
    private $pdo;

    public function __construct() {
        $config = require 'config.php';
        if (!isset($this->pdo)) {
            try {
                $this->pdo = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password'], $config['options']);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
