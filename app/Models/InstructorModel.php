<?php


namespace App\Models;

use CodeIgniter\Model;

class InstructorModel extends Model
{
    protected $table  = 'instructors';
    protected $primary_key = 'id';
    protected $allowedFields = ['firstname', 'middlename', 'lastname', 'extension'];
}
