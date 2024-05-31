<?php
// User.php

class User {
    protected $table = 'users';
    protected $attributes = [
        'id' => 'id',
        'user_name' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string'
    ];

    public function getTable() {
        return $this->table;
    }

    public function getAttributes() {
        return $this->attributes;
    }
}

?>
