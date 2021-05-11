<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;

class FormController extends BaseController
{

    public function index()
    {
        $view = "Form/index";
        if (!is_file(APPPATH . '/Views/' . $view . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($view);
        }

        helper(['form', 'url']);

        $rolesModel = new \App\Models\RolesModel();

        $data['roles'] = $rolesModel->findAll();;
        $data['title'] = "Form";

        echo view('templates/header', $data);
        echo view($view);
        echo view('templates/footer');
    }

    public function validateIndex()
    {
        helper(['form', 'url']);

        $userModel = new \App\Models\UserModel();
        $rolesModel = new \App\Models\RolesModel();

        $data['roles'] = $rolesModel->findAll();;
        $data['title'] = 'Form';
        
        $input = $this->validate([
            'username' => 'required|min_length[5]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[7]',
            'age' => 'required|numeric|max_length[3]',
            'role' => 'required'
        ]);

        if (!$input) {
            echo view('templates/header', $data);
            echo view('Form/index', [
                'validation' => $this->validator
            ]);
            echo view('templates/footer');
        } else {
            $userModel->save([
                'username' => $this->request->getVar('username'),
                'email'  => $this->request->getVar('email'), // for future, IDE doesn't recognise getVar so declare protected $request in BaseController (23-28)
                'password'  => $this->request->getVar('password'),
                'age' => $this->request->getVar('age'),
                'role' => $this->request->getVar('role')
            ]);

            $_SESSION['success'] = 'User has been saved successfully';
            $session = session();
            $session->markAsFlashdata('success');

            return redirect()->to('/form');
        }
    }
}
