<?php
/*
    Plugin Name: vSlider
    Plugin URI: http://www.vibethemes.com/wordpress-plugins/vslider-wordpress-image-slider-plugin/
    Description: Implementing a featured image gallery into your WordPress theme has never been easier! Showcase your portfolio, animate your header or manage your banners with vSlider. vslider by  <a href="http://www.vibethemes.com/" title="premium wordpress themes">VibeThemes</a>.
    Author: VibeThemes.com
    Version: 2.0
    Author URI: http://www.vibethemes.com/

	vSlider is released under GPL:
	http://www.opensource.org/licenses/gpl-license.php
*/

// Load jQuery from WordPress
function vslider_loadJquery( ) {
    wp_enqueue_script( 'jquery-ui-tabs', 'js/ui.tabs.js', array( 'jquery' ) );
}

// vslider Theme Head
function vslider_head () {
  $vslider_js = (WP_PLUGIN_URL.'/vslider/js/vslider.js');
  $v_width = get_option('v_width');
  $v_height = get_option('v_height');
  $v_speed = get_option('v_speed');
  $v_type = get_option('v_type');
  $v_timeout = get_option('v_timeout');
  $v_anim = get_option('v_anim');
  $vslider_css = get_option('vslider_css');
  if(get_option("v_width", "") == "") {
    $v_width = 600; }
  $v_height = get_option('v_height');
  if(get_option("v_height", "") == "") {
    $v_height = 280; }
  if(get_option("v_speed", "") == "") {
      $v_speed = 1000; }
  if(get_option("v_anim", "") == "") {
      $v_anim = "fade"; }
  if(get_option("v_type", "") == "") {
      $v_type = "sequence"; }
  if(get_option("v_timeout", "") == "") {
      $v_timeout = 5; }
  if(get_option("vslider_css", "") == "") {
      $vslider_css = "margin: 0px 0px 0px 0px;padding: 0;border: none;";
  } ?>

    <!-- Start vslider -->
    <style type="text/css">
        #sliderbody, #sliderbody img {width: <?php echo $v_width; ?>px;height: <?php echo $v_height; ?>px;}
        #vslider {<?php echo $vslider_css; ?>}
        #vslider {height: <?php echo $v_height; ?>px;overflow: hidden;}
        #vslider ul {list-style: none !important;margin: 0 !important;padding: 0 !important;}
        #vslider ul li {list-style: none !important;margin: 0 !important;padding: 0 !important;}
        #sliderbody {overflow: hidden !important;}
        #sliderbody img {-ms-interpolation-mode: bicubic;}
    </style>
    <script type="text/javascript" src="<?php echo $vslider_js; ?>"></script>
    <script type="text/javascript">
        /*** vslider Init ***/
        jQuery.noConflict();
        jQuery(document).ready(function(){
        	    jQuery('ul#sliderbody').innerfade({
        	        animationtype: '<?php echo $v_anim; ?>',
        		    speed: <?php echo $v_speed; ?>,
        			timeout: <?php echo $v_timeout; ?>000,
         			type: '<?php echo $v_type; ?>',
        			containerheight: '<?php echo $v_height; ?>px'
        		});
        });
    </script>
    <!-- End vslider -->

<?php }

function vSlider_link() { ?>
<noscript><a href="http://www.vibethemes.com/" target="_blank" title="wordpress themes">Vibe Themes</a></noscript>
<?php }

