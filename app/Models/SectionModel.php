<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model
{
    protected $table  = 'sections';
    protected $primary_key = 'id';
    protected $allowedFields = ['course', 'year', 'section'];
}
