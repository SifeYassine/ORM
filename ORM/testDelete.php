<?php
// testDelete.php

require 'ORM.php';

try {
    $orm = new ORM('users');
    $success = $orm->delete(1);

    if ($success) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }
} catch (Exception $e) {
    echo "Error deleting user: " . $e->getMessage();
}
?>
