<?php

namespace App\Models;

use CodeIgniter\Model;

class RtModel extends Model
{
    protected $table = 'tbl_rt';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'keterangan', 'latitude', 'longitude', 'geometry', 'rw_id'];
    
    public function getCountKasus()
    {
        $sql = "SELECT rt.*, COUNT(k.id) Jumlah FROM tbl_rt rt ";
        $sql .= "LEFT JOIN tbl_kasus k ON k.rt_id=rt.id AND k.status IN (1, 2) ";
        $sql .= "GROUP BY rt.id";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