// vslider Function
function vslider() { ?>

    <div id="vslider">
        <ul id="sliderbody">
            <?php $v_source = get_option('v_source');
                if(get_option('v_source') == 'feat') { ?>

    			<?php $vFeat_posts = get_option("vFeat_posts"); $vibe_cat = get_option("vibe_cat");
                $recent = new WP_Query("cat=".$vibe_cat."&showposts=".$vFeat_posts."");
                while($recent->have_posts()) : $recent->the_post(); global $post;
    			$slider = get_post_meta($post->ID, 'slider', true); if (!empty($slider)) { ?>
     			<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo $slider; ?>" alt="<?php the_title(); ?>" class="vsliderImg" /></a></li>
                <?php }endwhile; ?>

                <?php } else if(get_option('v_source') == 'scan') { ?>

    			<?php $vFeat_posts = get_option("vFeat_posts");
                $recent = new WP_Query("showposts=".$vFeat_posts."");
                while($recent->have_posts()) : $recent->the_post(); global $post;
    			$slider = get_post_meta($post->ID, 'slider', true); if (!empty($slider)) { ?>
     			<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo $slider; ?>" alt="<?php the_title(); ?>" class="vsliderImg" /></a></li>
                <?php }endwhile; ?>

                <?php } else if(get_option('v_source') == 'custom') { ?>

                <?php $vImg_1 = get_option('vImg_1'); $vLink_1 = get_option('vLink_1'); if($vImg_1) { ?>
                <li><a href="<?php echo stripslashes($vLink_1); ?>"><img src="<?php echo stripslashes($vImg_1); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_2 = get_option('vImg_2'); $vLink_2 = get_option('vLink_2'); if($vImg_2) { ?>
                <li><a href="<?php echo stripslashes($vLink_2); ?>"><img src="<?php echo stripslashes($vImg_2); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_3 = get_option('vImg_3'); $vLink_3 = get_option('vLink_3'); if($vImg_3) { ?>
                <li><a href="<?php echo stripslashes($vLink_3); ?>"><img src="<?php echo stripslashes($vImg_3); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_4 = get_option('vImg_4'); $vLink_4 = get_option('vLink_4'); if($vImg_4) { ?>
                <li><a href="<?php echo stripslashes($vLink_4); ?>"><img src="<?php echo stripslashes($vImg_4); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_5 = get_option('vImg_5'); $vLink_5 = get_option('vLink_5'); if($vImg_5) { ?>
                <li><a href="<?php echo stripslashes($vLink_5); ?>"><img src="<?php echo stripslashes($vImg_5); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_6 = get_option('vImg_6'); $vLink_5 = get_option('vLink_6'); if($vImg_6) { ?>
                <li><a href="<?php echo stripslashes($vLink_6); ?>"><img src="<?php echo stripslashes($vImg_6); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_7 = get_option('vImg_7'); $vLink_7 = get_option('vLink_7'); if($vImg_7) { ?>
                <li><a href="<?php echo stripslashes($vLink_7); ?>"><img src="<?php echo stripslashes($vImg_7); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_8 = get_option('vImg_8'); $vLink_8 = get_option('vLink_5'); if($vImg_8) { ?>
                <li><a href="<?php echo stripslashes($vLink_8); ?>"><img src="<?php echo stripslashes($vImg_8); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_9 = get_option('vImg_9'); $vLink_9 = get_option('vLink_9'); if($vImg_9) { ?>
                <li><a href="<?php echo stripslashes($vLink_9); ?>"><img src="<?php echo stripslashes($vImg_9); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php $vImg_10 = get_option('vImg_10'); $vLink_10 = get_option('vLink_10'); if($vImg_10) { ?>
                <li><a href="<?php echo stripslashes($vLink_10); ?>"><img src="<?php echo stripslashes($vImg_10); ?>" alt="featured" class="vsliderImg" /></a></li><?php } ?>

                <?php } else { ?>

                <li><img src="<?php echo (WP_PLUGIN_URL.'/vslider/slide1.jpg'); ?>" alt="vslider" class="vsliderImg" /></li>
                <li><img src="<?php echo (WP_PLUGIN_URL.'/vslider/slide2.jpg'); ?>" alt="vslider" class="vsliderImg" /></li>

                <?php } ?>
        </ul>
    </div>

<?php }

// Register vSlider As Widget
add_action('widgets_init', create_function('', "register_widget('vslider_widget');"));
class vslider_widget extends WP_Widget {

