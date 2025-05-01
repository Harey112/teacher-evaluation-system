<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\SectionModel;


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

        $sectionModel = new SectionModel();

        $sections = $sectionModel->findAll();

        return view('signup', ['course_list' => $sections]);
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


    public function adminLogin(){

        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url());
        }

        return view('admin-login');
    }

    public function loginAdmin(){

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $adminModel = new AdminModel();
        $admin = $adminModel->first();

        if ($admin && ($username === $admin['username']) && ($password === $admin['password'])) {
            //Session data
            $data = [
                'user_id' => "Admin",
                'type' => 'admin',
                'isLoggedIn' => true 
            ];
            $this->setUserSession($data);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid credentials']);
        }
    }


    public function registerStudent(){
        $userModel = new UserModel();

        $newData = [
            'user_id' => $this->request->getVar('user_id'),
            'password' => $this->request->getVar('password'),
            'firstname' => $this->request->getVar('firstname'),
            'middlename' => $this->request->getVar('middlename'),
            'lastname' => $this->request->getVar('lastname'),
            'extension' => $this->request->getVar('extension'),
            'section' => $this->request->getVar('section'),
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


        // Attempt to save the new user data
        if (!$userModel->save($newData)) {
            // If saving fails, output model validation errors
            return $this->response->setJSON(['status' => 'error', 'message' => $userModel->errors()]);
        } else {
            // If saving is successful, return success response

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

            return redirect()->to(base_url());
        }    

}
