<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_spl';

    protected $returnType     = 'object';
    //protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'id_spl',
        'nm_spl',
        'tl_spl',
        'al_spl',
        'slug',
    ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getSupplier($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($cari)
    {
        $builder = $this->table('supplier');

        $builder->like('id_spl', $cari);
        $builder->orlike('nm_spl', $cari);
        $builder->orlike('tl_spl', $cari);
        $builder->orlike('al_spl', $cari);

        return $builder;
    }
}
