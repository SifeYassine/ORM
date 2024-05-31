<?php
// alterTable.php

require 'ORM.php';
require 'User.php';

try {
    $user = new User();
    $orm = new ORM($user->getTable());

    // Example of adding new columns
    $orm->alterTable('ADD', [
        'new_column1' => 'string',
        'new_column2' => 'integer'
    ]);

    // Example of dropping existing columns
    // $orm->alterTable('DROP', ['new_column1', 'new_column2']);

    echo "Table '{$user->getTable()}' altered successfully.";
} catch (Exception $e) {
    echo "Error altering table '{$user->getTable()}': " . $e->getMessage();
}
?>
