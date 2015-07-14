<?php
/*
Plugin Name: Daily Archive
Plugin URI: http://gongjam.co.kr
Description: your archive change to daily format.
Version: 1.0
Author: gongjam
Author URI: http://gongjam.co.kr
License: GPL2
*/

/*  Copyright YEAR  Daily Archive  (email : guruahn@gmail.com)

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


require_once(plugin_dir_path( __FILE__ )."functions-daily.php");
require_once(plugin_dir_path( __FILE__ )."page-templater-class.php");
/*init*/
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );
add_action( 'plugins_loaded', 'daily_init' );
add_action( 'wp_loaded', 'daily_add_page' );
//add_filter( 'single_template', 'daily_page_template', 99 );


add_action('pre_get_posts', 'daily_custom_archive_page');