<?php

namespace App\Controllers;

use App\Models\User_model;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $userModel;
    protected $form_validation;

    public function __construct()
    {
        $this->userModel = new User_model();
        helper(['form', 'url']);
        $this->form_validation = \Config\Services::validation();
    }

    public function register()
    {
        return view('register');
    }

    public function register_action()
    {
        // Set validation rules
        $this->form_validation->setRule('name', 'Name', 'required');
        $this->form_validation->setRule('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->setRule('password', 'Password', 'required');
        $this->form_validation->setRule('picture', 'Picture', 'uploaded[picture]|max_size[picture,1024]|is_image[picture]');

        // Run validation
        if (!$this->form_validation->withRequest($this->request)->run()) {
            return view('register', [
                'validation' => $this->form_validation,
            ]);
        }

        // Handle profile picture upload
        $file = $this->request->getFile('picture');
        $fileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $fileName);

        // Save user data with profile picture filename
        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture' => $fileName,
        ]);

        // Redirect to login page after successful registration
        return redirect()->to('/auth/login');
    }


    public function login()
    {
        return view('login');
    }

    public function login_action()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'logged_in' => true,
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/auth/login')->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
