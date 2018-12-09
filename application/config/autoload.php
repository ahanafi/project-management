<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('session', 'database', 'customlib', 'form_validation', 'upload');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array(
		'Auth_model' 	=> 'Auth',
		'Customer_model'=> 'Customer',
		'Rack_model' 	=> 'Rack',
		'Project_model' => 'Project',
		'Design_model' 	=> 'Design',
		'Material_model'=> 'Material',
		'Notif_model' 	=> 'Notif',
		'Schedule_model'=> 'Schedule'
	);

date_default_timezone_set('Asia/Jakarta');

function id_date($date)
{
	$d = substr($date, 8,2);
	$m = substr($date, 5,2);
	$y = substr($date, 0,4);

	$date_now = $d."/".$m."/".$y;

	return $date_now;
}
