<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarModel extends Model
{
    protected $table = 'tbl_tamu';
    protected $allowedFields = ['nama', 'asal', 'divisi', 'keperluan', 'keterangan', 'company'];

    protected $useTimestamps = true;

    public function hitungTamu($namaCompany)
    {
        return $this->where('company', $namaCompany)->countAllResults();
    }

    public function search($searchKeyword)
    {
        return $this->like('company', $searchKeyword);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}
