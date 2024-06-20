<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table = 'tbl_divisi';
    protected $allowedFields = ['nama_divisi'];
}
