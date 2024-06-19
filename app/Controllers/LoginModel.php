<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'tbl_login';
    protected $allowedFields = ['nama_user', 'username', 'password'];
}
