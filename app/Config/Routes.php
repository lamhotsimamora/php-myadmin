<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/get-database', 'Home::getDatabase');
$routes->post('/get-table-name', 'Home::getTableName');
$routes->post('/get-column-name', 'Home::getColumnName');
$routes->post('/get-data', 'Home::getData');

$routes->get('/database/(:any)', 'Home::getTableByDatabase/$1');