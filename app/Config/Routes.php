<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/student/login', 'Auth::login');
$routes->get('/student/signup', 'Auth::signup');

$routes->post('/auth/login', 'Auth::loginStudent');
$routes->post('/auth/admin-login', 'Auth::loginAdmin');
$routes->post('/auth/register', 'Auth::registerStudent');
$routes->get('/auth/logout', 'Auth::logout');


$routes->get('/student/dashboard', 'Student::index');

$routes->get('/admin/login', 'Auth::adminLogin');
$routes->get('/admin/dashboard', 'Admin::index');
$routes->get('/admin/courses', 'Admin::courses');
$routes->get('/admin/courses/year-level', 'Admin::yearLevel');
$routes->get('/admin/courses/year-level/students', 'Admin::listStudents');
$routes->get('/admin/instructors', 'Admin::instructors');

$routes->post('/admin/add-section', 'Admin::addSection');
$routes->post('/admin/add-instructor', 'Admin::addInstructor');
//$routes->get(':any', 'Home::index');