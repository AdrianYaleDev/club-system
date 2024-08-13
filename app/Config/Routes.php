<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/contact-us', 'Home::contactus');
// $routes->get('/C/([a-z A-Z]+)', 'Club::index/$1');
// $routes->get('/C/([a-z A-Z]+)/([a-z A-Z]+)', 'Club::$2/$1');
// $routes->get('/CA/([a-z A-Z]+)', 'ClubAdmin::index/$1');
// $routes->get('/CA/([a-z A-Z]+)/([a-z A-Z]+)', 'ClubAdmin::$2/$1');


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Get the host name
$hostname = $_SERVER['HTTP_HOST'];

// Check if it's a subdomain of example.com
if (preg_match('/^(.*)\.localhost\.com$/', $hostname, $matches)) {
    
	// If it's a subdomain, extract the subdomain
    $subdomain = $matches[1];
	// Add a route for the ClubAdmin controller
	$routes->add('admin', 'Admin::index/' . $subdomain);
	
	$routes->add('admin/(:any)', 'Admin::$1/' . $subdomain);
	// Add a route for the default method (index)
	$routes->add('/', 'Club::index/' . $subdomain);

	// Add a route for specific methods in the Club controller
	$routes->add('(:any)', 'Club::$1/' . $subdomain);


} else {
    // Otherwise, route to the default Home controller
	$routes->get('/', 'Home::index');
	$routes->get('(:any)', 'Home::$1');

}