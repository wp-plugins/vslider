<?php

/**
 * FILE: init.php 
 * Created on Feb 11, 2013 at 11:47:16 AM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider 
 * License: GPLv2
 */


        
// Runs when plugin is activated and creates new database field
register_activation_hook(__FILE__,'vslider5_plugin_install');
function vslider5_plugin_install() {
    add_option('vslider_support', 0);
    global $wpdb;
	$table_name = $wpdb->prefix . "vslider"; 
    
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  option_name VARCHAR(255) NOT NULL DEFAULT  'vslider_options',
		  active tinyint(1) NOT NULL DEFAULT  '0',
		  PRIMARY KEY (`id`),
          UNIQUE (
                    `option_name`
            )
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

}

// Runs on plugin deactivation and deletes the database field
register_deactivation_hook( __FILE__, 'vslider5_plugin_remove' );
function vslider5_plugin_remove() {
    global $wpdb;
	$table_name = $wpdb->prefix . "vslider"; 
    $vslider_data = $wpdb->get_results("SELECT option_name FROM $table_name ORDER BY id");
    foreach ($vslider_data as $data) {
        delete_option($data->option_name);
        }
    $sql = "DROP TABLE " . $table_name;
		$wpdb->query( $sql );
}

?>
