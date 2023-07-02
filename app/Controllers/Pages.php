<?php

		namespace App\Controllers;
		use App\Models\ProdukModel;
		use App\Models\UserModel;

		class Pages extends BaseController
		{
			public function keranjang()
			{
				return view('pages/keranjang_view');
			} 

			public function produk()
			{
				$produkModel = new ProdukModel(); 
				$produk = $produkModel->findAll();
				$data['produks'] = $produk;

				return view('Pages/produk_view', $data);
			} 

			public function user()
			{
				$userModel = new UserModel();
				$user = $userModel->findAll();
				$data['users'] = $user;

				return view('Pages/user_view', $data);

			}
		}