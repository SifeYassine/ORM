<?php
// createTable.php

require 'ORM.php';
require 'User.php';

try {
    $user = new User();
    $orm = new ORM($user->getTable());
    $orm->createTable($user->getAttributes());

    echo "Table '{$user->getTable()}' created successfully.";
} catch (Exception $e) {
    echo "Error creating table '{$user->getTable()}': " . $e->getMessage();
}
?>