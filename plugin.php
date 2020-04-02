<?php
/**
 * Plugin Name: QuadMenu PRO Login Item Extension
 * Description: Overwrites functionality of QuadMenu and QuadMenu PRO's Login Menu Item
 * Plugin URI: https://github.com/martinsluters
 * Author: Martins Luters
 * Author URI: https://github.com/martinsluters
 * Version: 0.1
 * License: GPL2
 */

/*
	Copyright (C) 2020  Martins Luters https://github.com/martinsluters

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require dirname( __FILE__ ) . '/vendor/autoload.php';

	add_action(
		'plugins_loaded',
		function() {
			new ML_QuadMenu_Pro_Extension();
		}
	);
}
