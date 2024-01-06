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
        'nm_brg',
        'hrg',
        'stk',
        'sat',
        'slug',
    ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getBarang($slug = false)
    {
        if ($slug == false) {
            return $this->table('barang')->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($cari)
    {
        $builder = $this->table('barang');

        $builder->like('nm_brg', $cari);
        $builder->orlike('hrg', $cari);
        $builder->orlike('stk', $cari);
        $builder->orlike('sat', $cari);

        return $builder;
    }
}
