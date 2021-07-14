<?php

namespace App\Models;

use DateTime;
use DatePeriod;
use DateInterval;
use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table = 'tbl_history';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'kasus_id',
        'status',
    ];

    public function getHistorySatusDaily($start=false, $end=false)
    {
        
        if ($start && $end) 
        {
            $this->builder()->where([
                "DATE(created_at) >=" => $start,
                "DATE(created_at) <=" => $end,
            ]);
        } 
        else if ($start) {
            $this->builder()->where("MONTH(created_at)", $start);
        }

        $this->builder()
            ->select([
                "DATE(created_at) tgl",
                "count(id) total",
                "count(case when status in (1, 2) then 1 else null end) positif",
                "count(case when status = 3 then 1 else null end) sembuh",
                "count(case when status = 4 then 1 else null end) meninggal"
            ])
            ->groupby("DATE(created_at)");
        return $this->get()->getResult();
    }

    public function getChartDaily($start, $end)
    {
        $result = $this->getHistorySatusDaily($start, $end);
        $days = $this->getDatesFromRange($start, $end);

        $data = [];
        foreach($days as $d)
        {
            $data[$d] = (object) [
                'tgl' => $d,
                'positif' => 0,
                'sembuh' => 0,
                'meninggal' => 0,
                'total' => 0,
            ];
        }
        foreach($result as $r)
        {
            $data[$r->tgl] = $r;
        }

        $total = 0;
        foreach($days as $d)
        {
            $p = $data[$d]->positif;
            $s = $data[$d]->sembuh;
            $m = $data[$d]->meninggal;
            $t = $data[$d]->total;
            if ($p == 0)
            {
                $total -= $t;
                $data[$d]->total = $total;
            } 
            else
            {
                $total += $t;
                $data[$d]->total = $total;
            }

        }

        return $data;
    }


    // Function to get all the dates in given range
    private function getDatesFromRange($start, $end, $format = 'Y-m-d') 
    {
      
        // Declare an empty array
        $array = array();
        
        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');
    
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
    
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    
        // Use loop to store date into array
        foreach($period as $date) {                 
            $array[] = $date->format($format); 
        }
    
        // Return the array elements
        return $array;
    }


}