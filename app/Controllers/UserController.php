<?php

namespace App\Controllers;

use App\Models\DivisiModel;
use App\Models\DaftarModel;
use App\Models\InstansiModel;

class UserController extends BaseController
{
    protected $divisiModel;
    protected $daftarModel;
    protected $instansiModel;

    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
        $this->daftarModel = new DaftarModel();
        $this->instansiModel = new InstansiModel();
    }

    public function home()
    {
        $data = [
            'title' => 'Welcome to SAKTI Guestbook!'
        ];

        return view('pages/user/home', $data);
    }

    public function saktitruss()
    {
        $data = [
            'title' => 'SAKTI Guestbook | Form Tamu SAKTITRUSS',
            'daftardivisi' => $this->divisiModel->findAll(),
            'instansi' => $this->instansiModel->findAll()
        ];

        return view('pages/user/saktitruss', $data);
    }

    public function saktiglass()
    {
        $data = [
            'title' => 'SAKTI Guestbook | Form Tamu SATIGLASS',
            'daftardivisi' => $this->divisiModel->findAll(),
            'instansi' => $this->instansiModel->findAll()
        ];

        return view('pages/user/saktiglass', $data);
    }

    public function st_save()
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
            return redirect()->to('/saktitruss')->withInput();
        }

        $this->daftarModel->save([
            'nama' => $this->request->getVar('nama_tamu'),
            'asal' => $this->request->getVar('asal_instansi'),
            'divisi' => $this->request->getVar('divisi'),
            'keperluan' => $this->request->getVar('keperluan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'company' => $this->request->getVar('company')
        ]);

        $instansiExist = $this->instansiModel->where('nama_instansi', $this->request->getVar('asal_instansi'))->first();

        if (!$instansiExist) {
            $this->instansiModel->save(['nama_instansi' => $this->request->getVar('asal_instansi')]);
        }

        session()->setFlashdata('added', 'Data berhasil ditambahkan.');

        return redirect()->to('/saktitruss');
    }

    public function sg_save()
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
            $validation = \Config\Services::validation();
            return redirect()->to('/saktiglass')->withInput()->with('validation', $validation);
        }

        $this->daftarModel->save([
            'nama' => $this->request->getVar('nama_tamu'),
            'asal' => $this->request->getVar('asal_instansi'),
            'divisi' => $this->request->getVar('divisi'),
            'keperluan' => $this->request->getVar('keperluan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'company' => $this->request->getVar('company')
        ]);

        // if (!$this->instansiModel->where('nama_instansi', $this->request->getVar('asal_instansi'))->first()) {
        //     $this->instansiModel->insert(['nama_instansi' => $this->request->getVar('asal_instansi')]);

        $instansiExist = $this->instansiModel->where('nama_instansi', $this->request->getVar('asal_instansi'))->first();

        if (!$instansiExist) {
            $this->instansiModel->save(['nama_instansi' => $this->request->getVar('asal_instansi')]);
        }

        session()->setFlashdata('added', 'Data berhasil ditambahkan.');

        return redirect()->to('/saktiglass');
    }
}
