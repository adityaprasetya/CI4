<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id',
        'nm_plg',
        'jn_klm',
        'tlp',
        'almt',
        'slug',
    ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPelanggan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($cari)
    {
        $builder = $this->table('pelanggan');

        $builder->like('id', $cari);
        $builder->orlike('nm_plg', $cari);
        $builder->orlike('jn_klm', $cari);
        $builder->orlike('tlp', $cari);
        $builder->orlike('almt', $cari);

        return $builder;
    }
}
