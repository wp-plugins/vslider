<?php

/**
 * FILE: widget.php 
 * Created on Feb 1, 2013 at 1:42:29 PM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider 5.0
 * License: GPLv2
 */

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
    
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title",'vslider'); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" /></p>
        <p><label><?php _e("vSlider Name",'vslider'); ?>:</label>  <br />  
            <select id="<?php echo $this->get_field_name('vslider'); ?>" name="<?php echo $this->get_field_name('vslider'); ?>">
            <?php
             global $wpdb;
             $num=1;
	     $table_name = $wpdb->prefix . "vslider"; 
             $vslider_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
             foreach ($vslider_data as $data) { 
        ?>
            <option value="<?php echo $data->option_name; ?>" <?php if ( $data->option_name == $instance['vslider'] ) echo 'selected="selected"'; ?>><?php echo $data->option_name; ?></option>
            <?php 
            }
            ?>
            </select>
            </p>

	<?php
	}
}
?>
