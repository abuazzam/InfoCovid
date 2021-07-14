<?php

namespace App\Models;

use CodeIgniter\Model;

class KasusModel extends Model
{
    protected $table = 'tbl_kasus';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'nik',
        'no_kk',
        'nama',
        'kelamin',
        'tgl_lahir',
        'usia',
        'alamat',
        'status',
        'rt_id'
    ];
    
    public function getKasus()
    {
        $this->builder()
            ->select(["{$this->table}.*", "rt.nama rt"])
            ->join("tbl_rt rt", "rt.id={$this->table}.rt_id", "left");
        return $this->findAll();
    }

    public function getKasusBaru()
    {
        $this->builder()
            ->select(["COUNT(id) baru"])
            ->where("WEEK(created_at)=WEEK(NOW())")
            ->groupby("WEEK(created_at)");
        return $this->get()->getFirstRow();
    }

    public function getCountStatus()
    {
        $this->builder()
            ->select([
                "count(case when status in (1, 2) then 1 else null end) positif",
                "count(case when status = 3 then 1 else null end) sembuh",
                "count(case when status = 4 then 1 else null end) meninggal"
            ]);
        return $this->get()->getFirstRow();
    }

    public function getCountStatusPerDay()
    {
        $this->builder()
            ->select([
                "DATE(created_at) tgl",
                "count(case when status in (1, 2) then 1 else null end) positif",
                "count(case when status = 3 then 1 else null end) sembuh",
                "count(case when status = 4 then 1 else null end) meninggal"
            ])
            ->groupby("DATE(created_at)");
        return $this->get()->getResult();
    }

    public function getPositif()
    {

    }

    public function getSembuh()
    {
        
    }


}
