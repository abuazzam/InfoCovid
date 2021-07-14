<?php

namespace App\Controllers;

use App\Models\RtModel;
use App\Models\KasusModel;
use App\Models\HistoryModel;

class Home extends BaseController
{
	public function index()
	{
	    $model = new RtModel();
		$data = $model->getCountKasus();

		$kasusModel = new KasusModel();
		$baru = $kasusModel->getKasusBaru();
		$status = $kasusModel->getCountStatus();

		$baru = $baru->baru ?? 0;
		
		$historyModel = new HistoryModel();
		$daily = $historyModel->getChartDaily('2021-06-10', date('Y-m-d'));
	    
		return view('home', compact('data', 'daily', 'baru', 'status'));
	}
}
