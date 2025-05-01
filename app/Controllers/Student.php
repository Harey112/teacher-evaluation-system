<?php

namespace App\Controllers;

use App\Models\UserModel;

class Student extends BaseController
{
    public function index()
    {
        if (!(session()->get('type') == 'student')) {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $user = $userModel->where('user_id', base64_decode(session()->get('id')))->first();

        $data = [
            'firstname' => $user['firstname'],
            'middlename' => $user['middlename'],
            'lastname' => $user['lastname'],
            'id' => $user['user_id'],
            'extension' => $user['extension'],
            'active_menu' => "dashboard",
            'content' => view('student/dashboard')
        ];
        return view('student/layout', $data);
    }


}
