<?php //-->
if($_SERVER['REQUEST_URI'] == '/assets' 
	|| strpos($_SERVER['REQUEST_URI'], '/assets/') === 0
	|| strpos($_SERVER['REQUEST_URI'], '/assets?') === 0) {
	require('assets.php');
} elseif($_SERVER['HTTP_HOST'] == 'control.jldmp.ph') {
	require('back.php');
} else { 
	require('front.php'); 
}