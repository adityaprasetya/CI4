<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_brg';

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id_brg',
        'id_spl',
        'nm_brg',
        'hrg',
        'stk',
        'sat',
        'slug_brg',
    ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getJmlBarang()
    {
        $builder = $this->table('barang');
        return $builder->countAll();
    }

    public function getBarang($slug_brg = false)
    {
        if ($slug_brg == false) {
            $builder = $this->table('barang');
            $builder->join('supplier', 'supplier.id_spl = barang.id_spl');
            $builder->orderBy("id_brg", "desc");
            $query = $builder->get();
            return $query->getResult();
        }

        return $this->where(['slug_brg' => $slug_brg])->first();
    }

    public function search($cari)
    {
        $builder = $this->table('barang');
        $builder->like('nm_brg', $cari);
        $builder->orlike('nm_spl', $cari);
        $builder->orlike('hrg', $cari);
        $builder->orlike('stk', $cari);
        $builder->orlike('sat', $cari);

        return $builder;
    }
}
