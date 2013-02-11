<?php

/**
 * FILE: config.php 
 * Created on Feb 1, 2013 at 1:49:11 PM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider 5.0
 * License: GPLv2
 */

$vslider_script='';

if (!defined('VSLIDER_URL')) {
	define('VSLIDER_URL', plugins_url().'/vslider');
}

function vslider_admin_url($url) {
	if (is_multisite()) {
		if  (is_super_admin())
			return network_admin_url($url);
	} else {
		return admin_url($url);
	}
}

$global_settings=array(
         'namespace' => '"vslider-"',  
         'selector' => '".slides > li"',
         'animation'=> '"fade"',          //settings
         'easing'   => '"swing"',
         'direction'   => '"horizontal"',  //settings
         'reverse'   => 'false', // Javascript can recognize 
         'smoothHeight'   => 'true',   
         'animationLoop' => 'true',  //settings
         'startAt' => '0',
         'slideshow' => 'true',        //settings
         'slideshowSpeed' => '7000',   //settings
         'animationSpeed' => '600',    
         'initDelay' => '0',
         'randomize' => 'false',     //settings
           
         // Usability features  
         'pauseOnAction' => 'true',
         'pauseOnHover' => 'false',
         'useCSS' => 'true',
         'touch' => 'true',
         'video' => 'true',
         
         // Primary Controls  
         'controlNav' => 'true',      //settings
         'directionNav' => 'true',    //settings
         'prevText' => '"Previous"',
         'nextText' => '"Next"', 
           
         //Secondary Navigation  
         'keyboard' => 'true',
         'multipleKeyboard' => 'false',
         'mousewheel' => 'false',
         'pausePlay' => 'false',
         'pauseText' => '"Pause"',
         'playText' => '"Play"',
         
          //Special Properties
          'controlsContainer' => '""',
          'manualControls' => '""',
          'sync' => '""',
          'asNavFor' => '""',
           
          //Carousel Options 
          'itemWidth' => '0',  
          'itemMargin' => '0',   
          'minItems' => '0',   
          'maxItems' => '0',  
          'move' => '0'
           
       );
?>
