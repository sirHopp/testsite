	
<?php

session_start();

	define( 'APPROOT', dirname(__FILE__) . '/' );

	$database = mysql_connect("localhost","root","","testsite_data");

	// include master page controller
	require_once( APPROOT . 'app/controllers/pageController.php' );
	$pageObj;
	
	// if page is not specified direct to landing page                   + need to add if logged in redirect to feedPage
	$requestedPage = isset( $_GET['p'] ) ? $_GET['p'] : 'landing';
	switch( strtolower( $requestedPage ) ) {

		case 'landing':
			$pageObj = new page( 'landingPage', 'Welcome to testsite, login to get started.' );
			break;

		case 'feed':
			$pageObj = new page( 'feedPage', 'index feed of projects' );
			break;

		case 'project':
			$pageObj = new page( 'projectPage', 'information on a specific project' );
			break;

		case 'login':
			require 'app/controllers/loginController.php';
			$controller = new loginController($database);
			break;

		case 'registry':
			require 'app/controllers/registryController.php';
			$controller = new registryController($database);
			break;			

		default:
			$pageObj = new page( 'pageNotFound', 'Page Not Found' );
			break;
	}

	// Output the page
	$pageObj->output( );
	
?>