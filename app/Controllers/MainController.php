<?php

namespace App\Controllers;

class MainController extends BaseController
{
	public function index()
	{
		$view = 'Main/view';
		if (!is_file(APPPATH . '/Views/' . $view . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($view);
		}

		$data['title'] = 'Home'; // Capitalize the first letter

		echo view('templates/header', $data);
		echo view($view);
		echo view('templates/footer');
	}
}
