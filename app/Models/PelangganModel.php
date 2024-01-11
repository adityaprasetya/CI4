<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_plg';

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id_plg',
        'nm_plg',
        'jn_klm',
        'tlp',
        'almt',
        'slug_plg',
    ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getJmlPelanggan()
    {
        $builder = $this->table('pelanggan');
        return $builder->countAll();
    }

    public function getPelanggan($slug_plg = false)
    {
        if ($slug_plg == false) {
            return $this->table('pelanggan')->findAll();
        }

        return $this->where(['slug_plg' => $slug_plg])->first();
    }

    public function search($cari)
    {
        $builder = $this->table('pelanggan');

        $builder->orlike('nm_plg', $cari);
        $builder->orlike('jn_klm', $cari);
        $builder->orlike('tlp', $cari);
        $builder->orlike('almt', $cari);

        return $builder;
    }
}
