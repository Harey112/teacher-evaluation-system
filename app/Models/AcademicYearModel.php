<?php


namespace App\Models;

use CodeIgniter\Model;

class AcademicYearModel extends Model
{
    protected $table  = 'academic-year';
    protected $primary_key = 'id';
    protected $allowedFields = ['from_year', 'to_year', 'timestamp'];
}
