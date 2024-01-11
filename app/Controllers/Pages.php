<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\SupplierModel;

class Pages extends BaseController
{

    protected $barangModel;
    protected $pelangganModel;
    protected $supplierModel;
    protected $penjualanModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->pelangganModel = new PelangganModel();
        $this->supplierModel = new SupplierModel();
        $this->penjualanModel = new PenjualanModel();
    }

    // ----------------------------------------------------------------------------------------------------
    // PAGE
    // ----------------------------------------------------------------------------------------------------

    public function chart_data()
    {
        $data = $this->barangModel->getBarang();
        $json = array_values($data);

        echo json_encode($json);
    }

    public function index()
    {
        $data = [
            'title' => 'Home | Penjualan',
            'supplier' => $this->supplierModel->getSupplier(),
            'penjualan' => $this->penjualanModel->getPenjualan(),
            'pelanggan' => $this->pelangganModel->getPelanggan(),
            'barang' => $this->barangModel->getBarang(),

            'jmlbrg' => $this->barangModel->getJmlBarang(),
            'jmlspl' => $this->supplierModel->getJmlSupplier(),
            'jmlplg' => $this->pelangganModel->getJmlPelanggan()
        ];
        echo view('pages/dashboard', $data);
    }

    public function barang()
    {
        // $barang = $this->barangModel->findAll();
        $currentPage = $this->request->getVar('pagination') ? $this->request->getVar('pagination') : 1;

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
        $currentPage = $this->request->getVar('pagination') ? $this->request->getVar('pagination') : 1;

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

    public function supplier()
    {
        $currentPage = $this->request->getVar('pagination') ? $this->request->getVar('pagination') : 1;

        $cari = $this->request->getVar('cari');
        if ($cari) {
            $cari_supplier = $this->supplierModel->search($cari);
        } else {
            $cari_supplier = $this->supplierModel;
        }

        $data = [
            'title' => 'Supplier | Penjualan',
            'supplier' => $this->supplierModel->getSupplier(),

            'cari_pelanggan' => $cari_supplier->paginate(5, 'barang'),
            'pager' => $this->supplierModel->pager,
            'currentPage' => $currentPage
        ];


        echo view('pages/supplier/index', $data);
    }

    public function penjualan()
    {
        $currentPage = $this->request->getVar('pagination') ? $this->request->getVar('pagination') : 1;

        $cari = $this->request->getVar('cari');
        if ($cari) {
            $cari_penjualan = $this->penjualanModel->search($cari);
        } else {
            $cari_penjualan = $this->penjualanModel;
        }

        $data = [
            'title' => 'Penjualan | Penjualan',
            'penjualan' => $this->penjualanModel->getPenjualan(),

            'cari_penjualan' => $cari_penjualan->paginate(5, 'penjualan'),
            'pager' => $this->penjualanModel->pager,
            'currentPage' => $currentPage
        ];


        echo view('pages/penjualan/index', $data);
    }

    // ----------------------------------------------------------------------------------------------------
    // BARANG
    // ----------------------------------------------------------------------------------------------------

    // VIEW
    public function detail($slug_brg)
    {
        $data = [
            'title' => 'Detail Product | Penjualan',
            'barang' => $this->barangModel->getBarang($slug_brg),
            'supplier' => $this->supplierModel->getSupplier()
        ];

        $barang = $this->barangModel->find($slug_brg);
        if (is_object($barang)) {
            $data['barang'] = $barang;
            return view('barang/edit', $data);
        }

        //jika tidak ada data
        if (empty($data['barang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang ' . $slug_brg . ' Tidak DItemukan');
        }

        return view('pages/barang/detail', $data);
    }

    // CREATE
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barangModel->getBarang(),
            'supplier' => $this->supplierModel->getSupplier()
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
            ],
            'hrg' => [
                'rules' => 'required[barang.hrg]',
                'errors' => [
                    'required' => '{field} Harga harus diisi.',
                ]
            ],
            'stk' => [
                'rules' => 'required[barang.stk]',
                'errors' => [
                    'required' => '{field} Stok harus diisi.',
                ]
            ]
        ])) {
            session()->setFlashdata('pesan', 'Data belum terisi');
            return redirect()->to('pages/create')->withInput();
        }

        $barang = new BarangModel();
        $slug_brg = url_title($this->request->getVar('nm_brg'), '-', true);
        $data = [
            'id_brg' => $this->request->getPost('id_brg'),
            'id_spl' => $this->request->getPost('id_spl'),
            'nm_brg' => $this->request->getPost('nm_brg'),
            'hrg' => $this->request->getPost('hrg'),
            'stk' => $this->request->getPost('stk'),
            'sat' => $this->request->getPost('sat'),
            'slug_brg' => $slug_brg,
        ];

        $barang->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/barang');
    }

    // DELETE
    public function delete($id_brg)
    {
        $barangModel = new BarangModel();
        if ($barangModel->delete($id_brg)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/pages/barang');
        }
    }

    // UPDATE
    public function edit($slug_brg)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barangModel->getBarang($slug_brg),
            'supplier' => $this->supplierModel->getSupplier()
        ];

        $barang = $this->barangModel->find($slug_brg);
        if (is_object($barang)) {
            $data['barang'] = $barang;
            return view('pages/barang/edit', $data);
        }

        return view('pages/barang/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nm_brg' => [
                'rules' => 'required[barang.nm_brg]',
                'errors' => [
                    'required' => '{field} Nama barang harus diisi.',
                    'is_unique' => '{field} Nama barang sudah ada.'
                ]
            ],
            'hrg' => [
                'rules' => 'required[barang.hrg]',
                'errors' => [
                    'required' => '{field} Harga harus diisi.',
                ]
            ],
            'stk' => [
                'rules' => 'required[barang.stk]',
                'errors' => [
                    'required' => '{field} Stok harus diisi.',
                ]
            ]
        ])) {

            $validation = \Config\Services::validation();
            return redirect()->to('pages/edit/' . $this->request->getVar('slug_brg'))->withInput()->with('validation', $validation);
        }

        $slug_brg = url_title($this->request->getVar('nm_brg'), '-', true);
        $this->barangModel->save([
            'id_brg' => $id,
            'id_spl' => $this->request->getVar('id_spl'),
            'nm_brg' => $this->request->getVar('nm_brg'),
            'hrg' => $this->request->getVar('hrg'),
            'stk' => $this->request->getVar('stk'),
            'sat' => $this->request->getVar('sat'),
            'slug_brg' => $slug_brg,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/barang');
    }

    // ----------------------------------------------------------------------------------------------------
    // PELANGGAN
    // ----------------------------------------------------------------------------------------------------

    // VIEW
    public function detail_pl($slug_plg)
    {
        $data = [
            'title' => 'Detail Pelanggan | Penjualan',
            'pelanggan' => $this->pelangganModel->getPelanggan($slug_plg)
        ];

        //jika tidak ada data
        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pelanggan ' . $slug_plg . ' Tidak DItemukan');
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
        $slug_plg = url_title($this->request->getVar('nm_plg'), '-', true);
        $data = [
            'id_plg' => $this->request->getPost('id_plg'),
            'nm_plg' => $this->request->getPost('nm_plg'),
            'jn_klm' => $this->request->getPost('jn_klm'),
            'tlp' => $this->request->getPost('tlp'),
            'almt' => $this->request->getPost('almt'),
            'slug_plg' => $slug_plg,
        ];

        $pelanggan->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/pelanggan');
    }

    // DELETE
    public function delete_pl($id_plg)
    {
        $pelangganModel = new PelangganModel();
        if ($pelangganModel->delete($id_plg)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/pages/pelanggan');
        }
    }

    // UPDATE
    public function edit_pl($slug_plg)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'pelanggan' => $this->pelangganModel->getPelanggan($slug_plg)
        ];

        return view('pages/pelanggan/edit', $data);
    }

    public function update_pl($id)
    {
        $slug_plg = url_title($this->request->getVar('nm_plg'), '-', true);
        $this->pelangganModel->save([
            'id_plg' => $id,
            'nm_plg' => $this->request->getVar('nm_plg'),
            'jn_klm' => $this->request->getVar('jn_klm'),
            'tlp' => $this->request->getVar('tlp'),
            'almt' => $this->request->getVar('almt'),
            'slug_plg' => $slug_plg,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/pelanggan');
    }

    // ----------------------------------------------------------------------------------------------------
    // SUPPLIER
    // ----------------------------------------------------------------------------------------------------

    // VIEW
    public function detail_sl($slug_spl)
    {
        $data = [
            'title' => 'Detail Supplier | Penjualan',
            'supplier' => $this->supplierModel->getSupplier($slug_spl)
        ];

        //jika tidak ada data
        if (empty($data['supplier'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Supplier ' . $slug_spl . ' Tidak DItemukan');
        }

        return view('pages/supplier/detail', $data);
    }

    // CREATE
    public function create_sl()
    {
        $data = [
            'title' => 'Form Tambah Supplier',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/supplier/create', $data);
    }

    public function save_sl()
    {
        if (!$this->validate([
            'nm_spl' => [
                'rules' => 'required|is_unique[supplier.nm_spl]',
                'errors' => [
                    'required' => '{field} Nama supplier harus diisi.',
                    'is_unique' => '{field} Nama supplier sudah ada.'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan', 'Data belum terisi');
            return redirect()->to('pages/supplier/create')->withInput();
        }

        $supplier = new SupplierModel();
        $slug_spl = url_title($this->request->getVar('nm_spl'), '-', true);
        $data = [
            'id_spl' => $this->request->getPost('id_spl'),
            'nm_spl' => $this->request->getPost('nm_spl'),
            'tl_spl' => $this->request->getPost('tl_spl'),
            'al_spl' => $this->request->getPost('al_spl'),
            'slug_spl' => $slug_spl,
        ];

        $supplier->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/supplier');
    }

    // DELETE
    public function delete_sl($id)
    {
        $supplierModel = new SupplierModel();
        if ($supplierModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/pages/supplier');
        }
    }

    // UPDATE
    public function edit_sl($slug_spl)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'supplier' => $this->supplierModel->getSupplier($slug_spl)
        ];

        return view('pages/supplier/edit', $data);
    }

    public function update_sl($id)
    {
        $slug_spl = url_title($this->request->getVar('nm_spl'), '-', true);
        $this->supplierModel->save([
            'id_spl' => $id,
            'nm_spl' => $this->request->getVar('nm_spl'),
            'tl_spl' => $this->request->getVar('tl_spl'),
            'al_spl' => $this->request->getVar('al_spl'),
            'slug_spl' => $slug_spl,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/supplier');
    }

    // ----------------------------------------------------------------------------------------------------
    // PENJUALAN
    // ----------------------------------------------------------------------------------------------------


    // OTOMATIS
    public function kode_pj()
    {
        return json_encode($this->penjualanModel->getKode_Pj());
    }

    public function harga_pj()
    {
        $barang = new BarangModel();
        $data = $barang->find('$id_brg');

        return view('penjualan/edit_pj', $data);
    }

    // VIEW
    public function detail_pj($slug_pjl)
    {
        $data = [
            'title' => 'Detail Penjualan | Penjualan',
            'penjualan' => $this->penjualanModel->getPenjualan($slug_pjl),
            'pelanggan' => $this->pelangganModel->getPelanggan(),
            'barang' => $this->barangModel->getBarang()
        ];

        $penjualan = $this->penjualanModel->find($slug_pjl);
        if (is_object($penjualan)) {
            $data['penjualan'] = $penjualan;
            return view('penjualan/edit', $data);
        }

        //jika tidak ada data
        if (empty($data['penjualan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Penjualan ' . $slug_pjl . ' Tidak DItemukan');
        }

        return view('pages/penjualan/detail', $data);
    }

    // CREATE
    public function create_pj()
    {
        $data = [
            'title' => 'Form Tambah Penjualan',
            'validation' => \Config\Services::validation(),
            'penjualan' => $this->penjualanModel->getPenjualan(),
            'pelanggan' => $this->pelangganModel->getPelanggan(),
            'barang' => $this->barangModel->getBarang()

        ];

        return view('pages/penjualan/create', $data);
    }

    public function save_pj()
    {
        if (!$this->validate([
            'qty' => [
                'rules' => 'required|is_unique[penjualan.qty]',
                'errors' => [
                    'required' => '{field} Nomor penjualan harus diisi.',
                    'is_unique' => '{field} Nomor penjualan sudah ada.'
                ]
            ]
        ])) {
            return redirect()->to('pages/penjualan/create')->withInput();
        }

        $penjualan = new PenjualanModel();
        $slug_pjl = url_title($this->request->getVar('nm_pjl'), '-', true);
        $data = [
            'id_pjl' => $this->request->getPost('id_pjl'),
            'id_plg' => $this->request->getPost('id_plg'),
            'id_brg' => $this->request->getPost('id_brg'),
            'nm_pjl' => $this->request->getPost('nm_pjl'),
            'qty' => $this->request->getPost('qty'),
            'tgl' => $this->request->getPost('tgl'),
            'sts' => $this->request->getPost('sts'),
            'ktr' => $this->request->getPost('ktr'),
            'slug_pjl' => $slug_pjl,
        ];

        $penjualan->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/penjualan');
    }

    // DELETE
    public function delete_pj($id_pjl)
    {
        $penjualanModel = new PenjualanModel();
        if ($penjualanModel->delete($id_pjl)) {
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/pages/penjualan');
        }
    }

    // UPDATE
    public function edit_pj($slug_pjl)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'penjualan' => $this->penjualanModel->getPenjualan($slug_pjl),
            'pelanggan' => $this->pelangganModel->getPelanggan(),
            'barang' => $this->barangModel->getBarang()
        ];

        return view('pages/penjualan/edit', $data);
    }

    public function update_pj($id_pjl)
    {
        $slug_pjl = url_title($this->request->getVar('nm_pjl'), '-', true);
        $this->penjualanModel->save([
            'id_pjl' => $id_pjl,
            'id_plg' => $this->request->getPost('id_plg'),
            'id_brg' => $this->request->getPost('id_brg'),
            'nm_pjl' => $this->request->getPost('nm_pjl'),
            'qty' => $this->request->getPost('qty'),
            'tgl' => $this->request->getPost('tgl'),
            'sts' => $this->request->getPost('sts'),
            'ktr' => $this->request->getPost('ktr'),
            'slug_pjl' => $slug_pjl,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/penjualan');
    }
}
