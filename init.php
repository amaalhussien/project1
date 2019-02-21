<?php
     include_once 'admin/connect_db.php';
	// Routes

	$tpl 	= 'inc/template/'; // Template Directory
	$lang 	= 'inc/languages/'; // Language Directory
	$sess	= 'inc/session/'; // Functions Directory
	$func	= 'inc/function/'; // Functions Directory
	$css 	= 'layoutp/css/'; // Css Directory
	$js 	= 'layoutp/js/'; // Js Directory


include $lang .'english.php';
// Include The Important Files
include $sess .'session.php';
include $func .'function.php';


//include $lang .'arabic.php';

//include $lang .'arabic.php';
include $tpl  .'header.php';


// Include Navbar On All Pages Expect The One With $noNavbar Vairable

if (!isset($noNavbar)) { include $tpl . 'navbar.php'; }





?>