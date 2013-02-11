<?php

/**
 * FILE: shortcode.php 
 * Created on Feb 8, 2013 at 4:28:49 PM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider 5
 * License: GPLv2
 */


if (!function_exists('vslider_shortcode')) {
	function vslider_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'name'   => ''
	), $atts));
           $vs = get_option($name);
           
           if(empty($vs)){
               return 'vSlider not Found!';
           }else{
               $vslider =new vSlider;
               $vslider->initialize($vs);
               $id= 'vslider'.rand(1,999);
               global $vslider_script;
               $vslider_script .=$vslider->vslider_script($id);
	   return $vslider->vslider($id);
           }
           
	}
	add_shortcode('vslider', 'vslider_shortcode');
}

// For compatibility's sake....
if (!function_exists('vslider')) {
	function vslider( $name ) {
           $vs = get_option($name);
            if(empty($vs)){
               return 'vSlider not Found!';
           }else{
           $vslider =new vSlider;
           $vslider->initialize($vs);
           $id= 'vslider'.rand(1,999);
           global $vslider_script;
           $vslider_script .=$vslider->vslider_script($id);
	   echo $vslider->vslider($id);
           }
	}
}


?>
