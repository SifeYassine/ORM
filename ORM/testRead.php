<?php
// testRead.php

require 'ORM.php';

try {
    $orm = new ORM('users');
    $user = $orm->find(1);

    if ($user) {
        echo "User found: " . $user['id'] . " | " . $user['user_name'] . " | " . $user['first_name'] . " | " . $user['last_name'] . " | " . $user['email'];
    } else {
        echo "User not found.";
    }
} catch (Exception $e) {
    echo "Error reading user: " . $e->getMessage();
}
?>
