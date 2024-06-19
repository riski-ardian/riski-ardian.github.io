<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\DivisiModel;
use App\Models\InstansiModel;
use App\Models\DaftarModel;

class AdminController extends BaseController
{
    protected $divisiModel;
    protected $instansiModel;
    protected $daftarModel;
    protected $loginModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
        $this->instansiModel = new InstansiModel();
        $this->daftarModel = new DaftarModel();
        $this->loginModel = new LoginModel();
        session();
    }

    public function login()
    {
        $data = [
            'title' => 'SAKTI Guestbook | Admin Login'
        ];

        return view('pages/admin/login', $data);
    }

    public function save_login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if (!empty($username) && !empty($password)) {
            $login = $this->loginModel->where('username', $username)->first();

            if ($login) {
                if (md5($password) == $login['password']) {
                    session()->set([
                        'username' => $login['username'],
                        'nama' => $login['nama_user'],
                        'isLoggedIn' => true
                    ]);

                    session()->setFlashdata('loggedin', 'Login Berhasil!');
                    return redirect()->to('/dashboard');
                } else {
                    session()->setFlashdata('gagal', 'Password Salah!');
                }
            } else {
                session()->setFlashdata('gagal', 'Username Tidak Ditemukan!');
            }
        } else {
            if (empty($username) && $password) {
                session()->setFlashdata('gagal', 'Username Harus Diisi!');
            }
            if (empty($password) && $username) {
                session()->setFlashdata('gagal', 'Password Harus Diisi!');
            }
            if (empty($password) && empty($username)) {
                session()->setFlashdata('gagal', 'Username dan Password Harus Diisi!');
            }
        }

        return redirect()->to('/admin');
    }


    public function divisi()
    {
        $data = [
            'title' => 'SAKTI Guestbook | Daftar Divisi',
            'divisi' => $this->divisiModel->findAll(),
            'userLogin' => session()->get('nama')
        ];

        return view('pages/admin/divisi', $data);
    }

    public function instansi()
    {
        $data = [
            'title' => 'SAKTI Guestbook | Daftar Instansi',
            'instansi' => $this->instansiModel->paginate(10, 'tbl_instansi'),
            'userLogin' => session()->get('nama'),
            'pager' => $this->instansiModel->pager,
            'currentPage' => $this->request->getVar('page_tbl_instansi') ? (int) $this->request->getVar('page_tbl_instansi') : 1
        ];

        return view('pages/admin/instansi', $data);
    }


    public function dashboard()
    {
        $this->loginModel = new LoginModel();

        $data = [
            'title' => 'SAKTI Guestbook | Admin Dashboard',
            'total_tamu' => $this->daftarModel->countAllResults(),
            'totaltamu_saktitruss' => $this->daftarModel->hitungTamu('SAKTITRUSS'),
            'totaltamu_saktiglass' => $this->daftarModel->hitungTamu('SAKTIGLASS'),
            'total_divisi' => $this->divisiModel->countAllResults(),
            'total_instansi' => $this->instansiModel->countAllResults(),
            'userLogin' => session()->get('nama')
        ];

        return view('pages/admin/dashboard', $data);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }

    public function daftarTamu()
    {
        $daftarModel = $this->daftarModel;
        $daftarTamu = $daftarModel->paginate(10, 'tbl_tamu');
        $formattedData = [];

        foreach ($daftarTamu as $dt) {
            $created = $dt['created_at'];
            $tanggal = date('d-m-Y', strtotime($created));
            $waktu = date('H:i', strtotime($created));

            $formattedData[] = [
                'id' => $dt['id'],
                'nama' => $dt['nama'],
                'asal' => $dt['asal'],
                'divisi' => $dt['divisi'],
                'keperluan' => $dt['keperluan'],
                'keterangan' => $dt['keterangan'],
                'company' => $dt['company'],
                'tanggal' => $tanggal,
                'waktu' => $waktu,
            ];
        }

        $data = [
            'title' => 'Daftar Tamu',
            'daftartamu' => $formattedData,
            'pager' => $daftarModel->pager,
            'userLogin' => session()->get('nama')
        ];

        $searchKeyword = $this->request->getVar('search');
        if ($searchKeyword) {
            $daftarTamu = $daftarModel->search($searchKeyword);
        } else {
            $daftarTamu = $daftarModel->paginate(10, 'tbl_tamu');
        }

        return view('/pages/admin/daftar-tamu', $data);
    }

    public function delete_daftar($id)
    {
        if ($this->daftarModel->delete($id)) {
            session()->setFlashdata('deleted', 'Data berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data.');
        }

        return redirect()->to('/daftar-tamu');
    }

    public function delete_instansi($id)
    {
        if ($this->instansiModel->delete($id)) {
            session()->setFlashdata('deleted', 'Data berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data.');
        }

        return redirect()->to('/instansi');
    }

    public function delete_divisi($id)
    {
        if ($this->divisiModel->delete($id)) {
            session()->setFlashdata('deleted', 'Data berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data.');
        }

        return redirect()->to('/divisi');
    }
}
