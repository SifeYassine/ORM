<?php
// testReadAll.php

require 'ORM.php';

try {
    $orm = new ORM('users');
    $users = $orm->all();

    if ($users) {
        echo "Users found: " . count($users) . "\n\n";
        foreach ($users as $user) {
            echo $user['id'] . " | " . $user['user_name'] . " | " . $user['first_name'] . " | " . $user['last_name'] . " | " . $user['email'] . "\n";
        }
    } else {
        echo "No users found.";
    }
} catch (Exception $e) {
    echo "Error reading users: " . $e->getMessage();
}
?>
