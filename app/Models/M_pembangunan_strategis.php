<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pembangunan_strategis extends Model
{
    protected $table      = 'pembangunan_strategis';
    protected $primaryKey = 'id';
    protected $returnType     = 'object';
    // protected $allowedFields = ['nama', 'jenis_kelamin', 'no_telp', 'email', 'tanggal_lahir', 'alamat'];
}
