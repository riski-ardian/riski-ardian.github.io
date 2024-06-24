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

        return view('pages/admin/login/login', $data);
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
            'divisi' => $this->divisiModel->paginate(10, 'tbl_divisi'),
            'userLogin' => session()->get('nama'),
            'pager' => $this->divisiModel->pager,
            'currentPage' => $this->request->getVar('page_tbl_divisi') ? (int) $this->request->getVar('page_tbl_divisi') : 1
        ];

        return view('pages/admin/view/divisi', $data);
    }

    public function tambah_divisi()
    {
        $data = [
            'title' => 'SAKTI Guestbook | Form Tambah Divisi',
            'userLogin' => session()->get('nama'),
        ];

        return view('pages/admin/edit/tambah-divisi', $data);
    }

    public function simpan_divisi()
    {
        if (!$this->validate([
            'nama_divisi' => [
                'rules' => 'required|is_unique[tbl_divisi.nama_divisi,id,{id}]',
                'errors' => [
                    'required' => 'Nama Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.',
                    'is_unique' => 'Nama Divisi Sudah Ada. Silahkan Diisi Dengan Yang Lain.'
                ]
            ]
        ])) {
            return redirect()->to("/tambah-divisi")->withInput()->with('validation', \Config\Services::validation());
        }

        $this->divisiModel->save([
            'nama_divisi' => $this->request->getVar('nama_divisi')
        ]);

        session()->setFlashdata('added', 'Data berhasil ditambah.');

        return redirect()->to('/divisi');
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

        return view('pages/admin/view/instansi', $data);
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

        return view('pages/admin/view/dashboard', $data);
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

        return view('/pages/admin/view/daftar-tamu', $data);
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

    public function edit_divisi($id)
    {
        $data = [
            'title' => 'SAKTI Guestbook | Edit Daftar Divisi',
            'daftardivisi' => $this->divisiModel->find($id),
            'validation' => \Config\Services::validation(),
            'userLogin' => session()->get('nama')
        ];

        return view('pages/admin/edit/divisi-edit', $data);
    }

    public function update_divisi($id)
    {
        // Validate the input
        if (!$this->validate([
            'nama_divisi' => [
                'rules' => 'required|is_unique[tbl_divisi.nama_divisi,id,{id}]',
                'errors' => [
                    'required' => 'Nama Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.',
                    'is_unique' => 'Nama Divisi Sudah Ada. Silahkan Diisi Dengan Yang Lain.'
                ]
            ]
        ])) {
            return redirect()->to("/divisi/edit/$id")->withInput()->with('validation', \Config\Services::validation());
        }

        $this->divisiModel->save([
            'id' => $id,
            'nama_divisi' => $this->request->getVar('nama_divisi')
        ]);

        session()->setFlashdata('updated', 'Data berhasil diubah.');

        return redirect()->to('/divisi');
    }

    public function edit_instansi($id)
    {
        $data = [
            'title' => 'SAKTI Guestbook | Edit Daftar Instansi',
            'daftarinstansi' => $this->instansiModel->find($id),
            'validation' => \Config\Services::validation(),
            'userLogin' => session()->get('nama')
        ];

        return view('pages/admin/edit/instansi-edit', $data);
    }

    public function update_instansi($id)
    {
        // Validate the input
        if (!$this->validate([
            'nama_instansi' => [
                'rules' => 'required|is_unique[tbl_instansi.nama_instansi,id,{id}]',
                'errors' => [
                    'required' => 'Nama Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.',
                    'is_unique' => 'Nama Instansi Sudah Ada. Silahkan Diisi Dengan Yang Lain.'
                ]
            ]
        ])) {
            return redirect()->to("/instansi/edit/$id")->withInput()->with('validation', \Config\Services::validation());
        }

        $this->instansiModel->save([
            'id' => $id,
            'nama_instansi' => $this->request->getVar('nama_instansi')
        ]);

        session()->setFlashdata('updated', 'Data berhasil diubah.');

        return redirect()->to('/instansi');
    }

    public function edit_daftar($id)
    {
        $data = [
            'title' => 'SAKTI Guestbook | Edit Daftar Tamu',
            'daftartamu' => $this->daftarModel->find($id),
            'validation' => \Config\Services::validation(),
            'userLogin' => session()->get('nama'),
            'instansi' => $this->instansiModel->findAll(),
            'daftardivisi' => $this->divisiModel->findAll(),
        ];

        return view('pages/admin/edit/daftar-edit', $data);
    }

    public function update_daftar($id)
    {
        if (!$this->validate([
            'nama_tamu' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.',
                    'min_length' => 'Nama Tidak Boleh Kurang dari 3 Huruf.'
                ]
            ],
            'asal_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Asal Instansi Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.'
                ]
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Divisi Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.'
                ]
            ],
            'keperluan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keperluan Tidak Boleh Kosong. Silahkan Diisi Terlebih Dahulu.'
                ]
            ],

        ])) {
            return redirect()->to("/daftar-tamu/edit/$id")->withInput()->with('validation', \Config\Services::validation());
        }

        $this->daftarModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama_tamu'),
            'asal' => $this->request->getVar('asal_instansi'),
            'divisi' => $this->request->getVar('divisi'),
            'keperluan' => $this->request->getVar('keperluan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'company' => $this->request->getVar('company'),
        ]);

        $instansiExist = $this->instansiModel->where('nama_instansi', $this->request->getVar('asal_instansi'))->first();

        if (!$instansiExist) {
            $this->instansiModel->save(['nama_instansi' => $this->request->getVar('asal_instansi')]);
        }

        session()->setFlashdata('updated', 'Data berhasil diupdate.');

        return redirect()->to('/daftar-tamu');
    }
}
