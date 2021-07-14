<?php

namespace App\Models;

class StatusModel
{
    private $status = [
        [
            'id' => 1,
            'nama' => 'Isolasi Mandiri',
        ],
        [
            'id' => 2,
            'nama' => 'Rumah Sakit',
        ],
        [
            'id' => 3,
            'nama' => 'Sembuh',
        ],
        [
            'id' => 4,
            'nama' => 'Meningal',
        ],
    ];

    public function findAll()
    {
        return (object) $this->status;
    }
}