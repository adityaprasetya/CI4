<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_pjl';

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_pjl',
        'id_plg',
        'id_brg',
        'nm_pjl',
        'qty',
        'hrg',
        'ttl',
        'tgl',
        'sts',
        'ktr',
        'slug'
    ];

    public function getPenjualan($slug = false)
    {
        if ($slug == false) {
            $builder = $this->table('penjualan');
            $builder->join('pelanggan', 'pelanggan.id_plg = penjualan.id_plg');
            $builder->join('barang', 'barang.id_brg = penjualan.id_brg');
            $query = $builder->get()->getResultArray();
            return $query;
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($cari)
    {
        $builder = $this->table('penjualan');

        $builder->like('nm_pjl', $cari);
        $builder->orlike('nm_brg', $cari);
        $builder->orlike('nm_plg', $cari);
        $builder->orlike('sts', $cari);

        return $builder;
    }

    public function getKode_Pj()
    {
        $builder = $this->table('penjualan');
        $builder->selectMax('nm_pjl', 'nm_pjlmax');
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            foreach ($query->getResult() as $kd) {
                $key = '';
                $ambilkey = substr($kd->nm_pjlmax, -4);
                $increment = intval($ambilkey) + 1;

                $key = sprintf('%04s', $increment);
            }
        } else {
            $key = '0001';
        }

        return 'BR-' . $key;
    }
}
