<?php

namespace App\Controllers;

use App\Models\UserModel;

class Faculty extends BaseController
{
    public function index()
    {
        if (!(session()->get('type') == 'faculty')) {
            return redirect()->to('/');
        } 
        echo "Hi Faculty!";
    }


}
