<?php
/*
Plugin Name: Tynt Insight for WordPress
Plugin URI: http://thisismyurl.com/downloads/wordpress/plugins/tynt-insight-for-wordpress/
Description: Learn what's being copied off your website and how you can leverage this behaviour to get more traffic, more often.
Author: Christopher Ross
Author URI: http://thisismyurl.com
Version: 1.0.0
*/

/*  Copyright 2011 Christopher Ross  (email : info@thisismyurl.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function thisismyurl_tynt_plugin_css() {
	$setting = json_decode(get_option('thisismyurl_tynt'));
	if ($setting[0]) {
		echo stripslashes($setting[0]);
	}
}
add_action('wp_head','thisismyurl_tynt_plugin_css');


function thisismyurl_tynt_admin_menu() {
	$thisismyurl_tynt_settings = add_options_page( 'Tynt Insight', 'Tynt Insight', 'edit_posts', 'thisismyurl_tynt', 'thisismyurl_tynt_help_page');
	add_action('load-'.$thisismyurl_tynt_settings, 'thisismyurl_tynt_help_page_scripts');
}
add_action('admin_menu', 'thisismyurl_tynt_admin_menu');

function thisismyurl_tynt_help_page_scripts() {
	wp_enqueue_style('dashboard');
	wp_enqueue_script('postbox');
	wp_enqueue_script('dashboard');
}

function thisismyurl_tynt_admin_css() {
	$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	echo '<style type="text/css">
			.thisismyurl{ background: url("'.$x.'icon.png") no-repeat;};
		</style>';
}
add_action('admin_head','thisismyurl_tynt_admin_css');

function thisismyurl_tynt_help_page() {
	
	if ($_POST) {
		$setting = array($_POST['setting1']);
		
		update_option('thisismyurl_tynt', json_encode($setting));	
	}
	
	if (empty($setting)) {
		$setting = json_decode(get_option('thisismyurl_tynt'));
	}
	
	echo '<div class="wrap">
			<div class="thisismyurl icon32"><br /></div>
			<h2>'.__('Settings for Tynt Insight for WordPress','thisismyurl_tynt').'</h2>
			<div class="postbox-container" style="width:70%">
				<form method="post" action="options-general.php?page=thisismyurl_tynt">
	 
				<div class="metabox-holder">
				<div class="meta-box-sortables">
					
					<div id="edit-pages" class="postbox">
					<div class="handlediv" title="'.__('Click to toggle','thisismyurl_tynt').'"><br /></div>
					<h3 class="hndle"><span>'.__('Plugin Settings','thisismyurl_tynt').'</span></h3>
					<div class="inside">
						
						<p>'.__('Tynt Insight JavaScript','thisismyurl_tynt').'<br/><textarea name="setting1" id="setting1" rows="5" cols="70">'.$setting[0].'</textarea></p>
						
						<h4>'.__('Get your Tynt Insight script','thisismyurl_tynt').'</h4>
						
						<p>'.__('Tynt Insight for WordPress requires JavaScript code from Tynt to work properly. Please log into your Tynt account any copy the JavaScript into the field above. Your JavaScript is located at','thisismyurl_tynt').' <a href="http://id.tynt.com/script/main">http://id.tynt.com/script/main</a>.</p>
						
					</div><!-- .inside -->
					</div><!-- #edit-pages -->
					<input type="hidden" name="action" value="update" /> 
					<input type="hidden" name="page_options" value="setting1" />
					<input type="submit" name="Submit" class="button-primary" value="'.__('Save Settings','thisismyurl_tynt').'" />
					</form>
				</div><!-- .meta-box-sortables -->
				</div><!-- .metabox-holder -->
				
			</div><!-- .postbox-container -->
			
			<div class="postbox-container" style="width:20%">
			
				<div class="metabox-holder">
				<div class="meta-box-sortables">
				
					<div id="edit-pages" class="postbox">
					<div class="handlediv" title="'.__('Click to toggle','thisismyurl_tynt').'"><br /></div>
					<h3 class="hndle"><span>'.__('Plugin Information','thisismyurl_tynt').'</span></h3>
					<div class="inside">
						<p>'.__('Tynt Insight for WordPress by Christopher Ross is a free WordPress plugin. If you\'ve enjoyed the plugin please give the plugin 5 stars on WordPress.org.','thisismyurl_tynt').'</p>
						<p>'.__('Want to help? Please consider translating this pluginto your local language, or offering a hand in the support forums.','thisismyurl_tynt').'</p>
						<p><a href="http://wordpress.org/extend/plugins/tynt-insight-for-wordpress/">WordPress.org</a> | <a href="http://thisismyurl.com">'.__('Plugin Author','thisismyurl_tynt').'</a></p>
					</div><!-- .inside -->
					</div><!-- #edit-pages -->
				
				</div><!-- .meta-box-sortables -->
				</div><!-- .metabox-holder -->
				
			</div><!-- .postbox-container -->	
	</div><!-- .wrap -->
	
	';
}

?>