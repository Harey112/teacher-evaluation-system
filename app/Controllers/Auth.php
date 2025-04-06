<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index(){

        $userModel = new UserModel();
        $users = $userModel->findAll(); // Retrieve all users

        return($users);
    }

    public function login(){

        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url());
        }

        return view('login');
    }

    public function signup(){

        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url());
        }    
        return view('signup');
    }


    public function loginStudent(){

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid credentials']);
        }
    }


    public function registerStudent(){
        $userModel = new UserModel();

        $newData = [
            'user_id' => $this->request->getVar('user_id'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'firstname' => $this->request->getVar('firstname'),
            'middlename' => $this->request->getVar('middlename'),
            'lastname' => $this->request->getVar('lastname'),
            'extension' => $this->request->getVar('extension'),
            'type' => 'student'
        ];


        if ($this->request->getVar('password') != $this->request->getVar('c_password')){
            return $this->response->setJSON(['status' => 'error', 'message' => 'Password didn\'t matched.']);
        }

        // Check if user_id already exists
        $existingUserById = $userModel->where('user_id', $newData['user_id'])->first();
        if ($existingUserById) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User ID already exists.']);
        }

        // Check if email already exists
        $existingUserByEmail = $userModel->where('email', $newData['email'])->first();
        if ($existingUserByEmail) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Email already exists.']);
        }

        // Attempt to save the new user data
        if (!$userModel->save($newData)) {
            // If saving fails, output model validation errors
            return $this->response->setJSON(['status' => 'error', 'message' => $userModel->errors()]);
        } else {
            // If saving is successful, return success response

            //Session data
            $data = [
                'id' => base64_encode($this->request->getVar('user_id')),
                'type' => 'student',
                'isLoggedIn' => true 
            ];
            $this->setUserSession($newData);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Registration successful.']);
        }
    }


    protected function setUserSession($user)
        {
            // Encrypt the user_id with base64 encoding
            $encodedId = base64_encode($user['user_id']);


            $data = [
                'id' => $encodedId, 
                'type' => $user['type'],
                'isLoggedIn' => true,
            ];

            // Set the session
            session()->set($data);
        }

    public function logout()
        {   
            session()->remove('type');
            session()->remove('id');
            session()->remove('isLoggedIn');
            session()->destroy();

            return redirect()->to(base_url('login'));
        }    

}
