<?php

		namespace App\Controllers;

		use App\Models\userModel;

		class AuthController extends BaseController
		{
		    protected $user;

		    function __construct()
		    {
		        helper('form');
		        $this->user = new userModel();
		    }

		    public function login()
		    {
		        if ($this->request->getPost()) {
		            $username = $this->request->getVar('username');
		            $password = $this->request->getVar('password');

		            $dataUser = $this->user->where(['username' => $username])->first();

		            if ($dataUser) {
						if ($dataUser['is_aktif'] == false) {
							session()->setFlashdata('failed', 'Akun Belum Aktif');
							return redirect()->back();
						}

		                if (md5($password) == $dataUser['password']) {
		                    session()->set([
		                        'username' => $dataUser['username'],
		                        'role' => $dataUser['role'],
		                        'isLoggedIn' => TRUE
		                    ]);

		                    return redirect()->to(base_url('/'));
		                } else {
		                    session()->setFlashdata('failed', 'Username & Password Salah');
		                    return redirect()->back();
		                }

					
		            } else {
		                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
		                return redirect()->back();
		            }

					
					
		        } else {
		            return view('login_view');
		        }
		    }

		    public function logout()
		    {
		        session()->destroy();
		        return redirect()->to('login');
		    }

			public function register()
			{
				if ($this->request->getPost()) {
					$email = $this->request->getVar('email');
					$username = $this->request->getVar('username');
					$password = $this->request->getVar('password');

					$dataUser = [
						'email' => $email,
						'username' => $username,
						'password' => md5($password),
						'role' => 'user',
						'is_aktif' => 'false'
					];

					$this->user->insert($dataUser);

					return redirect()->to(base_url('login'));
				} else {
					return view('register_view');
				}
			}

			
		}

		