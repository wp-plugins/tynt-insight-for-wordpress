<?php
/*
Plugin Name: Tynt Insight for WordPress
Plugin URI: http://thisismyurl.com/plugins/tynt-insight-for-wordpress/
Description: Learn what's being copied off your website and how you can leverage this behaviour to get more traffic, more often.
Author: Christopher Ross
Author URI: http://thisismyurl.com
Version: 1.0.1
*/

/**
 * Category Contributors core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/category-contributors/
 *
 * @package 		Category Contributors
 * @copyright		Copyright (c) 2013, Chrsitopher Ross
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Category Contributors 1.0
 */

function thisismyurl_tynt_plugin_css() {
	$setting = json_decode( get_option( 'thisismyurl_tynt' ) );
	if ( $setting[0] )
		echo stripslashes($setting[0]);
		
}
add_action('wp_head','thisismyurl_tynt_plugin_css');


function thisismyurl_tynt_admin_menu() {
	$thisismyurl_tynt_settings = add_options_page( 'Tynt Insight', 'Tynt Insight', 'edit_posts', 'thisismyurl_tynt', 'thisismyurl_tynt_help_page' );
	add_action( 'load-'.$thisismyurl_tynt_settings, 'thisismyurl_tynt_help_page_scripts' );
}
add_action( 'admin_menu', 'thisismyurl_tynt_admin_menu' );

function thisismyurl_tynt_help_page_scripts() {
	wp_enqueue_style( 'dashboard' );
	wp_enqueue_script( 'postbox' );
	wp_enqueue_script( 'dashboard' );
}

function thisismyurl_tynt_admin_css() {
	?><style type="text/css">
		.thisismyurl{ background: no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAA0lBMVEX///9Jj6xrpLxJj6xrpLxhnbdJj6xxqL5moblhnbdJj6xhnbdJj6xxqL5rpLxmoblJj6xxqL5hnbdJj6x1qsBJj6xrpLxmoblJj6xrpLxJj6x4rMFJj6x1qsBJj6xxqL5Jj6x4rMF1qsBxqL5Jj6z////3+vv0+Pru9ffm7/Tf6/Hd6u/V5ezS4+rO4OjG3OW71eC509+z0Nyvztuqy9ikx9aZwNCRu82OucuMtcWCssZ/sMWAsMV4rMF1qsBrpLxmoblhnbdamrRUlrFSlLBJj6wucLoaAAAAJXRSTlMAESIiMzMzRERERFVVZmZmZnd3d4iImZmZqqq7u8zM3d3u7u7u5Bc3VAAAAehJREFUOMttU9li0zAQdAkNEEoJhXIUp4HEK1vxJeLYiQ/FuGL//5dYWb5I2SdLM56dPWRZQ7z9tj5LHevPr63ncbfN9wEDCi84lNvbC/h6m0cwiShfXU/x27PQt2muM+Qpcdl+MxH5UnKAuJRDlMQPyg89/p5w7yj/iaMHvHxn8DdnTgd5EfRTtHnREtYCvBEXQc/wYL/S+LICGPUrlg1ZgJWviPBDgBiVo2D8jkGQxE0DYBJUR/1XbjCtWQKTL62vGYin9jIAP/eNWMZaXgTpJ+sxhgIbfTzoRhsBbngpxCsLOTSIWqOKQurgQVM9YyIHf2MhAFI8nSV1L9oB8KxiaWeTTPQE/FPpIbHIo3Hu+joARgLGZo47PSlRPSfIYdShTyIdwZOdSUR/XAYWc9ab/GnKRMym69J3lsr8bt2fQBAhnOBe87s+m0Zld9ZcAajBYhvSuEYFHGftsJKpRwg7HFNIbT3uxoUa8TQQmg6vwVULvRCPGXCF8S/X4EmfgEPx0G7UzInBL6nPsaa4qsN9EM6VWcolHdonk8js1OE1p+Lm/VovlWjV696eSqgZuBwfxo2TkQQvWn9NQXS3cObTpzWzVcrGSt1UPVxdvM6FjUUSkk03TAq0F/953/N729EpHPvjbLz9C0A/pR4RVDYdAAAAAElFTkSuQmCC);};
	</style><?php
}
add_action( 'admin_head', 'thisismyurl_tynt_admin_css' );

function thisismyurl_tynt_help_page() {
	
	if ( !empty( $_POST['setting1'] ) )
		update_option( 'thisismyurl_tynt', json_encode( $_POST['setting1'] ) );	
	else
		delete_option( 'thisismyurl_tynt' );
	
	if ( empty($setting ) )
		$setting = json_decode( get_option( 'thisismyurl_tynt' ) );
	
	?><div class="wrap">
			<div class="thisismyurl icon32"><br /></div>
			<h2><?php _e('Settings for Tynt Insight for WordPress','thisismyurl_tynt');?></h2>
			<div class="postbox-container" style="width:70%">
				<form method="post" action="options-general.php?page=thisismyurl_tynt">
	 
				<div class="metabox-holder">
				<div class="meta-box-sortables">
					
					<div id="edit-pages" class="postbox">
					<div class="handlediv" title="'.__('Click to toggle','thisismyurl_tynt').'"><br /></div>
					<h3 class="hndle"><span><?php _e('Plugin Settings','thisismyurl_tynt');?></span></h3>
					<div class="inside">
						
						<p><?php _e('Tynt Insight JavaScript','thisismyurl_tynt');?><br/><textarea name="setting1" id="setting1" rows="5" cols="70"><?php echo $setting;?></textarea></p>
						
						<h4><?php _e('Get your Tynt Insight script','thisismyurl_tynt');?></h4>
						
						<p><?php _e('Tynt Insight for WordPress requires JavaScript code from Tynt to work properly. Please log into your Tynt account any copy the JavaScript into the field above. Your JavaScript is located at','thisismyurl_tynt');?> <a href="http://id.tynt.com/script/main">http://id.tynt.com/script/main</a>.</p>
						
					</div><!-- .inside -->
					</div><!-- #edit-pages -->
					<input type="hidden" name="action" value="update" /> 
					<input type="hidden" name="page_options" value="setting1" />
					<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Settings','thisismyurl_tynt');?>" />
					</form>
				</div><!-- .meta-box-sortables -->
				</div><!-- .metabox-holder -->
				
			</div><!-- .postbox-container -->
			
			
	</div><!-- .wrap -->
	
	<?php
}