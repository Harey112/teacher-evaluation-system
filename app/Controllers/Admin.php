<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\SectionModel;
use App\Models\InstructorModel;

class Admin extends BaseController
{
    public function index()
    {
        if (!(session()->get('type') == 'admin')) {
            return redirect()->to('/');
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->first();

        $data = [
            'firstname' => $admin['firstname'],
            'middlename' => $admin['middlename'],
            'lastname' => $admin['lastname'],
            'extension' => $admin['extension'],
            'active_menu' => "dashboard",
            'content' => view('admin/dashboard')
        ];
        return view('admin/layout', $data);
    }


    public function courses()
    {
        if (!(session()->get('type') == 'admin')) {
            return redirect()->to('/');
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->first();

        $sectionModel = new SectionModel();

        // Get all unique years
        $courses = $sectionModel->select('course')->distinct()->findAll();

        $course_list = [];
        foreach ($courses as $course) {

            $years = $sectionModel->where('course', $course)->select('year')->distinct()->findAll();

            $year_names = [];
            foreach ($years as $section) {
                $year_names[] = $section['year'];
            }


            $course_list[] = [
                'name' => $course['course'],
                'years' => $year_names
        ];
        }

        $data = [
            'firstname' => $admin['firstname'],
            'middlename' => $admin['middlename'],
            'lastname' => $admin['lastname'],
            'extension' => $admin['extension'],
            'active_menu' => "students",
            'content' => view('admin/program', ['course_list' => $course_list])
        ];

        return view('admin/layout', $data);
    }


    public function yearLevel(){
        if (!(session()->get('type') == 'admin')) {
            return redirect()->to('/');
        }

        $course = $this->request->getGet('course');

        $adminModel = new AdminModel();
        $admin = $adminModel->first();

        $sectionModel = new SectionModel();
        // Get all unique years
        $year_levels = $sectionModel->where('course', $course)->select('year')->distinct()->findAll();

        $level_names = [];

        foreach ($year_levels as $level){

            $sections = $sectionModel->where('course', $course)->select('section')->distinct()->findAll();

            $section_names = [];
            foreach ($sections as $section){
                $section_names[] = $section['section'];
            }

            $levels[] = [
                'name' => $level['year'],
                'sections' => $section_names
            ];
        }

        $data = [
            'firstname' => $admin['firstname'],
            'middlename' => $admin['middlename'],
            'lastname' => $admin['lastname'],
            'extension' => $admin['extension'],
            'active_menu' => "students",
            'content' => view('admin/year-level', ["course" => $course ,"levels" => $levels])
        ];

        return view('admin/layout', $data);
    }


    public function listStudents() {
        if (session()->get('type') !== 'admin') {
            return redirect()->to('/');
        }
    
        $year = $this->request->getGet('year');
        $course = $this->request->getGet('course');
        $section = $this->request->getGet('section');
    
        $adminModel = new AdminModel();
        $admin = $adminModel->first();
    
        $sectionModel = new SectionModel();
    
        // Get all sections for dropdown
        $sections = $sectionModel->where('course', $course)->where('year', $year)->findAll();
    
        // Filtered sections (for fetching students)
        if (!empty($section)) {
            $filtered_sections = $sectionModel
                ->where('course', $course)
                ->where('year', $year)
                ->where('section', $section)
                ->findAll();
        } else {
            $filtered_sections = $sections; // use previously fetched list
        }
    
        $sectionIds = array_column($filtered_sections, 'id');
    
        $userModel = new UserModel();
        $students = [];
    
        if (!empty($sectionIds)) {
            $students = $userModel->whereIn('section', $sectionIds)->findAll();
        }
    
        $data = [
            'firstname' => $admin['firstname'],
            'middlename' => $admin['middlename'],
            'lastname' => $admin['lastname'],
            'extension' => $admin['extension'],
            'active_menu' => "students",
            'content' => view('admin/student-list', [
                'year_level' => $year,
                'students' => $students,
                'course' => $course,
                'sections' => $sections,
                'current_section' => $section
            ])
        ];
    
        return view('admin/layout', $data);
    }


    public function instructors()
    {
        if (!(session()->get('type') == 'admin')) {
            return redirect()->to('/');
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->first();

        $instructorModel = new InstructorModel();
        $instructors = $instructorModel->findAll();

        $data = [
            'firstname' => $admin['firstname'],
            'middlename' => $admin['middlename'],
            'lastname' => $admin['lastname'],
            'extension' => $admin['extension'],
            'active_menu' => "instructors",
            'content' => view('admin/instructors', ['instructor_list' => $instructors])
        ];

        return view('admin/layout', $data);
    }
    

    public function addSection(){
        $course = $this->request->getVar('course');
        $year = $this->request->getVar('year');
        $section = $this->request->getVar('section');

        // Validate input
        if (empty($course) || empty($year) || empty($section)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'All fields are required.'
            ]);
        }

        $sectionModel = new SectionModel();

        // Check if the section already exists
        $existing = $sectionModel->where([
            'course' => $course,
            'year' => $year,
            'section' => $section
        ])->first();

        if ($existing) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Section already exists.'
            ]);
        }

        // Insert new section
        $data = [
            'course' => $course,
            'year' => $year,
            'section' => $section
        ];

        if ($sectionModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Section added successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to add section. Please try again.'
            ]);
        }
    }


    public function addInstructor(){
        $firstname = $this->request->getVar('firstname');
        $middlename = $this->request->getVar('middlename');
        $lastname = $this->request->getVar('lastname');
        $extension = $this->request->getVar('extension');

        // Validate input
        if (empty($firstname) || empty($lastname)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Fill all required fields.'
            ]);
        }

        $instructorModel = new InstructorModel();

        // Check if the section already exists
        $existing = $instructorModel->where([
            'firstname' => $firstname,
            'lastname' => $lastname,
        ])->first();

        if ($existing) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Section already exists.'
            ]);
        }

        // Insert new section
        $data = [
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'extension' => $extension
        ];

        if ($instructorModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Section added successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to add section. Please try again.'
            ]);
        }
    }

}
