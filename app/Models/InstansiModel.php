<?php

namespace App\Models;

use CodeIgniter\Model;

class InstansiModel extends Model
{
    protected $table = 'tbl_instansi';
    protected $allowedFields = ['nama_instansi'];
}
