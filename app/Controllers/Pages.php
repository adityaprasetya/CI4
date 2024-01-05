<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PelangganModel;

class Pages extends BaseController
{

    protected $barangModel;
    protected $pelangganModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->pelangganModel = new PelangganModel();
    }

    // ----------------------------------------------------------------------------------------------------
    // PAGE
    // ----------------------------------------------------------------------------------------------------

    public function index()
    {
        $data = [
            'title' => 'Home | Penjualan',
        ];
        echo view('pages/dashboard', $data);
    }

    public function barang()
    {
        // $barang = $this->barangModel->findAll();
        $currentPage = $this->request->getVar('barang_page') ? $this->request->getVar('barang_page') : 1;

        $cari = $this->request->getVar('cari');
        if ($cari) {
            $cari_barang = $this->barangModel->search($cari);
        } else {
            $cari_barang = $this->barangModel;
        }

        $data = [
            'title' => 'Product | Penjualan',
            'barang' => $this->barangModel->getBarang(),

            'cari_barang' => $cari_barang->paginate(5, 'barang'),
            'pager' => $this->barangModel->pager,
            'currentPage' => $currentPage
        ];


        echo view('pages/barang/index', $data);
    }

    public function pelanggan()
    {
        // $barang = $this->barangModel->findAll();
        $currentPage = $this->request->getVar('pelanggan_page') ? $this->request->getVar('pelanggan_page') : 1;

        $cari = $this->request->getVar('cari');
        if ($cari) {
            $cari_pelanggan = $this->pelangganModel->search($cari);
        } else {
            $cari_pelanggan = $this->pelangganModel;
        }

        $data = [
            'title' => 'Pelanggan | Penjualan',
            'pelanggan' => $this->pelangganModel->getPelanggan(),

            'cari_pelanggan' => $cari_pelanggan->paginate(5, 'barang'),
            'pager' => $this->pelangganModel->pager,
            'currentPage' => $currentPage
        ];


        echo view('pages/pelanggan/index', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Penjualan',
            'nama_toko' => 'Toko Penjualan',
            'alamat_toko' => 'Cianjur',
            'ponsel' => '0811 xxxx xxxx'
        ];
        echo view('pages/contact', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About | Penjualan'
        ];
        echo view('pages/about', $data);
    }

    // ----------------------------------------------------------------------------------------------------
    // BARANG
    // ----------------------------------------------------------------------------------------------------

    // VIEW
    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Product | Penjualan',
            'barang' => $this->barangModel->getBarang($slug)
        ];

        //jika tidak ada data
        if (empty($data['barang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang ' . $slug . ' Tidak DItemukan');
        }

        return view('pages/barang/detail', $data);
    }

    // CREATE
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/barang/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nm_brg' => [
                'rules' => 'required|is_unique[barang.nm_brg]',
                'errors' => [
                    'required' => '{field} Nama barang harus diisi.',
                    'is_unique' => '{field} Nama barang sudah ada.'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan', 'Data belum terisi');
            return redirect()->to('pages/create')->withInput();
        }

        $barang = new BarangModel();
        $slug = url_title($this->request->getVar('nm_brg'), '-', true);
        $data = [
            'id' => $this->request->getPost('id'),
            'nm_brg' => $this->request->getPost('nm_brg'),
            'hrg' => $this->request->getPost('hrg'),
            'stk' => $this->request->getPost('stk'),
            'sat' => $this->request->getPost('sat'),
            'slug' => $slug,
        ];

        $barang->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/barang');
    }

    // DELETE
    public function delete($id)
    {
        $barangModel = new BarangModel();
        if ($barangModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/pages/barang');
        }
    }

    // UPDATE
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barangModel->getBarang($slug)
        ];

        return view('pages/barang/edit', $data);
    }

    public function update($id)
    {
        $slug = url_title($this->request->getVar('nm_brg'), '-', true);
        $this->barangModel->save([
            'id' => $id,
            'nm_brg' => $this->request->getVar('nm_brg'),
            'hrg' => $this->request->getVar('hrg'),
            'stk' => $this->request->getVar('stk'),
            'slug' => $slug,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/barang');
    }

    // ----------------------------------------------------------------------------------------------------
    // PELANGGAN
    // ----------------------------------------------------------------------------------------------------

    // VIEW
    public function detail_pl($slug)
    {
        $data = [
            'title' => 'Detail Pelanggan | Penjualan',
            'pelanggan' => $this->pelangganModel->getPelanggan($slug)
        ];

        //jika tidak ada data
        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pelanggan ' . $slug . ' Tidak DItemukan');
        }

        return view('pages/pelanggan/detail', $data);
    }

    // CREATE
    public function create_pl()
    {
        $data = [
            'title' => 'Form Tambah Pelanggan',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/pelanggan/create', $data);
    }

    public function save_pl()
    {
        if (!$this->validate([
            'nm_plg' => [
                'rules' => 'required|is_unique[pelanggan.nm_plg]',
                'errors' => [
                    'required' => '{field} Nama pelanggan harus diisi.',
                    'is_unique' => '{field} Nama pelanggan sudah ada.'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan', 'Data belum terisi');
            return redirect()->to('pages/pelanggan/create')->withInput();
        }

        $pelanggan = new PelangganModel();
        $slug = url_title($this->request->getVar('nm_plg'), '-', true);
        $data = [
            'id' => $this->request->getPost('id'),
            'nm_plg' => $this->request->getPost('nm_plg'),
            'jn_klm' => $this->request->getPost('jn_klm'),
            'tlp' => $this->request->getPost('tlp'),
            'almt' => $this->request->getPost('almt'),
            'slug' => $slug,
        ];

        $pelanggan->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/pelanggan');
    }

    // DELETE
    public function delete_pl($id)
    {
        $pelangganModel = new BarangModel();
        if ($pelangganModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/pages/pelanggan');
        }
    }

    // UPDATE
    public function edit_pl($slug)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'pelanggan' => $this->pelangganModel->getPelanggan($slug)
        ];

        return view('pages/pelanggan/edit', $data);
    }

    public function update_pl($id)
    {
        $slug = url_title($this->request->getVar('nm_plg'), '-', true);
        $this->pelangganModel->save([
            'id' => $id,
            'nm_plg' => $this->request->getVar('nm_plg'),
            'jn_klm' => $this->request->getVar('jn_klm'),
            'tlp' => $this->request->getVar('tlp'),
            'almt' => $this->request->getVar('almt'),
            'slug' => $slug,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/pelanggan');
    }
}
