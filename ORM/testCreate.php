<?php
// testCreate.php

require 'ORM.php';

try {
    $orm = new ORM('users');
    $success = $orm->create([
        'user_name' => 'sife69',
        'first_name' => 'Sife',
        'last_name' => 'Yassine',
        'email' => 'sife@example.com',
        'password' => password_hash('qwert123', PASSWORD_BCRYPT)
    ]);

    if ($success) {
        echo "User created successfully.";
    } else {
        echo "Failed to create user.";
    }
} catch (Exception $e) {
    echo "Error creating user: " . $e->getMessage();
}
?>
