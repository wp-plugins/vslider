<?php
/*
Plugin Name: vSlider
Plugin URI: http://www.vibethemes.com/wordpress-plugins/vslider-wordpress-image-slider-plugin/
Description: WordPress image slider to feature a specific category or to use custom images. Just copy this code: <strong>&lt;?php if (function_exists('vslider')) { vslider(); }?&gt;</strong> in your theme and set the slider options. vslider by  <a href="http://www.vibethemes.com/" title="premium wordpress themes">VibeThemes</a>.
Author: VibeThemes.com
Version: 1.2
Author URI: http://www.vibethemes.com/
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
        			timeout: 5000,
        			type: 'sequence',
        			containerheight: '<?php echo $v_height; ?>px'
        		});
        });
    </script>
    <!-- End vslider -->

<?php }

// vslider Custom Field image function
function vslider_custom_field() {
if(!$post_id)
global $post;
preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post->post_content, $sImages);
$SlideImg = $sImages[1][0];


    if ( $Slider = get_post_meta($post->ID, "Slider", true) ) {
        echo '<a href="' . get_permalink($post->ID) . '" title="' . the_title_attribute('echo=0') . '"><img src='. $Slider . ' style="width:'. $v_width .'px;height:'. $v_height .'px;" alt="' . the_title_attribute('echo=0') . '" class="vsliderImg"/></a>';
 }
    elseif ($Slider = get_post_meta($post->ID, "slider", true) ) {
        echo '<a href="' . get_permalink($post->ID) . '" title="' . the_title_attribute('echo=0') . '"><img src='. $Slider . ' style="width:'. $v_width .'px;height:'. $v_height .'px;" alt="' . the_title_attribute('echo=0') . '" class="vsliderImg"/></a>';
 }
    elseif ($sImages[1][0]) {
        echo '<a href="' . get_permalink($post->ID) . '" title="' . the_title_attribute('echo=0') . '"><img src='. $SlideImg . ' style="width:'. $v_width .'px;height:'. $v_height .'px;" alt="' . the_title_attribute('echo=0') . '" class="vsliderImg"/></a>';
 }
    else {}

}

function vSlider_link() { ?>
<noscript><a href="http://www.vibethemes.com/" target="_blank" title="wordpress themes">Vibe Themes</a></noscript>
<?php }

// vslider Function
function vslider() { ?>

    <div id="vslider">
        <ul id="sliderbody">
            <?php $v_custom = get_option('v_custom');
                if($v_custom): ?>

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

                <?php else: ?>

                <?php $vibe_cat = get_option("vibe_cat"); $vFeat_posts = get_option("vFeat_posts"); ?>
		        <?php $recent = new WP_Query("cat=".$vibe_cat."&showposts=".$vFeat_posts.""); while($recent->have_posts()) : $recent->the_post();?>
                    <li><?php vslider_custom_field(); ?></li>
                <?php endwhile; ?>

                <?php endif; ?>
        </ul>
    </div>

<?php }

// Add The Option Page to WordPress Dashboard
function vslider_addPage () {

    add_menu_page('vSlider Setup', 'vSlider Setup', 8, __FILE__, 'vslider_page');

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
    $vLink_1 = get_option("vLink_1");
    $vLink_2 = get_option("vLink_2");
    $vLink_3 = get_option("vLink_3");
    $vLink_4 = get_option("vLink_4");
    $vLink_5 = get_option("vLink_5");
    $v_speed = get_option("v_speed");
    $v_anim = get_option("v_anim");
    $vslider_css = get_option("vslider_css");

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
    update_option('vLink_1', $_POST['vLink_1']);
    update_option('vLink_2', $_POST['vLink_2']);
    update_option('vLink_3', $_POST['vLink_3']);
    update_option('vLink_4', $_POST['vLink_4']);
    update_option('vLink_5', $_POST['vLink_5']);
    update_option('v_speed', $_POST['v_speed']);
    update_option('v_anim', $_POST['v_anim']);
    update_option('vslider_css', $_POST['vslider_css']);
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
    $vLink_1 = get_option("vLink_1");
    $vLink_2 = get_option("vLink_2");
    $vLink_3 = get_option("vLink_3");
    $vLink_4 = get_option("vLink_4");
    $vLink_5 = get_option("vLink_5");
    $v_speed = get_option("v_speed");
    $v_anim = get_option("v_anim");
    $vslider_css = get_option("vslider_css");
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
if(get_option("v_anim", "") == "") {
    $v_anim = "fade";
}
if(get_option("vslider_css", "") == "") {
    $vslider_css = "margin: 0px 0px 0px 0px;
padding: 0;
border: none;";
}

?>

<div class="wrap"><div id="icon-options-general" class="icon32"><br /></div>
<?php if ( $_REQUEST['save'] ) echo '<div id="message" class="updated fade"><p><strong>vSlider Options Saved.</strong></p></div>'; ?>

<h2><?php _e('vSlider - WordPress Image Slider Options', 'vibe') ?></h2>

        <p>
        To use vslider in your template just copy this code: <strong>&lt;?php if (function_exists('vslider')) { vslider(); }?&gt;</strong> in your theme and set the slider options below.
        <br />
        You can set the width and the height for your images, the animation speed and the animation type (fade and slide). You can choose to feature images from posts using custom fields (use "slider" as custom field name and add the path to the image as value) from a specific category, or you can add your own images and where to link when the visitors will click on them. More tutorials on how to use here.
        <br />
        To integrate the slider better in your theme, edit the vslider CSS from bellow.


        <p><form style="float:left" action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="6899397">
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form><strong>Consider donating if you enjoy this plugin</strong><br />
        This will support developing other free products</p>


        </p>

<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>&updated=true">
<input type="hidden" name="tcOptions" value="process" />
<table class="form-table" cellspacing="0">

        <tr valign="top"><!-- Dropdown Categories -->
        <th scope="row"><?php _e('vslider Options', 'vibe') ?></th>
        <td>
        <?php _e('Width:', 'vibe') ?>&nbsp;
        <input type="text" name="v_width" class="small_text" value="<?php  echo $v_width; ?>" />&nbsp;<?php _e('px', 'vibe') ?>
        &nbsp;&nbsp;
        <?php _e('Height:', 'vibe') ?>&nbsp;
        <input type="text" name="v_height" class="small_text" value="<?php  echo $v_height; ?>" />&nbsp;<?php _e('px', 'vibe') ?>
        <br /> <br />
        <?php _e('Speed:', 'vibe') ?>&nbsp;
        <input type="text" name="v_speed" class="small_text" value="<?php  echo $v_speed; ?>" />&nbsp;<?php _e('milliseconds', 'vibe') ?>
        &nbsp;&nbsp;
        <?php _e('Animation:', 'vibe') ?>&nbsp;
        <input type="text" name="v_anim" class="small_text" value="<?php  echo $v_anim; ?>" />&nbsp;<?php _e('fade or slide', 'vibe') ?>
        </td>
        </tr>

        <tr valign="top"><!-- Dropdown Categories -->
        <th scope="row"><?php _e('Image Slider Category', 'vibe') ?></th>
        <td><select name="vibe_cat" class="vibe_cat">
        <?php $categories =  get_categories('hide_empty=0');
        	foreach ($categories as $cat) {
        	    if($vibe_cat == $cat->cat_ID) {
        		    $option = '<option selected="selected" value="'.$cat->cat_ID.'">';
        		}
        		else {
        		    $option = '<option value="'.$cat->cat_ID.'">';
        		}
        	$option .= $cat->cat_name;
        	$option .= ' ('.$cat->cat_ID.')';
        	$option .= '</option>';
        	echo $option;
        	} ?>
        </select>
        &nbsp;<?php _e('Number of Posts', 'vibe') ?>&nbsp;
        <input type="text" name="vFeat_posts" class="small_text" value="<?php  echo $vFeat_posts; ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Heading -->
        <th scope="row" class="submit"><input type="submit" name="save" value="<?php _e('Update Options') ?>" /></th>
        <td>
        <h3><?php _e('Custom Image Settings', 'vibe') ?></h3>
        </td>
        </tr>

		<tr valign="top"><!-- Checkbox -->
	    <th scope="row"><?php _e('Use custom sliding images?', 'vibe') ?></th>
	    <td><input name="v_custom" id="v_custom" value="true" type="checkbox" <?php if ( get_option('v_custom') == 'true' ) echo ' checked="checked" '; ?> />&nbsp;
        <?php _e('Check this box if you want to use other images and links in the slider.<br />Insert the images paths and links bellow.)', 'vibe') ?></td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 1 path:', 'vibe') ?></th>
        <td>
        <input type="text" name="vImg_1" class="v_textField" value="<?php echo stripslashes($vImg_1); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 1 links to:', 'vibe') ?></th>
        <td>
        <input type="text" name="vLink_1" class="v_textField" value="<?php echo stripslashes($vLink_1); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 2 path:', 'vibe') ?></th>
        <td>
        <input type="text" name="vImg_2" class="v_textField" value="<?php echo stripslashes($vImg_2); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 2 links to:', 'vibe') ?></th>
        <td>
        <input type="text" name="vLink_2" class="v_textField" value="<?php echo stripslashes($vLink_2); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 3 path:', 'vibe') ?></th>
        <td>
        <input type="text" name="vImg_3" class="v_textField" value="<?php echo stripslashes($vImg_3); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 3 links to:', 'vibe') ?></th>
        <td>
        <input type="text" name="vLink_3" class="v_textField" value="<?php echo stripslashes($vLink_3); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 4 path:', 'vibe') ?></th>
        <td>
        <input type="text" name="vImg_4" class="v_textField" value="<?php echo stripslashes($vImg_4); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 4 links to:', 'vibe') ?></th>
        <td>
        <input type="text" name="vLink_4" class="v_textField" value="<?php echo stripslashes($vLink_4); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 5 path:', 'vibe') ?></th>
        <td>
        <input type="text" name="vImg_5" class="v_textField" value="<?php echo stripslashes($vImg_5); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Text -->
        <th scope="row"><?php _e('Image 5 links to:', 'vibe') ?></th>
        <td>
        <input type="text" name="vLink_5" class="v_textField" value="<?php echo stripslashes($vLink_5); ?>" />
        </td>
        </tr>

        <tr valign="top"><!-- Textarea -->
        <th scope="row"><?php _e('vslider Extra CSS:', 'vibe') ?></th>
        <td><textarea name="vslider_css" class="vibeTextarea" id="vslider_css" tabindex="2"><?php echo stripslashes($vslider_css); ?></textarea>
        <br /><?php _e('Customize here the vslider to fit best in your web page.', 'vibe') ?></td>
        </tr>

</table>

<p class="submit">
<input type="submit" name="save" value="<?php _e('Update Options') ?>" />
</p>

</form>
</div>

<?php }

function vslider_adminCSS () {?>
<style type='text/css'>

.vibeTextarea {
  background: #FFF;
  width: 500px;
  height: 100px;
  color: #555;
  font-size: 12px;
  font-family: Arial, Tahoma, Verdana;
  font-weight: normal;
  margin: 0px;
  padding: 4px 0px 4px 5px !important;
  border-top: 1px solid #666 !important;
  border-left: 1px solid #666 !important;
  border-bottom: 1px solid #DDD !important;
  border-right: 1px solid #DDD !important;
}
.v_textField {
  background: #FFF;
  width: 500px;
  color: #555;
  font-size: 12px;
  font-family: Arial, Tahoma, Verdana;
  font-weight: normal;
  margin: 0px;
  padding: 4px 0px 4px 5px !important;
  border-top: 1px solid #666 !important;
  border-left: 1px solid #666 !important;
  border-bottom: 1px solid #DDD !important;
  border-right: 1px solid #DDD !important;
  display: inline;
}
.small_text {
  background: #FFF;
  width: 50px;
  color: #555;
  font-size: 12px;
  font-family: Arial, Tahoma, Verdana;
  font-weight: normal;
  margin: 0px;
  padding: 4px 0px 4px 5px !important;
  border-top: 1px solid #666 !important;
  border-left: 1px solid #666 !important;
  border-bottom: 1px solid #DDD !important;
  border-right: 1px solid #DDD !important;
  display: inline;
}
.vibe_cat {
  background: #FFF;
  width: 200px;
  color: #555;
  font-size: 12px;
  font-family: Arial, Tahoma, Verdana;
  font-weight: normal;
  margin: 0px;
  padding: 2px 0px 2px 5px !important;
  border-top: 1px solid #666 !important;
  border-left: 1px solid #666 !important;
  border-bottom: 1px solid #DDD !important;
  border-right: 1px solid #DDD !important;
  display: inline;
}

</style>

<?php }

add_action( 'wp_print_scripts', 'vslider_loadJquery' );
add_action('wp_head', 'vslider_head');
add_action('wp_footer', 'vSlider_link');
add_action('admin_head', 'vslider_adminCSS');
add_action('admin_menu', 'vslider_addPage');

?>