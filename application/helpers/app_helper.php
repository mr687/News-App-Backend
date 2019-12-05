<?php

defined('BASEPATH') or exit("No script access allowed.");

if(!function_exists('getDateFormat'))
{
	function getDateFormat($timestamp)
	{
		return date('F d, Y', $timestamp);
	}
}

if(!function_exists('getDateFormatFull'))
{
	function getDateFormatFull($timestamp)
	{
		return date('d-m-Y, H:i:s', $timestamp);
	}
}

if(!function_exists('generateUserToken'))
{
	function generateUserToken($data)
	{
		return md5($data['id'].$data['email'].time());
	}
}
