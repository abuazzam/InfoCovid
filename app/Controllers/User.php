<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class User extends BaseController
{
	protected $helpers = ['app'];

	public function index()
	{
	    $model = new UserModel();
	    $user = $model->findAll();
	    
		return view('user/index', compact('user'));
	}

	function add()
    {
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules([
			'nama' => 'required', 
			'email' => 'required', 
			'password' => 'required'
		]);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid)
        {
			$password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $model = new UserModel();
            $model->insert([
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'nama' => $this->request->getPost('nama'),
                'password' => $password,
                'role' => $this->request->getPost('role'),
            ]);
            session()->setFlashdata('flash_msg', "Data Berhasil ditambahkan");
            return redirect()->to('/user');
        }

		$roleModel = new RoleModel();
		$role = $roleModel->findAll();
        return view('user/add_form', compact('role'));
    }

	function edit($id)
    {
        if (! $id)
        {
            throw PageNotFoundException::forPageNotFound();
        }

        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['username' => 'required', 'email' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        $model = new UserModel();
        if ($isDataValid)
        {
			$data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'nama' => $this->request->getPost('nama'),
                'role' => $this->request->getPost('role'),
			];

			$pass = $this->request->getPost('password');
			if ($pass)
			{
				$data['password'] = password_hash($pass, PASSWORD_DEFAULT);
			}
            
			$model->update($id, $data);
            session()->setFlashdata('flash_msg', "Data Berhasil diubah");
            return redirect()->to('/user');
        }

        // ambil data lama
		$data = $model->where('id', $id)->first();
		
		$roleModel = new RoleModel();
		$role = $roleModel->findAll();

        return view('user/edit_form', compact('data', 'role'));
    }

	public function delete($id)
    {
        if (! $id)
        {
            throw PageNotFoundException::forPageNotFound();
		}
		
		if ($id == 1)
		{
			return redirect()->to('user');
		}

        $model = new UserModel();
        $model->delete($id);
        session()->setFlashdata('flash_msg', "Data Berhasil dihapus");
        return redirect()->to('user');
	}
	
	public function login()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		if ($username && $password)
		{
			$session = session();
			$model = new UserModel();
			$login = $model->where('username', $username)->first();
			if ($login)
			{
				$pass = $login->password;
				if (password_verify($password, $pass))
				{
					$login_data = [
						'user_id' => $login->id,
						'username' => $login->username,
						'email' => $login->email,
						'nama' => $login->nama,
						'role' => $login->role,
						'logged_in' => TRUE,
					];
					$session->set($login_data);
					return redirect()->to('dash');
				}
				else
				{
					$session->setFlashdata("flash_msg", "Password salah.");
					return redirect()->to('/login');
				}
			}
			else
			{
				$session->setFlashdata("flash_msg", "Username tidak terdaftar.");
				return redirect()->to('/login');
			}
		}

		return view('login');
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}

}
