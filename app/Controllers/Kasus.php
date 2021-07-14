<?php

namespace App\Controllers;

use App\Models\RtModel;
use App\Models\StatusModel;
use App\Models\KasusModel;

class Kasus extends BaseController
{
    protected $helpers = ['app'];

	public function index()
	{
        $rtModel = new RtModel();
        $rt = $rtModel->findAll();
        
        $model = new KasusModel();
        $kasus = $model->getKasus();
	    
		return view('kasus/index', compact('kasus'));
    }

    function add()
    {
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['nama' => 'required', 'rt_id' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid)
        {
            $model = new KasusModel();
            $model->insert([
                'nik' => $this->request->getPost('nik'),
                'no_kk' => $this->request->getPost('no_kk'),
                'nama' => $this->request->getPost('nama'),
                'kelamin' => $this->request->getPost('kelamin'),
                'usia' => $this->request->getPost('usia') ?: null,
                'alamat' => $this->request->getPost('alamat'),
                'rt_id' => $this->request->getPost('rt_id'),
                'status' => $this->request->getPost('status'),
                #'tanggal' => $this->request->getPost('tanggal'),
            ]);
            session()->setFlashdata('flash_msg', "Data Berhasil ditambahkan");
            return redirect()->to('/kasus');
        }

        $rtModel = new RtModel();
        $rt = $rtModel->findAll();

        $statusModel = new StatusModel();
        $status = $statusModel->findAll();

        return view('kasus/add_form', compact('rt', 'status'));
    }
    
    function edit($id)
    {
        if (! $id)
        {
            throw PageNotFoundException::forPageNotFound();
        }

        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['nama' => 'required', 'rt_id' => 'required|numeric']);
        $isDataValid = $validation->withRequest($this->request)->run();

        $model = new KasusModel();
        if ($isDataValid)
        {
            $model->update($id, [
                'nik' => $this->request->getPost('nik'),
                'no_kk' => $this->request->getPost('no_kk'),
                'nama' => $this->request->getPost('nama'),
                'kelamin' => $this->request->getPost('kelamin'),
                'usia' => $this->request->getPost('usia') ?: null,
                'alamat' => $this->request->getPost('alamat'),
                'rt_id' => $this->request->getPost('rt_id'),
                'status' => $this->request->getPost('status'),
                #'tanggal' => $this->request->getPost('tanggal'),
            ]);
            session()->setFlashdata('flash_msg', "Data Berhasil diubah");
            return redirect()->to('/kasus');
        }

        // ambil data lama
        $data = $model->where('id', $id)->first();

        $rtModel = new RtModel();
        $rt = $rtModel->findAll();

        $statusModel = new StatusModel();
        $status = $statusModel->findAll();

        return view('kasus/edit_form', compact('rt', 'status', 'data'));
    }

    public function delete($id)
    {
        if (! $id)
        {
            throw PageNotFoundException::forPageNotFound();
        }

        $model = new KasusModel();
        $model->delete($id);
        session()->setFlashdata('flash_msg', "Data Berhasil dihapus");
        return redirect()->to('kasus');
    }

    public function status($status, $id)
    {
        if (! $id)
        {
            throw PageNotFoundException::forPageNotFound();
        }

        $model = new KasusModel();
        $model->update($id, ['status' => $status]);
        session()->setFlashdata('flash_msg', "Status Berhasil diubah");
        return redirect()->to('kasus');
    }
}
