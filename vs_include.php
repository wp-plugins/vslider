<?php

/* Credits:
 * Author: Mr.Vibe
 * Website: www.VibeThemes.com
 */


 function vslider_plugin_install() {
                
                $version=get_option('vslider_db');
                /*if($version)
                { //Check for older versions. Not Required for 4.2
                    
                }else {  
                  */  
                $vslider=new vslider();
                $default=serialize($vslider);
                update_option($vslider->name, $default);
                $vslider_setting=new vslider_settings();
                $default_setting=serialize($vslider_setting);
                add_option($vslider_setting->name, $default_setting);
                $all_settings=array($vslider_setting->name);
                add_option('vslider_settings',serialize($all_settings));
                
                $vslider_theme=new vslider_themes();
                $default_theme=serialize($vslider_theme);
                add_option($vslider_theme->name, $default_theme);
                $all_themes=array($vslider_theme->name);
                add_option('vslider_themes',serialize($all_themes));
                
                $vslider_default=array('name'=>$vslider->name,'setting'=>$vslider_setting->name,'theme'=>$vslider_theme->name);//vSlider Name | vSlider Settings | vSlider Theme
                $vsliders_default_array= serialize(array($vslider_default));    
                add_option('vsliders',$vsliders_default_array);
                
                add_option('vslider_version', $vslider->version);
                add_option('vslider_support', 0);
                add_option('vslider_installed', 1);
               // }
     }

 
function vslider_plugin_uninstall() {
   delete_option('vslider_installed');
   delete_option('vslider_version');
   delete_option('vslider_support');
   $vsliders=unserialize(get_option('vsliders'));
   foreach($vsliders as $vslider)
   {   
       if(get_option($vslider['name']))
       delete_option($vslider['name']);
   }
   
   $settings=unserialize(get_option('vslider_settings'));
   foreach($settings as $setting)
   {
       if(get_option($setting))
       delete_option($setting);
   }
   
   $themes=unserialize(get_option('vslider_themes'));
   foreach($themes as $theme)
   {
       if(get_option($theme))
       delete_option($theme);
   }
   delete_option('vsliders');
   delete_option('vslider_settings');
   delete_option('vslider_themes');
   delete_option('vslider_migrated');
}

//REQUEST HANDLER


// LIMIT CONTENT FUNCTION
function vslider_limitpost ($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo $content;
      echo "&nbsp;<a rel='nofollow' href='";
      the_permalink();
      echo "'>".__('Read More', 'vibe')." &rarr;</a>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;
        echo "...";
        echo "&nbsp;<a rel='nofollow' href='";
        the_permalink();
        echo "'>".$more_link_text."</a>";
   }
   else {
      echo $content;
      echo "&nbsp;<a rel='nofollow' href='";
      the_permalink();
      echo "'>".__('Read More', 'vibe')." &rarr;</a>";
   }
}

function vSlider_link() { ?>
<noscript><a href="http://www.vibethemes.com/" target="_blank" title="wordpress themes">Vibe Themes</a></noscript>
<?php }
if(get_option('vslider_support')==1) //Asking USER EXPLICITLY TO SUPPORT VSLIDER not the DEFAULT OPTION
{add_action('wp_footer', 'vSlider_link');}

// Add vSlider short code  use vslider as  [vslider name='vslider_options']
function vslider_short_code($atts) {
	ob_start();
    extract(shortcode_atts(array(
		"name" => ''
	), $atts));
        if(($name))
	vslider($name);
        else
            vslider('vslider_default');
	$output = ob_get_clean();
	return $output;
}
add_shortcode('vslider', 'vslider_short_code');



// REGISTER VSLIDER AS WIDGET
add_action('widgets_init', create_function('', "register_widget('vslider_widget');"));

class vslider_widget extends WP_Widget {

