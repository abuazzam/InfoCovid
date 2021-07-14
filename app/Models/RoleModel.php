<?php

namespace App\Models;

class RoleModel
{
    private $role = [
        [
            'id' => 1,
            'nama' => 'Administrator',
        ],
        [
            'id' => 2,
            'nama' => 'User',
        ],
    ];

    public function findAll()
    {
        return $this->role;
    }
}