<?php
// testUpdate.php

require 'ORM.php';

try {
    $orm = new ORM('users');
    $success = $orm->update(1, [
        'first_name' => 'Jane',
        'last_name' => 'Doe'
    ]);

    if ($success) {
        echo "User updated successfully.";
    } else {
        echo "Failed to update user.";
    }
} catch (Exception $e) {
    echo "Error updating user: " . $e->getMessage();
}
?>