	function vslider_widget() {
		$widget_ops = array( 'classname' => 'vslider-widget', 'description' => 'jQuery based image slider' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'vslider-widget' );
		$this->WP_Widget( 'vslider-widget', 'vSlider - Image Slider', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);

		echo $before_widget;

			if (!empty($instance['title']))
				echo $before_title . $instance['title'] . $after_title;

			vslider();

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) { ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" /></p>

	<?php
	}
}

// Add vSlider Short Code
add_shortcode('vslider', 'vslider');

// Add meta box for image upload. Based on Add Meta Boxes plugin by Nathan Rice http://www.nathanrice.net/
if(!function_exists('get_vslider_custom_field')) {
function get_vslider_custom_field($field) {
	global $post;
	$vslider_custom_field = get_post_meta($post->ID, $field, true);
	echo $vslider_custom_field;
}
}

function vslider_add_custom_box() {
	if( function_exists( 'add_meta_box' )) {
		add_meta_box( 'vslider_custom_box_1', __( 'vSlider Image Upload' ), 'vslider_inner_custom_box_1', 'post', 'normal', 'high' );
	}
}

function vslider_inner_custom_box_1() {
	global $post;

	echo '<input type="hidden" name="vslider_noncename" id="vslider_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<strong>Featured/Slider Image URL:</strong>';
	echo '<input type="text" style="float:right;width:500px;" name="slider" value="'. get_post_meta($post->ID, 'slider', true) .'" width="100%" />';
    echo '<div style="clear:both;margin-bottom: 3px;"></div>';
    echo '<strong><a href="media-upload.php?type=image&amp;TB_iframe=true" id="add_image" class="thickbox" title="Add an Image" onclick="return false;">Upload an image</a></strong> and paste the URL here.';
    echo '<div style="clear:both;margin-bottom: 20px;"></div>';

}

