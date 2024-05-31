<?php
// ORM.php

require 'Database.php';
require 'ORMInterface.php';

class ORM implements ORMInterface {
    protected $db;
    protected $table;
    protected $attributes = [];

    public function __construct($table) {
        $this->db = (new Database())->getConnection();
        $this->table = $table;
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function create($attributes) {
        $columns = implode(", ", array_keys($attributes));
        $values = ":" . implode(", :", array_keys($attributes));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($values)");

        return $stmt->execute($attributes);
    }

    public function update($id, $attributes) {
        $columns = '';
        foreach ($attributes as $key => $value) {
            $columns .= "$key = :$key, ";
        }
        $columns = rtrim($columns, ', ');
        $stmt = $this->db->prepare("UPDATE {$this->table} SET $columns WHERE id = :id");

        $attributes['id'] = $id;
        return $stmt->execute($attributes);
    }

    public function save($attributes) {
        if (isset($attributes['id'])) {
            return $this->update($attributes['id'], $attributes);
        } else {
            return $this->create($attributes);
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function createTable($columns) {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (";
        $cols = [];
        foreach ($columns as $column => $type) {
            switch ($type) {
                case 'id':
                    $cols[] = "$column INT PRIMARY KEY AUTO_INCREMENT";
                    break;
                case 'string':
                    $cols[] = "$column VARCHAR(255)";
                    break;
                case 'text':
                    $cols[] = "$column TEXT";
                    break;
                case 'integer':
                    $cols[] = "$column INT";
                    break;
                case 'boolean':
                    $cols[] = "$column BOOLEAN";
                    break;
                default:
                    throw new Exception("Unknown column type: $type");
            }
        }
        $sql .= implode(", ", $cols) . ");";
        $this->db->exec($sql);
    }

    public function alterTable($choice, $columns = []) {
        $sql = "ALTER TABLE {$this->table} ";
        $actions = [];

        if ($choice === 'ADD') {
            foreach ($columns as $column => $type) {
                switch ($type) {
                    case 'id':
                        $actions[] = "ADD $column INT PRIMARY KEY AUTO_INCREMENT";
                        break;
                    case 'string':
                        $actions[] = "ADD $column VARCHAR(255)";
                        break;
                    case 'text':
                        $actions[] = "ADD $column TEXT";
                        break;
                    case 'integer':
                        $actions[] = "ADD $column INT";
                        break;
                    case 'boolean':
                        $actions[] = "ADD $column BOOLEAN";
                        break;
                    default:
                        throw new Exception("Unknown column type: $type");
                }
            }
        } elseif ($choice === 'DROP') {
            foreach ($columns as $column) {
                $actions[] = "DROP COLUMN $column";
            }
        } else {
            throw new Exception("Unknown choice: $choice. Use 'ADD' or 'DROP'.");
        }

        $sql .= implode(", ", $actions) . ";";
        $this->db->exec($sql);
    }
}
?>
