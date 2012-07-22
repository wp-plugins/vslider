<?php
/*
    Plugin Name: vSlider
    Plugin URI: http://www.Vibethemes.com/vslider-wordpress-image-slider-plugin/
    Description: Implementing a featured image gallery into your WordPress theme has never been easier! Showcase your portfolio, animate your header or manage your banners with vSlider.Create unlimited image sliders, the best wordpress image slider plugin vSlider by  <a href="http://www.vibethemes.com/" title="premium wordpress themes">VibeThemes</a>.
    Author: Mr.Vibe
    Version: 4.2
    Author URI: http://www.Vibethemes.com/

	vSlider is released under GPL:
	http://www.opensource.org/licenses/gpl-license.php
*/
require_once(ABSPATH .'wp-includes/pluggable.php');
// Hook for adding admin menus
include ('vs_config.php');
include ('class/setting.php');
include ('class/theme.php');
include ('class/vslider.php');
include ('vs_include.php');
include ('vs_help.php');
include ('build/manage.php');
include ('build/admin.php');

register_activation_hook(__FILE__,'vslider_plugin_install');
register_deactivation_hook(__FILE__,'vslider_plugin_uninstall');
add_action('wp_enqueue_scripts', 'vs_init_scripts');
add_action('wp_enqueue_scripts', 'vs_init_styles');

add_action('admin_print_scripts', 'admin_init_script');
add_action('admin_print_styles', 'admin_init_style');
    
add_action('admin_menu', 'vslider_admin_menu');
function vslider_admin_menu() {
    add_menu_page('Add vSlider ', 'vSlider', VSLIDER_ACCESS, 'vslider', 'manage_vsliders', WP_PLUGIN_URL.'/vslider/images/icon.png');
    }

    function vslider($vslider_name)
    {   
        $vslider=new vslider();
        $theme= new vslider_themes();
        $setting= new vslider_settings();
        $vs=get_option($vslider_name);
        if(is_string($vs)){
        $vslider=unserialize($vs);
        }else $vslider=$vs;
        
        $set=get_option($vslider->settings);
        $th=get_option($vslider->themes);
        
        
        if(is_string($set)){
        $setting=unserialize($set);
        }else $setting=$set;
        
        if(is_string($th)){
        $theme=unserialize($th);
        }else $theme=$th;
        
        $theme->generate_theme($vslider->name);        
        $vslider->generate_vslider();
        $setting->generate_setting($vslider->name);
  }        
?>