function vslider_save_postdata($post_id, $post) {

	if ( !wp_verify_nonce( $_POST['vslider_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post->ID ))
		return $post->ID;
	} else {
		if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	}

	$vsliderdata['slider'] = $_POST['slider'];

	// Add values of $vsliderdata as custom fields

	foreach ($vsliderdata as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
	}

}

add_action('admin_menu', 'vslider_add_custom_box');
add_action('save_post', 'vslider_save_postdata', 1, 2);

// Add The Option Page to WordPress Dashboard
function vslider_addPage () {
    add_menu_page('vSlider Setup', 'vSlider Setup', 8, __FILE__, 'vslider_page', 'http://www.vibethemes.com/vslidersetup/icon.png');
}

// vSlide Options Page
function vslider_page () {
    $cur_page = $_SERVER['PHP_SELF'].'?page='.$_GET['page'];
    $v_width = get_option("v_width");
    $v_height = get_option("v_height");
    $vibe_cat = get_option("vibe_cat");
    $vFeat_posts = get_option("vFeat_posts");
    $v_custom = get_option("v_custom");
    $vImg_1 = get_option("vImg_1");
    $vImg_2 = get_option("vImg_2");
    $vImg_3 = get_option("vImg_3");
    $vImg_4 = get_option("vImg_4");
    $vImg_5 = get_option("vImg_5");
    $vImg_6 = get_option("vImg_6");
    $vImg_7 = get_option("vImg_7");
    $vImg_8 = get_option("vImg_8");
    $vImg_9 = get_option("vImg_9");
    $vImg_10 = get_option("vImg_10");
    $vLink_1 = get_option("vLink_1");
    $vLink_2 = get_option("vLink_2");
    $vLink_3 = get_option("vLink_3");
    $vLink_4 = get_option("vLink_4");
    $vLink_5 = get_option("vLink_5");
    $vLink_6 = get_option("vLink_6");
    $vLink_7 = get_option("vLink_7");
    $vLink_8 = get_option("vLink_8");
    $vLink_9 = get_option("vLink_9");
    $vLink_10 = get_option("vLink_10");
    $v_speed = get_option("v_speed");
    $v_anim = get_option("v_anim");
    $vslider_css = get_option("vslider_css");
    $v_timeout = get_option("v_timeout");
    $v_type = get_option("v_type");
    $v_source = get_option("v_source");

if ('process' == $_POST['tcOptions']) {
    update_option('v_width', $_POST['v_width']);
    update_option('v_height', $_POST['v_height']);
    update_option('vibe_cat', $_POST['vibe_cat']);
    update_option('vFeat_posts', $_POST['vFeat_posts']);
    update_option('v_custom', $_POST['v_custom']);
    update_option('vImg_1', $_POST['vImg_1']);
    update_option('vImg_2', $_POST['vImg_2']);
    update_option('vImg_3', $_POST['vImg_3']);
    update_option('vImg_4', $_POST['vImg_4']);
    update_option('vImg_5', $_POST['vImg_5']);
    update_option('vImg_6', $_POST['vImg_6']);
    update_option('vImg_7', $_POST['vImg_7']);
    update_option('vImg_8', $_POST['vImg_8']);
    update_option('vImg_9', $_POST['vImg_9']);
    update_option('vImg_10', $_POST['vImg_10']);
    update_option('vLink_1', $_POST['vLink_1']);
    update_option('vLink_2', $_POST['vLink_2']);
    update_option('vLink_3', $_POST['vLink_3']);
    update_option('vLink_4', $_POST['vLink_4']);
    update_option('vLink_5', $_POST['vLink_5']);
    update_option('vLink_6', $_POST['vLink_6']);
    update_option('vLink_7', $_POST['vLink_7']);
    update_option('vLink_8', $_POST['vLink_8']);
    update_option('vLink_9', $_POST['vLink_9']);
    update_option('vLink_10', $_POST['vLink_10']);
    update_option('v_speed', $_POST['v_speed']);
    update_option('v_anim', $_POST['v_anim']);
    update_option('vslider_css', $_POST['vslider_css']);
    update_option('v_timeout', $_POST['v_timeout']);
    update_option('v_type', $_POST['v_type']);
    update_option('v_source', $_POST['v_source']);
    $v_width = get_option("v_width");
    $v_height = get_option("v_height");
    $vibe_cat = get_option("vibe_cat");
    $vFeat_posts = get_option("vFeat_posts");
    $v_custom = get_option("v_custom");
    $vImg_1 = get_option("vImg_1");
    $vImg_2 = get_option("vImg_2");
    $vImg_3 = get_option("vImg_3");
    $vImg_4 = get_option("vImg_4");
    $vImg_5 = get_option("vImg_5");
    $vImg_6 = get_option("vImg_6");
    $vImg_7 = get_option("vImg_7");
    $vImg_8 = get_option("vImg_8");
    $vImg_9 = get_option("vImg_9");
    $vImg_10 = get_option("vImg_10");
    $vLink_1 = get_option("vLink_1");
    $vLink_2 = get_option("vLink_2");
    $vLink_3 = get_option("vLink_3");
    $vLink_4 = get_option("vLink_4");
    $vLink_5 = get_option("vLink_5");
    $vLink_6 = get_option("vLink_6");
    $vLink_7 = get_option("vLink_7");
    $vLink_8 = get_option("vLink_8");
    $vLink_9 = get_option("vLink_9");
    $vLink_10 = get_option("vLink_10");
    $v_speed = get_option("v_speed");
    $v_anim = get_option("v_anim");
    $vslider_css = get_option("vslider_css");
    $v_timeout = get_option("v_timeout");
    $v_type = get_option("v_type");
    $v_source = get_option("v_source");
}

if(get_option("vFeat_posts", "") == "") {
    $vFeat_posts = 3;
}
if(get_option("v_width", "") == "") {
    $v_width = 600;
}
if(get_option("v_height", "") == "") {
    $v_height = 280;
}
if(get_option("v_speed", "") == "") {
    $v_speed = 1000;
}
if(get_option("v_timeout", "") == "") {
    $v_timeout = 5;
}
if(get_option("vslider_css", "") == "") {
    $vslider_css = "margin: 0px 0px 0px 0px;
padding: 0;
border: none;";
}

?>

<div class="wrap" id="vslider-panel"><div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php _e("vSlider - WordPress Image Slider Options"); ?></h2>
    <?php if ( $_REQUEST['save'] ) echo '<div id="message" class="updated fade" style="width:750px;"><p><strong>vSlider Options Saved.</strong></p></div>'; ?>
    <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>&updated=true">
    <input type="hidden" name="tcOptions" value="process" />

    <!-- Start First Column -->
	<div class="metabox-holder">

		<div class="postbox">
		<h3>Thank You for Using VibeThemes Products</h3>
			<div class="inside">
                <?php $url = 'http://www.vibethemes.com/vslidersetup/vslider.php'; $request = new WP_Http; $result = $request->request( $url ); $json = $result['body']; echo $json; ?>
                <p><a href="http://twitter.com/VibeThemes" target="_blank">Follow us on Twitter</a>&nbsp;&nbsp;&nbsp;
                <a href="http://www.vibethemes.com/vslidersetup/donate.html" target="popupwindow" onclick="window.open('http://www.vibethemes.com/vslidersetup/donate.html', 'popupwindow', 'scrollbars=no,width=800,height=700');return true">
                <?php _e('Love this Plugin?') ?></a></p>
			</div>
		</div>

		<div class="postbox">
		<h3><?php _e("How to implement vSlider in your theme:"); ?></h3>
			<div class="inside">
                <p><strong>Using short code</strong><small> (Inside the loop)</small>: <a href="http://www.vibethemes.com/vslidersetup/shortcode.html" target="popupwindow" onclick="window.open('http://localhost/xampp/video.html', 'popupwindow', 'scrollbars=no,width=570,height=355');return true">
                <?php _e('video') ?></a><br />
                When writing a new post or page, just paste this into your post: [vslider]</p>
                <p><strong>As a widget:</strong> <a href="http://www.vibethemes.com/vslidersetup/custom.html" target="popupwindow" onclick="window.open('http://www.vibethemes.com/vslidersetup/custom.html', 'popupwindow', 'scrollbars=no,width=570,height=355');return true">
                <?php _e('video') ?></a> <br />
                Go to Appearance - Widgets and drag vSlider Widget to your sidebar.
                </p>
                <p><strong>As PHP code</strong><small> (outside the loop)</small> : <a href="http://www.vibethemes.com/vslidersetup/php.html" target="popupwindow" onclick="window.open('http://www.vibethemes.com/vslidersetup/php.html', 'popupwindow', 'scrollbars=no,width=570,height=355');return true">
                <?php _e('video') ?></a><br />
                Copy the code into your theme PHP file:<br />
                <strong style="font-size:10px;">&lt;?php if (function_exists('vslider')) { vslider(); }?&gt;</strong></p>
			</div>
		</div>

		<div class="postbox">
		<h3><?php _e("vSlider General Settings"); ?></h3>
			<div class="inside">
                <p>
                <?php _e("Width:"); ?>&nbsp;<input type="text" name="v_width" value="<?php  echo $v_width; ?>" size="5" />&nbsp;px&nbsp;&nbsp;
                <?php _e("Height:"); ?>&nbsp;<input type="text" name="v_height" value="<?php  echo $v_height; ?>" size="5" />&nbsp;px
                </p>
                <p>
                <?php _e("Speed:"); ?>&nbsp;<input type="text" name="v_speed" value="<?php  echo $v_speed; ?>" size="5" />&nbsp;<?php _e("milliseconds"); ?>&nbsp;&nbsp;
                <?php _e("Animation:"); ?>&nbsp;
                <select name="v_anim">
            	<option style="padding-right:10px;" value="fade" <?php selected('fade', get_option("v_anim")); ?>><?php _e("Fade"); ?></option>
            	<option style="padding-right:10px;" value="slide" <?php selected('slide', get_option("v_anim")); ?>><?php _e("Slide"); ?></option>
            	</select>
                </p>
                <p><?php _e("Timeout:"); ?>&nbsp;<input type="text" name="v_timeout" value="<?php  echo $v_timeout; ?>" size="5" />&nbsp;<?php _e("seconds"); ?>&nbsp;&nbsp;
                <?php _e("Type:"); ?>&nbsp;
                <select name="v_type">
            	<option style="padding-right:10px;" value="sequence" <?php selected('sequence', get_option("v_type")); ?>><?php _e("Sequence"); ?></option>
            	<option style="padding-right:10px;" value="random" <?php selected('random', get_option("v_type")); ?>><?php _e("Random"); ?></option>
                <option style="padding-right:10px;" value="random_start" <?php selected('random_start', get_option("v_type")); ?>><?php _e("Random Start"); ?></option>
            	</select>
                </p>
                <p><strong><?php _e('Display images from:') ?></strong>&nbsp;
                <select name="v_source">
            	<option style="padding-right:10px;" value="feat" <?php selected('feat', get_option("v_source")); ?>><?php _e("A Featured Category"); ?></option>
            	<option style="padding-right:10px;" value="scan" <?php selected('scan', get_option("v_source")); ?>><?php _e("Scan For Custom Fields"); ?></option>
                <option style="padding-right:10px;" value="custom" <?php selected('custom', get_option("v_source")); ?>><?php _e("My Custom Images"); ?></option>
            	</select>
                </p>
                <p><?php _e('# of posts:') ?>&nbsp;<input type="text" name="vFeat_posts" value="<?php  echo $vFeat_posts; ?>" size="5" />&nbsp;<small>(<?php _e('For featured posts or custom fields') ?>)</small>
                </p>
                <p><?php _e('Featured Category:') ?>&nbsp;
                <?php wp_dropdown_categories(array('hide_empty' => 0, 'class' => 'vslider_select', 'name' => 'vibe_cat', 'orderby' => 'name', 'selected' => get_option('vibe_cat'), 'hierarchical' => true));?>
                </p>

                <p><a href="http://www.vibethemes.com/vslidersetup/custom.html" target="popupwindow" onclick="window.open('http://www.vibethemes.com/vslidersetup/custom.html', 'popupwindow', 'scrollbars=no,width=570,height=355');return true">
                <?php _e('Watch here how to add images to vSlider') ?></a> (video)</p>

              <p><input type="submit" class="button" name="save" value="<?php _e('Update Options') ?>" /></p>
			</div>
		</div>

		<div class="postbox">
		<h3><?php _e("Custom CSS Settings"); ?></h3>
			<div class="inside">
                <p>Enter here custom CSS for vSlider:<br />
                <textarea name="vslider_css" cols="45" rows="4"><?php echo stripslashes($vslider_css); ?></textarea>
                </p>
                <p><input type="submit" class="button" name="save" value="<?php _e('Update Options') ?>" /></p>
			</div>
		</div>

		<p><input type="submit" class="button-primary" name="save" value="<?php _e('Save Settings') ?>" /></p>

	</div>
    <!-- End First Column -->

    <!-- Start Second Column -->
	<div class="metabox-holder">

		<div class="postbox">
		<h3><?php _e("Custom Images Setup"); ?></h3>
			<div class="inside">
                <p><?php _e("Image 1 path:"); ?><br />
                <input type="text" name="vImg_1" value="<?php echo stripslashes($vImg_1); ?>" size="55" />
                <?php _e("Image 1 links to:"); ?><br />
                <input type="text" name="vLink_1" value="<?php echo stripslashes($vLink_1); ?>" size="55" />
                </p>

                <p><?php _e("Image 2 path:"); ?><br />
                <input type="text" name="vImg_2" value="<?php echo stripslashes($vImg_2); ?>" size="55" />
                <?php _e("Image 2 links to:"); ?><br />
                <input type="text" name="vLink_2" value="<?php echo stripslashes($vLink_2); ?>" size="55" />
                </p>

                <p><?php _e("Image 3 path:"); ?><br />
                <input type="text" name="vImg_3" value="<?php echo stripslashes($vImg_3); ?>" size="55" />
                <?php _e("Image 3 links to:"); ?><br />
                <input type="text" name="vLink_3" value="<?php echo stripslashes($vLink_3); ?>" size="55" />
                </p>

                <p><?php _e("Image 4 path:"); ?><br />
                <input type="text" name="vImg_4" value="<?php echo stripslashes($vImg_4); ?>" size="55" />
                <?php _e("Image 4 links to:"); ?><br />
                <input type="text" name="vLink_4" value="<?php echo stripslashes($vLink_4); ?>" size="55" />
                </p>

                <p><?php _e("Image 5 path:"); ?><br />
                <input type="text" name="vImg_5" value="<?php echo stripslashes($vImg_5); ?>" size="55" />
                <?php _e("Image 5 links to:"); ?><br />
                <input type="text" name="vLink_5" value="<?php echo stripslashes($vLink_5); ?>" size="55" />
                </p>

                <p><?php _e("Image 6 path:"); ?><br />
                <input type="text" name="vImg_6" value="<?php echo stripslashes($vImg_6); ?>" size="55" />
                <?php _e("Image 6 links to:"); ?><br />
                <input type="text" name="vLink_6" value="<?php echo stripslashes($vLink_6); ?>" size="55" />
                </p>

                <p><?php _e("Image 7 path:"); ?><br />
                <input type="text" name="vImg_7" value="<?php echo stripslashes($vImg_7); ?>" size="55" />
                <?php _e("Image 7 links to:"); ?><br />
                <input type="text" name="vLink_7" value="<?php echo stripslashes($vLink_7); ?>" size="55" />
                </p>

                <p><?php _e("Image 8 path:"); ?><br />
                <input type="text" name="vImg_8" value="<?php echo stripslashes($vImg_8); ?>" size="55" />
                <?php _e("Image 8 links to:"); ?><br />
                <input type="text" name="vLink_8" value="<?php echo stripslashes($vLink_8); ?>" size="55" />
                </p>

                <p><?php _e("Image 9 path:"); ?><br />
                <input type="text" name="vImg_9" value="<?php echo stripslashes($vImg_9); ?>" size="55" />
                <?php _e("Image 9 links to:"); ?><br />
                <input type="text" name="vLink_9" value="<?php echo stripslashes($vLink_9); ?>" size="55" />
                </p>

                <p><?php _e("Image 10 path:"); ?><br />
                <input type="text" name="vImg_10" value="<?php echo stripslashes($vImg_10); ?>" size="55" />
                <?php _e("Image 10 links to:"); ?><br />
                <input type="text" name="vLink_10" value="<?php echo stripslashes($vLink_10); ?>" size="55" />
                </p>

                <p><input type="submit" class="button" name="save" value="<?php _e('Update Options') ?>" /></p>
			</div>
		</div>

	</div>
    <!-- End Second Column -->

	</form>
</div>

<?php }

function vslider_adminCSS () {?>
<style type='text/css'>
#vslider-panel .metabox-holder {float: left;width: 380px;margin: 0px; padding:0px 10px 0px 0px;}
#vslider-panel .metabox-holder .postbox .inside {padding: 0 10px;}
.red {font-weight: normal;color: #B80028;}
</style>

<?php }

add_action( 'wp_print_scripts', 'vslider_loadJquery' );
add_action('wp_head', 'vslider_head');
add_action('wp_footer', 'vSlider_link');
add_action('admin_head', 'vslider_adminCSS');
add_action('admin_menu', 'vslider_addPage');

?>
