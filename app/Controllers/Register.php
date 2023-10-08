<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User;
use App\Models\Role;

class Register extends Controller
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $model = new Role();
        $roles = $model->findAll();
        $data = [];
        $data['roles'] = $roles;
        echo view('register', $data);
    }

    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'role_id'           => 'required',
            'employee_no'       => 'required|min_length[3]|max_length[20]|is_unique[users.employee_no]',
            'name'              => 'required|min_length[3]|max_length[20]',
            'email'             => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'personal_email'    => 'required|min_length[6]|max_length[50]|valid_email',
            'password'          => 'required|min_length[6]|max_length[200]',
            'address'           => 'required|min_length[6]|max_length[200]',
            'confpassword'      => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new User();
            $data = [
                'role_id'           => $this->request->getVar('role_id'),
                'employee_no'       => $this->request->getVar('employee_no'),
                'name'              => $this->request->getVar('name'),
                'email'             => $this->request->getVar('email'),
                'personal_email'    => $this->request->getVar('personal_email'),
                'password'          => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'address'           => $this->request->getVar('address'),
                'status'            => 1
            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            $model = new Role();
            $roles = $model->findAll();
            $data['validation'] = $this->validator;
            $data['roles'] = $roles;
            echo view('register', $data);
        }
    }
}
