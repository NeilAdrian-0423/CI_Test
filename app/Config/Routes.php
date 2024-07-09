<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register_action', 'Auth::register_action');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login_action', 'Auth::login_action');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/profile', 'Dashboard::profile');
$routes->post('dashboard/update_profile', 'Dashboard::update_profile');
$routes->get('dashboard/search', 'Dashboard::search');
$routes->post('dashboard/search_action', 'Dashboard::search_action');
$routes->get('search', 'Dashboard::search_action');

