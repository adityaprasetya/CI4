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
        'slug_spl',
    ];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getJmlSupplier()
    {
        $builder = $this->table('supplier');
        return $builder->countAll();
    }

    public function getSupplier($slug_spl = false)
    {
        if ($slug_spl == false) {
            return $this->table('supplier')->findAll();
        }

        return $this->where(['slug_spl' => $slug_spl])->first();
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
