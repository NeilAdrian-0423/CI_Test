<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User_model;

class Dashboard extends BaseController
{
    protected $userModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load necessary helpers
        helper(['url', 'form']);

        // Load UserModel
        $this->userModel = new User_model();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('auth/login');
        }

        // Retrieve user data using UserModel
        $user_id = session()->get('user_id');
        $user = $this->userModel->find($user_id);

        if (!$user) {
            // Handle case where user is not found
            return redirect()->to('auth/login');
        }

        $data['user'] = $user;

        // Load view with data
        return view('dashboard/index', $data);
    }

    public function profile()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('auth/login');
        }

        // Retrieve user data using UserModel
        $user_id = session()->get('user_id');
        $user = $this->userModel->find($user_id);

        if (!$user) {
            // Handle case where user is not found
            return redirect()->to('auth/login');
        }

        $data['user'] = $user;

        // Load profile view with data
        return view('profile', $data);
    }

    public function update_profile()
    {
        // Load necessary helpers
        helper(['form']);

        // Retrieve user data
        $user_id = session()->get('user_id');
        $user = $this->userModel->find($user_id);

        if (!$user) {
            return redirect()->to('auth/login');
        }

        // Validation rules
        $rules = [
            'name'     => 'required',
            'email'    => 'required|valid_email',
        ];

        // Only add password rule if it's provided
        if (!empty($this->request->getPost('password'))) {
            $rules['password'] = 'min_length[6]';
        }

        // Check if there's a file upload
        if ($this->request->getFile('profile_picture')->isValid()) {
            $rules['profile_picture'] = 'uploaded[profile_picture]|max_size[profile_picture,1024]|mime_in[profile_picture,image/jpg,image/jpeg,image/png]';
        }

        // Validate the input
        if (!$this->validate($rules)) {
            // If validation fails, return to the form with errors
            $data['validation'] = $this->validator;
            $data['user'] = $user; // Directly use the user array as it is

            return view('profile', $data);
        }

        // Process form submission
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // Update password only if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Handle profile picture upload
        $profilePicture = $this->request->getFile('profile_picture');
        if ($profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $newName = $profilePicture->getRandomName();
            $profilePicture->move(ROOTPATH . 'public/uploads', $newName);

            // Delete old profile picture if exists
            if (!empty($user['picture']) && file_exists(ROOTPATH . 'public/uploads' . $user['picture'])) {
                unlink(ROOTPATH . 'public/uploads' . $user['picture']);
            }

            // Update user data with new profile picture path
            $userData['picture'] = $newName;
        }

        // Update user data
        $this->userModel->update($user_id, $userData);

        // Set a success message
        session()->setFlashdata('success', 'Profile updated successfully.');

        // Reload the profile page with updated data
        return redirect()->to('dashboard/profile');
    }





    public function search()
    {
        // Check if the user is logged in
        if (session()->has('user_id')) {
            $user = $this->userModel->find(session('user_id'));

            $data = [
                    'user' => $user,
                ];
            return view('search', $data);
        } else {
            return redirect()->to('auth/login');
        }
    }

    public function search_action()
    {
            // Retrieve query from POST data
            $query = $this->request->getPost('query');

            // Perform API request to Pixabay
            $apiKey = '44834530-c32d86415f1b98aa356b9da65';
            $url = 'https://pixabay.com/api/?key=' . $apiKey . '&q=' . urlencode($query);
            $response = file_get_contents($url);
            $results = json_decode($response, true)['hits'];

            // Prepare JSON response
            $data['results'] = $results;
            return $this->response->setJSON($data);
    }

    private function upload_file($field)
    {
        $file = $this->request->getFile($field);
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('./uploads/', $fileName);
            return $fileName;
        } else {
            return false;
        }
    }
}
