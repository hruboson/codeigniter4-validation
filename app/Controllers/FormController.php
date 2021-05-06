<?php

namespace App\Controllers;

use App\Models\FormModel;

class FormController extends BaseController
{
    public function index()
    {
        $view = "FormController/index";
        if (!is_file(APPPATH . '/Views/' . $view . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($view);
        }

        $data['title'] = "Form";

        echo view('templates/header', $data);
        echo view($view);
        echo view('templates/footer');
    }

    public function validateIndex()
    {
        helper(['form', 'url']);

        $input = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|numeric|max_length[10]',
            'role' => 'required'
        ]);

        $model = new FormModel();

        if (!$input) {
            echo view('Form/index', [
                'validation' => $this->validator
            ]);
        } else {
            $model->save([
                'name' => $this->request->getMethod('name'),
                'email'  => $this->request->getVar('email'),
                'password'  => $this->request->getVar('password'),
                'role' => $this->request->getVar('role')
            ]);

            return $this->response->redirect(base_url('/form'));
        }
    }
}
