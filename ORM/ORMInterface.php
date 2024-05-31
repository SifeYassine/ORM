<?php
// ORMInterface.php

interface ORMInterface {
    public function find($id);
    public function all();
    public function create($attributes);
    public function update($id, $attributes);
    public function save($attributes);
    public function delete($id);
    public function createTable($columns);
    public function alterTable($choice, $columns = []);
}
?>
