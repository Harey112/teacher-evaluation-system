<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->get('/signup', 'Auth::signup');

$routes->post('/auth/login', 'Auth::loginStudent');
$routes->post('/auth/register', 'Auth::registerStudent');
$routes->get('/auth/logout', 'Auth::logout');


$routes->get('/student/dashboard', 'Student::index');

$routes->get('/faculty/dashboard', 'Faculty::index');


//$routes->get(':any', 'Home::index');