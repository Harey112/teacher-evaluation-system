<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            switch (session()->get('type')) {
                case 'student':
                    return redirect()->to(base_url('/student/dashboard'));
                    break;
                case 'admin':
                    return redirect()->to(base_url('/admin/dashboard'));
                    break;
                default:
                    session()->destroy();
                    return redirect()->to(base_url('/student/login'));
            }
        } else {
            return redirect()->to(base_url('/student/login'));
        }
    }


}