	function vslider_widget() { 
	   $options = get_option('vslider_options');
		$widget_ops = array( 'classname' => 'vslider-widget', 'description' => 'jQuery Image Slider' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'vslider-widget' );
		$this->WP_Widget( 'vslider-widget', 'vSlider Widget', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);

		echo $before_widget;

			if (!empty($instance['title']))
				echo $before_title . $instance['title'] . $after_title;
                
    if (empty($instance['vslider']))
    {
        $instance['vslider']='vslider_options';
    }
    vslider ($instance['vslider']); //check

	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
         $instance=$old_instance;
        /* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['vslider'] = $new_instance['vslider'];
        return $instance;
	}

	function form($instance) { ?>
    
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" /></p>
        <p><label><?php _e("vSlider Name"); ?>:</label>  <br />  
            <select id="<?php echo $this->get_field_name('vslider'); ?>" name="<?php echo $this->get_field_name('vslider'); ?>">
            <?php
            $vsliderinfo=get_option('vsliders');
        if(is_string($vsliderinfo))
            $vsliderinfo=unserialize($vsliderinfo);
        
    foreach ($vsliderinfo as $data) { 
        ?>
            <option value="<?php echo $data['name']; ?>" <?php if ( $data['name'] == $instance['vslider'] ) echo 'selected="selected"'; ?>><?php echo $data['name']; ?></option>
            <?php 
            }
            ?>
            </select>
            </p>

	<?php
	}
}

function admin_init_script(){
        //include vslider admin scripts and styles
        wp_enqueue_script  ('media-upload');
        wp_enqueue_script  ('thickbox');
        wp_register_script ('vslider-upload', WP_PLUGIN_URL.'/vslider/js/upload.js', array('jquery','media-upload', 'thickbox'));
        wp_enqueue_script  ('vslider-upload');
        wp_register_script ( 'colorpicker-js', WP_PLUGIN_URL.'/vslider/picker/colorpicker.js', array('jquery'));
        wp_enqueue_script  ('colorpicker-js' );
        wp_register_script ( 'custom-js', WP_PLUGIN_URL.'/vslider/js/custom.js', array('jquery'));
        wp_enqueue_script  ('custom-js' );            
    }
    
    function admin_init_style(){
        //include vslider admin scripts and styles
        wp_enqueue_style('thickbox');
        wp_register_style('colorpicker-css', WP_PLUGIN_URL.'/vslider/picker/colorpicker.css');
        wp_enqueue_style( 'colorpicker-css');
        wp_register_style('tooltip-css', WP_PLUGIN_URL.'/vslider/css/tooltip.css');
        wp_enqueue_style( 'tooltip-css');    
    }
    
    function vs_init_scripts(){
        wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' ); 
        wp_enqueue_script('vslider', WP_PLUGIN_URL.'/vslider/js/vslider.js', $deps = array('jquery'));
    }
    
    function vs_init_styles(){
        wp_register_style('vslider-css', WP_PLUGIN_URL.'/vslider/css/themes/default/default.css');
        wp_enqueue_style( 'vslider-css');
    }


function old_vslider(){
        global $wpdb;
    $table_name = $wpdb->prefix . "vslider"; 
    $vs_data = $wpdb->get_results("show tables like '$table_name'");
    
    if($vs_data)
        return 1;
    else
        return 0;
    
}    
function check_oldvslider(){
    global $wpdb;
    $migrated=get_option('vslider_migrated');
    if(!$migrated){
        $table_name = $wpdb->prefix . "vslider"; 
    $vs_data = $wpdb->get_results("show tables like '$table_name'");
    
    
    if($vs_data)
    {  echo "You are using older version of vSlider, you'll need to migrate following vsliders to newer version.<form method='post'>";
        $i=1;
        $vslider_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
        foreach ($vslider_data as $data) { 
          echo '<br /> <b>'.$i.'</b> '.$data->option_name;
          $i++;
        }
        echo "<input type='submit' style='padding:5px 10px;margin-left:50px;' class='button-primary' value='Migrate to 4.2 Version' name='migrate_vsliders'/><input type='submit' style='padding:5px 10px;margin:0 20px;' class='button' value='Skip, Do not show again, I will create New vSliders!' name='skip_migrate_vsliders'/></form>";
     }  
    }
    else{ if($migrated<2){
        if(isset($_POST['skip_migrate_vsliders'])){
            echo " You've chosen not to migrate vSliders to 4.2, In order to make your existing vSliders work, <br />Please download the vSlider 4.1.X version ffrom VibeThemes.com. OR reactivate vSlider 4.2 from plugins panel to migrate vSliders.";
        }else
          echo "Congratulations! vSliders successfully Migrated to version 4.2." ;
          update_option('vslider_migrated',2);
     }
    }
        
    
}

function migrate_vsliders(){
echo "<br><h3>2. Migrating vSliders</h3>";
    global $wpdb;
    $table_name = $wpdb->prefix . "vslider";
    $vslider_data = $wpdb->get_results("SELECT option_name FROM $table_name ORDER BY id");
    $vslider=new vslider();
    $theme=new vslider_themes();
    
   foreach ($vslider_data as $data) { 
         $existing_migrated=get_option($data->option_name);
         $vslider->migrate_vslider($data->option_name);
         $theme->migrate_theme($data->option_name);
         if(is_string($existing_migrated))
            {
             $existing_migrated=unserialize($existing_migrated);
             }
         
            update_option($vslider->name,serialize($vslider));
            update_option($theme->name,serialize($theme));

            update_vsliders($vslider->name);
            update_themes($theme->name);
   }
    update_option('vslider_migrated',1);
    echo '<br><h2>Migration Complete!</h2>';
}


function update_vsliders($vslider){

    $vsliders=get_option('vsliders');
    if(is_string($vsliders))
    {
       $vsliders=unserialize($vsliders);
    }
    $vslider_array=array('name'=>$vslider,'setting'=>'vs_settings','theme'=>'vstheme_'.$vslider);
    
    if(!array_search($vslider_array->name,$vsliders)){
      array_push($vsliders, $vslider_array);
      update_option('vsliders',serialize($vsliders));  
    } 
}

function update_themes($theme){
    $themes=get_option('vslider_themes');
    if(is_string($themes))
    {
       $themes=unserialize($themes);
    }
    if(!in_array($theme,$themes)){
        array_push($themes, $theme);
        update_option('themes',serialize($themes)); 
    }
}

function skip_migrate_vsliders(){
    update_option('vslider_migrated',1);
}
?>