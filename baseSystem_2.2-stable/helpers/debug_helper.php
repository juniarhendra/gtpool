<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* ======================================== 
    Document      : debug_helper.php
    Created on    : July 17, 2011
    Author        : Galih U. Syambudhi [galihsam@gmail.com][www.galihsamedia.com]
    Description   : for Debugging Function PHP.
=========================================== */


if ( ! function_exists('gSamViewArr'))
{
	function gSamViewArr($param)
	{
		echo"<pre>";
		print_r($param);
		echo"</pre>";
		exit;

		return $param;
	}
}

if ( ! function_exists('gSamViewEcho'))
{
	function gSamViewEcho($param)
	{
		echo"<pre>";
		echo($param);
		echo"</pre>";
		exit;

		return $param;
	}
}

/* End of file path_helper.php */
/* Location: ./system/helpers/path_helper.php */