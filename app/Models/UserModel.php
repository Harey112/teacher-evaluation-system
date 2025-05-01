<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $allowedFields = ['user_id', 'password', 'firstname', 'middlename', 'lastname', 'extension', 'type', 'section'];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate= ['beforeUpdate'];



    protected function beforeInsert(array $data){
        if (isset($data['data']['password']))
            $data['data']['password'] = $this->hashPassword($data['data']['password']);

        return $data;
    }

    protected function beforeUpdate(array $data){
        if (isset($data['data']['password']))
            $data['data']['password'] = $this->hashPassword($data['data']['password']);

        return $data;
    }


    protected function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
