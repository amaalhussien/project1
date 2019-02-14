<?php
     include_once 'connect_db.php';
	// Routes

	$tpl 	= 'inc/templates/'; // Template Directory
	$lang 	= 'inc/languages/'; // Language Directory
	$sess	= 'inc/session/'; // Functions Directory
	$func	= 'inc/function/'; // Functions Directory
	$css 	= 'layout/css/'; // Css Directory
	$js 	= 'layout/js/'; // Js Directory


include $lang .'english.php';
// Include The Important Files
include $sess .'session.php';
include $func .'function.php';


//include $lang .'arabic.php';
include $tpl  .'header.php';


// Include Navbar On All Pages Expect The One With $noNavbar Vairable

if (!isset($noNavbar)) { include $tpl . 'navbar.php'; }



?>