<?php 
/* 
Plugin Name: Simple Lightbox
Plugin URI: http://archetyped.com/tools/simple-lightbox/
Description: The highly customizable lightbox for WordPress
Version: dev (BETA)
Author: Archetyped
Author URI: http://archetyped.com
Support URI: https://github.com/archetyped/simple-lightbox/wiki/Reporting-Issues
*/
/*
Copyright 2013 Sol Marchessault (sol@archetyped.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 * Class loading handler
 * @param string $classname Class to load
 */
function slb_autoload($classname) {
	$prefix = 'slb_';
	$cls = strtolower($classname);
	//Remove prefix
	if ( 0 !== strpos($cls, $prefix) ) {
		return false;
	}
	//Format class for filename
	$fn = 'class.' . substr($cls, strlen($prefix)) . '.php';
	//Build path
	$path = dirname(__FILE__) . '/' . "includes/" . $fn;
	//Load file
	if ( is_readable($path) ) {
		require $path;
	}
}

spl_autoload_register('slb_autoload');
$slb = null;
function slb_init() {
	global $slb;
	require_once 'controller.php';
	$slb = new SLB_Lightbox();
}

add_action('init', 'slb_init', 0);