<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//vSlider main page
function change_vslidersetup($vs) { 
    global $message; 
    echo $message; ?>
<div class="wrap" style="width:820px;"">
     <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e("vSlider Change Setup [ ".$vs->name." ]"); ?></h2>
    <form method="post">

 <h3><?php _e("vSlider Change Setup", 'vslider'); ?> <a href="?page=vslider" class="button" style="float:right;">Back to vSliders</a></h3>
 <div class="postbox">
     <h3 style="padding:5px 10px;"><?php _e("vSlider Combination", 'vslider'); ?> </h3>
     <div style="padding:10px;">
         <table><tr>
     <?php
     $settings=unserialize(get_option('vslider_settings'));
     $themes=unserialize(get_option('vslider_themes'));
     
     $settings=array_unique($settings);
     $themes=array_unique($themes);
     ?>
       <td style="min-width:200px;padding:10px;"><?php _e(" vSlider Name :<br />".$vs->name, 'vslider'); ?></td>
       <td style="min-width:200px;padding:10px;"> <?php _e(" Select vSlider Setting :", 'vslider'); ?>  <br /> 
          <select name="vs_setting">
              <?php
              foreach($settings as $setting){
              echo '<option value="'.$setting.'"'. selected( $setting, $vs->settings).'>'.$setting.'</option>';
             }
             ?>
          </select>
       </td>
       <td style="min-width:200px;padding:10px;">
          <?php _e(" Select vSlider Theme :", 'vslider'); ?>  <br /> 
          <select name="vs_theme">
              <?php
              foreach($themes as $theme){
              echo '<option value="'.$theme.'"'. selected( $theme,$vs->themes).'>'.$theme.'</option>';
             }
             ?>
          </select>
       </td>
       <td>
          <input type="hidden" name="vslider_name" value="<?php echo $vs->name; ?>" />
           <input type="submit" name="save_changevslider" style="padding:5px 10px;" class="button-primary" value="<?php _e('Save Changes') ?>" /> 
       </td>
       </tr></table> 
     </div>
 </div>
</div>
 <?php
 }
 

//vSlider main page
function edit_vsliderpage($vslider) { 
    global $message; 
    echo $message; ?>
<div class="wrap" style="width:820px;"">
     <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e("vSlider $vslider->version Edit Options Page [ ".$vslider->name." ]"); ?></h2>
    <form method="post">
<?php 
wp_nonce_field('update-images'); 
?>
 <h3><?php _e("vSlider Image Settings", 'vslider'); ?> <a href="?page=vslider" class="button" style="float:right;">Back to vSliders</a></h3>
 
<div class="postbox" style="float:left;width:400px;padding:10px 0">
     <h3 style="padding:5px 10px;"><?php _e("Images Source", 'vslider'); ?> </h3>
     <div style="padding:10px;">
         <p><?php _e("Enable Responsive", 'vslider'); ?>:
              <input type="checkbox" name="responsive" value="1" <?php if($vslider->responsive){ echo "checked=CHECKED"; } ?> /><small> * responsive slider takes the size of the container.</small>
         </p>
         <p>
              <?php _e("Enable Auto-Resizing", 'vslider'); ?>: <input type="checkbox" name="tt" value="1" <?php if($vslider->tt){ echo "checked=CHECKED"; } ?> />
              &nbsp;&nbsp;<?php _e("Image Quality", 'vslider'); ?>:<select name="quality">
                <option value="40" <?php selected('40', $vslider->quality); ?>>40%</option>
                <option value="50" <?php selected('50', $vslider->quality); ?>>50%</option>
                <option value="60" <?php selected('60', $vslider->quality); ?>>60%</option>
                <option value="70" <?php selected('70', $vslider->quality); ?>>70%</option>
                <option value="80" <?php selected('80', $vslider->quality); ?>>80%</option>
                <option value="90" <?php selected('90', $vslider->quality); ?>>90%</option>
                <option value="100" <?php selected('100', $vslider->quality); ?>>100%</option>
                </select>
              <small><br />* Auto-Resize works only for uploaded images.</small>
                </p> 
            <p><?php _e("Image width", 'vslider'); ?>:
            <input type="text" name="width" value="<?php echo $vslider->width; ?>" size="3" />px&nbsp;&nbsp;
            <?php _e("Height", 'vslider'); ?>:<input type="text" name="height" value="<?php echo $vslider->height; ?>" size="3" />px
            <small><br />* Image Width/Height only works with Auto-Resize</small>
            </p>
     <p><?php _e(" Image Source", 'vslider'); ?>?&nbsp;
          <select name="imgsrc">
              <option value="custom" <?php selected('custom', $vslider->imgsrc); ?>>Custom</option>
              <option value="category" <?php selected('category', $vslider->imgsrc); ?>>Category</option>
          </select>&nbsp;				
           <small><?php _e("Open image links in new window:", 'vslider'); ?></small>&nbsp;<input type="checkbox" name="target" value="_blank" <?php if($vslider->target === '_blank'){ echo 'CHECKED';}; ?> />
         </p>  
           <p> <?php _e("Category:", 'vslider'); ?>
                <?php wp_dropdown_categories(array('selected' => $vslider->imgCat, 'name' => 'imgCat', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'vslider'), 'hide_empty' => '0' )); ?>
                
               </p>
               <p><?php _e("Grab Post Image:", 'vslider'); ?>&nbsp;&nbsp;
                <select name="imgcap">
                    <option value="featured" <?php selected('featured', $vslider->imgcap); ?>>Featured</option>
                    <option value="first" <?php selected('first', $vslider->imgcap); ?>>First</option>
                </select>
                </p>
                <p><?php _e("Number of Slides", 'vslider'); ?>:
                <select name="num">
                <?php for($s=1; $s<51; $s++){ ?>
                    <option value="<?php echo $s; ?>" <?php selected($s, $vslider->num); ?>><?php echo $s; ?></option>
                <?php } ?>
                </select>
                </p>
                <p>
                <?php _e("Display post excerpt", 'vslider'); ?>?&nbsp;
                
                <select name="excerpt">
                    <option value="no" <?php selected('no', $vslider->excerpt); ?>>Don't Show</option>
                    <option value="vibe_excerpt" <?php selected('vibe_excerpt', $vslider->excerpt); ?>>vSlider Custom Excerpt</option>
                    <option value="custom" <?php selected('custom', $vslider->excerpt); ?>>Custom Field</option>
                </select>
                </p>
                <p>&nbsp;
                <?php _e("vSlider Custom excerpt chars", 'vslider'); ?>:
                <input type="text" name="chars" class="regular-text" value="<?php echo $vslider->chars; ?>" size="3" />
                </p>
                </div>
                <center>
                <input type="submit" name="save_images" style="padding:5px 10px;" class="button-primary" value="<?php _e('Save Settings') ?>" />
                </center>
                </div>

    <?php $slides = $vslider->num + 1; ?>
    <?php for($x=1; $x<$slides; $x++){ ?>
 <div style="float:right;width:400px">
		<div class="postbox" >
		<h3 style="padding:5px 10px;">
                    <?php _e("Custom Image", 'vslider'); ?> 
                        <?php echo $x; ?>
                    <div class="click" id="<?php echo $x; ?>" style="float:right;cursor:pointer;">
                        <?php _e("(+/-)", 'vslider'); ?>
                    </div>
                </h3>
		<div class="inside" id="box<?php echo $x; ?>" style="padding: 10px;display:none;">
                <p>
                    <?php _e("Image URL", 'vslider'); ?>: 
                    <small style="float:right;">
                    <?php _e("upload", 'vslider'); ?>
                    </small>
                <br />
                <input id="slide<?php echo $x; ?>" class="regular-text" type="text" name="slide<?php echo $x; ?>" value="<?php echo $vslider->images['slide'.$x.''] ?>" size="40" />
                <a href="media-upload.php?type=image&amp;TB_iframe=true" class="thickbox" onclick="current_image='slide<?php echo $x; ?>';">
                <img src='images/media-button-image.gif' alt='Add an Image' /></a><br />
                <?php _e("Image Thumb [If enabled in settings]", 'vslider'); ?>:<br />
                <input id="thumb<?php echo $x; ?>" class="regular-text" type="text" name="thumb<?php echo $x; ?>" value="<?php echo $vslider->thumbs['thumb'.$x] ?>" size="40" />
                <a href="media-upload.php?type=image&amp;TB_iframe=true" class="thickbox" onclick="current_image='thumb<?php echo $x; ?>';">
                <img src='images/media-button-image.gif' alt='Add an Image' /></a>
                <small>* If Thumbnails enabled in settings, then it will auto-pick Thumbs of slides </small>
                <br />
                <?php _e("Image links to", 'vslider'); ?>:<br />
                <input type="text" name="link<?php echo $x; ?>" class="regular-text" value="<?php echo $vslider->links['link'.$x.''] ?>" size="40" /><br />
                <?php _e("Description text", 'vslider'); ?>: [* can also use html]<br />
                <textarea name="desc<?php echo $x; ?>" cols=40 rows=3><?php echo $vslider->descs['desc'.$x.''] ?></textarea>
                </p>
                <p>
                <?php _e("Slide Effects", 'vslider'); ?>:<select name="transition<?php echo $x; ?>">
                <option value="" <?php selected('', $vslider->transition['transition'.$x]); ?>>Default</option>
                <option value="fade" <?php selected('fade', $vslider->transition['transition'.$x]); ?>>Fade</option>
                <option value="fold" <?php selected('fold', $vslider->transition['transition'.$x]); ?>>Fold</option>
                <option value="boxRandom" <?php selected('boxRandom', $vslider->transition['transition'.$x]); ?>>Random Boxes</option>
                 <option value="boxRain" <?php selected('boxRain', $vslider->transition['transition'.$x]); ?>>Raining Boxes</option>
                 <option value="boxRainReverse" <?php selected('boxRainReverse', $vslider->transition['transition'.$x]); ?>>Winding Boxes</option>
                 <option value="boxRainGrow" <?php selected('boxRainGrow', $vslider->transition['transition'.$x]); ?>>Growing Boxes</option>
                 <option value="boxRainGrowReverse" <?php selected('boxRainGrowReverse', $vslider->transition['transition'.$x]); ?>>Shrinking Boxes</option>
                <option value="sliceDownRight" <?php selected('sliceDownRight', $vslider->transition['transition'.$x]); ?>>Slice Down Right</option>
                <option value="sliceDownLeft" <?php selected('sliceDownLeft', $vslider->transition['transition'.$x]); ?>>Slice Down Left</option>
                <option value="sliceUpRight" <?php selected('sliceUpRight', $vslider->transition['transition'.$x]); ?>>Slice Up Right</option>
                <option value="sliceUpLeft" <?php selected('sliceUpLeft', $vslider->transition['transition'.$x]); ?>>Slice Up Left</option>
                <option value="sliceUpDown" <?php selected('sliceUpDown', $vslider->transition['transition'.$x]); ?>>Slice Up Down</option>
                <option value="sliceUpDownLeft" <?php selected('sliceUpDownLeft', $vslider->transition['transition'.$x]); ?>>Slice Up Down Left</option>
                </select>
                 <small>* Leave empty if you need to apply only setting effects</small>
                </p>
             
        	</div>
		</div>
	</div>
    <?php } ?>
<input type="hidden" name="vs_name" value="<?php echo $vslider->name; ?>" />     
<input type="hidden" name="action" value="update" />
</form>

<?php }

function edit_vslidertheme($theme)
{
       global $message; 
       echo $message; ?>
        <div class="wrap" style="width:820px;"">
        <div id="icon-options-general" class="icon32"><br /></div>
        <h2><?php _e("Edit vSlider Themes [ ".$theme->name." ]"); ?></h2>
        <form method="post">
            <?php 
            wp_nonce_field('update-images'); 
            ?>
        <h3><?php _e("Eiting Theme", 'vslider'); ?> <a href="?page=vslider" class="button" style="float:right;">Back to vSliders</a></h3>
        <div class="postbox" style="float:left;width:400px;margin:20px 0;padding:5px 0;">
            <h3 style="padding:5px 10px;"><?php _e("Theme settings", 'vslider'); ?> </h3>
            <div style="padding:10px;">
            
            
            <p><?php _e("Border Width", 'vslider'); ?>: <input type="text"  name="borderWidth" value="<?php echo $theme->borderWidth; ?>" size="3" />px &nbsp;&nbsp;
               <?php _e("Border Radius", 'vslider'); ?>: <input type="text"  name="borderRadius" value="<?php echo $theme->borderRadius; ?>" size="3" />px
            </p>
            <p><?php _e("Border Color", 'vslider'); ?>:<input id="borderColor" type="text" name="borderColor" value="<?php echo $theme->borderColor; ?>" size="8" />&nbsp;HEX
                &nbsp;&nbsp;<a href="#" class="tooltip"><span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/border.png' /> </span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/tooltip.png' /> </a>
            </p>
            <p>
              <?php _e("Caption Opacity", 'vslider'); ?>: <select name="opacity">
                <option value="40" <?php selected('40', $theme->opacity); ?>>0%</option>
                <option value="40" <?php selected('40', $theme->opacity); ?>>20%</option>
                <option value="40" <?php selected('40', $theme->opacity); ?>>40%</option>
                <option value="50" <?php selected('50', $theme->opacity); ?>>50%</option>
                <option value="60" <?php selected('60', $theme->opacity); ?>>60%</option>
                <option value="70" <?php selected('70', $theme->opacity); ?>>70%</option>
                <option value="80" <?php selected('80', $theme->opacity); ?>>80%</option>
                <option value="90" <?php selected('90', $theme->opacity); ?>>90%</option>
                <option value="100" <?php selected('100', $theme->opacity); ?>>100%</option>
                </select>
                </p> 
            <p><?php _e("Caption Text color", 'vslider'); ?>:<input id="textColor" type="text" name="textColor" value="<?php echo $theme->textColor; ?>" size="8" />&nbsp;HEX
            </p>
                <small><?php _e("Click on the text box to pick a color", 'vslider'); ?></small>
            <p><?php _e("Caption Background color", 'vslider'); ?>:<input id="bgColor" type="text" name="bgColor" value="<?php echo $theme->bgColor; ?>" size="8" />&nbsp;HEX
            </p>
                <small><?php _e("To select color click on Tick at the right bottom of the color panel", 'vslider'); ?></small>
                
			</div>
		</div>
	

	<div class="metabox-holder" style="width: 400px;float:right;">
       <div class="postbox">        
		<h3><?php _e("More vSlider Theme Setup", 'vslider'); ?> </h3>
			<div class="inside" style="padding: 10px;" >         
             <p><?php _e("Image Button Style", 'vslider'); ?>:<select name="navstyle" id="navstyle">
                <option value="none" <?php selected('none', $theme->navstyle); ?>>None</option>
                <option value="nav_small" <?php selected('nav_small', $theme->navstyle); ?>>Small Buttons</option>
                <option value="nav_style1" <?php selected('nav_style1', $theme->navstyle); ?>>Style 1</option>
                <option value="nav_style2" <?php selected('nav_style2', $theme->navstyle); ?>>Style 2</option>
                <option value="nav_style3" <?php selected('nav_style3', $theme->navstyle); ?>>Style 3</option>
                <option value="nav_style4" <?php selected('nav_style4', $theme->navstyle); ?>>Style 4</option>
                <option value="nav_style5" <?php selected('nav_style5', $theme->navstyle); ?>>Style 5</option>
                </select>
                &nbsp;&nbsp;<?php _e("Vertical Buttons", 'vslider'); ?>: 
                <input type="checkbox" name="vnav" value="1" <?php if($theme->vnav){ echo "checked=CHECKED"; } ?> />
                </p>
             <p><?php _e("Navigation Button Style", 'vslider'); ?>:<select name="arrstyle"  id="arrstyle">
                <option value="none" <?php selected('none', $theme->arrstyle); ?>>None</option>
                <option value="arr_style1" <?php selected('arr_style1', $theme->arrstyle); ?>>Style 1</option>
                <option value="arr_style2" <?php selected('arr_style2', $theme->arrstyle); ?>>Style 2</option>
                <option value="arr_style3" <?php selected('arr_style3', $theme->arrstyle); ?>>Style 3</option>
                </select>
                </p>
             <p>
                <?php _e("Image buttons placement", 'vslider'); ?>: 
                <input type="text" name="navplace" size="30" id="navplace"  value="<?php echo $theme->navplace; ?>"/>
                &nbsp;&nbsp;<a href="#" class="tooltip"><span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/btnplacement.png' /> </span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/tooltip.png' /></a>
                <br /><small>Order of Spacing(margin): TOPpx RIGHTpx BOTTOMpx LEFTpx</small>
                </p>  
                
              <p><?php _e("Slide Layout", 'vslider'); ?>:<select name="layout" id="layout">
                <option value="stripe-left" <?php selected('stripe-left', $theme->layout); ?>>Stripe Left</option>
                <option value="stripe-right" <?php selected('stripe-right', $theme->layout); ?>>Stripe Right</option>
                <option value="stripe-bottom" <?php selected('stripe-bottom', $theme->layout); ?>>Stripe Bottom</option>
                <option value="stripe-top" <?php selected('stripe-top', $theme->layout); ?>>Stripe Top</option>
                </select>
                &nbsp;&nbsp;<a href="#" class="tooltip"><span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/layout.png' /> </span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/tooltip.png' /> </a>
                </p> 
              <p>
                <?php _e("Container Margin", 'vslider'); ?>: 
                <input type="text" name="holdermar" size="30" id="holdermar"  value="<?php echo $theme->holdermar; ?>"/>
                &nbsp;&nbsp;<a href="#" class="tooltip"><span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/cntnerspcing.png' /> </span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/tooltip.png' /></a>
                <br /><small>Order of Spacing(margin): TOPpx RIGHTpx BOTTOMpx LEFTpx</small>
                </p> 
               <p>
                <?php _e("Container Float", 'vslider'); ?>: <select name="holderfloat" id="holderfloat">
                <option value="none" <?php selected('none', $theme->holderfloat); ?>>None</option>
                <option value="left" <?php selected('left', $theme->holderfloat); ?>>Left</option>
                <option value="right" <?php selected('right', $theme->holderfloat); ?>>Right</option>
                </select>
                &nbsp;&nbsp;<a href="#" class="tooltip"><span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/float.png' /> </span><img src='<?php echo WP_CONTENT_URL;?>/plugins/vslider/images/tooltip.png' /> </a>
                </p> 
                <p><center><input type="submit" class="button-primary" name="save_theme" value="<?php _e('Save Settings') ?>" /></center></p>
                
              </div>
              
        </div>  
   </div>
   <input type="hidden" name="vs_theme" value="<?php echo $theme->name; ?>" /> 
   </form>
   </div>
<?php
}


function edit_vslidersettings($setting)
{
    
    global $message; 
       echo $message; ?>
        <div class="wrap" style="width:820px;"">
        <div id="icon-options-general" class="icon32"><br /></div>
        <h2><?php _e("Edit Settings Page [ ".$setting->name." ]"); ?></h2>
        <form method="post">
            <?php 
            wp_nonce_field('update-setting'); 
            ?>
        <h3><?php _e("vSlider Settings", 'vslider'); ?> <a href="?page=vslider" class="button" style="float:right;">Back to vSliders</a></h3>
        <div class="postbox" style="float:left;width:400px;padding:10px 0">
            <h3 style="padding:5px 10px;"><?php _e("vSlider settings", 'vslider'); ?> </h3>
            <div style="padding:10px;">
            <p><?php _e("vSlider Effects", 'vslider'); ?>:<select name="effect">
                <option value="random" <?php selected('random', $setting->effect); ?>>Random</option>
                <option value="fade" <?php selected('fade', $setting->effect); ?>>Fade</option>
                <option value="fold" <?php selected('fold', $setting->effect); ?>>Fold</option>
                <option value="boxRandom" <?php selected('boxRandom', $setting->effect); ?>>Random Boxes</option>
                 <option value="boxRain" <?php selected('boxRain', $setting->effect); ?>>Raining Boxes</option>
                 <option value="boxRainReverse" <?php selected('boxRainReverse', $setting->effect); ?>>Winding Boxes</option>
                 <option value="boxRainGrow" <?php selected('boxRainGrow', $setting->effect); ?>>Growing Boxes</option>
                 <option value="boxRainGrowReverse" <?php selected('boxRainGrowReverse', $setting->effect); ?>>Shrinking Boxes</option>
                <option value="sliceDownRight" <?php selected('sliceDownRight', $setting->effect); ?>>Slice Down Right</option>
                <option value="sliceDownLeft" <?php selected('sliceDownLeft', $setting->effect); ?>>Slice Down Left</option>
                <option value="sliceUpRight" <?php selected('sliceUpRight', $setting->effect); ?>>Slice Up Right</option>
                <option value="sliceUpLeft" <?php selected('sliceUpLeft', $setting->effect); ?>>Slice Up Left</option>
                <option value="sliceUpDown" <?php selected('sliceUpDown', $setting->effect); ?>>Slice Up Down</option>
                <option value="sliceUpDownLeft" <?php selected('sliceUpDownLeft', $setting->effect); ?>>Slice Up Down Left</option>
                </select>
            </p>
            <p><?php _e("Effect Slices", 'vslider'); ?>:
                <select name="slices">
                   <?php for($s=1; $s<20; $s++){ ?>
                    <option value="<?php echo $s; ?>" <?php selected($s, $setting->slices); ?>><?php echo $s; ?></option>
                <?php } ?>
                </select>    
            </p>
            <p><?php _e("Boxes/Squares per Column", 'vslider'); ?>:
                <select name="boxCols">
                   <?php for($s=1; $s<20; $s++){ ?>
                    <option value="<?php echo $s; ?>" <?php selected($s, $setting->boxCols); ?>><?php echo $s; ?></option>
                <?php } ?>
                </select>    
            </p>
            <p><?php _e("Boxes/Squares per Row", 'vslider'); ?>:
                <select name="boxRows">
                   <?php for($s=1; $s<20; $s++){ ?>
                    <option value="<?php echo $s; ?>" <?php selected($s, $setting->boxRows); ?>><?php echo $s; ?></option>
                <?php } ?>
                </select>    
            </p>
            <p><?php _e("Speed of Animation/Effects", 'vslider'); ?>:
                <select name="animSpeed">
                   <?php for($s=300; $s<2200; $s=$s+200){ ?>
                    <option value="<?php echo $s; ?>" <?php selected($s, $setting->animSpeed); ?>><?php echo $s; ?></option>
                <?php } ?>
                </select>    
            </p>
            <p><?php _e("Pause time at every slide", 'vslider'); ?>:
                <select name="pauseTime">
                   <?php for($s=1000; $s<5000; $s=$s+1000){ ?>
                    <option value="<?php echo $s; ?>" <?php selected($s, $setting->pauseTime); ?>><?php echo $s; ?></option>
                <?php } ?>
                </select>    
            </p>
            <p><?php _e("Starting Slide", 'vslider'); ?>:
                <input name="startSlide" class="regular-text" value="<?php echo $setting->startSlide; ?>" />       
            </p>
            </div>
        </div>
         <div class="postbox" style="float:right;width:400px;padding:10px 0">
             <h3 style="padding:5px 10px;"><?php _e("Settings II", 'vslider'); ?> </h3>
            <div style="padding:0 10px;">
            <p><?php _e("Show Direction Navigation", 'vslider'); ?>:
            
            <select name="directionNav">
                               <option value="1" <?php selected(1, $setting->directionNav); ?>>Yes</option>
                               <option value="0" <?php selected(0, $setting->directionNav); ?>>No</option>
                           </select>       
                       </p>
                       <p><?php _e("Show Direction Navigation on Hover only", 'vslider'); ?>:
                           <select name="directionNavHide">
                               <option value="1" <?php selected(1, $setting->directionNavHide); ?>>Yes</option>
                               <option value="0" <?php selected(0, $setting->directionNavHide); ?>>No</option>
                           </select>       
                       </p>
                       <p><?php _e("Show Control Navigation", 'vslider'); ?>:
                           <select name="controlNav">
                               <option value="1" <?php selected(1, $setting->controlNav); ?>>Yes</option>
                               <option value="0" <?php selected(0, $setting->controlNav); ?>>No</option>
                           </select>      
                       </p>
                       <p><?php _e("Show Thumbnails for Control Navigation", 'vslider'); ?>:
                           <select name="controlNavThumbs">
                               <option value="1" <?php selected(1, $setting->controlNavThumbs); ?>>Yes</option>
                               <option value="0" <?php selected(0, $setting->controlNavThumbs); ?>>No</option>
                           </select>     
                       </p>
                       <p><?php _e("Pause vSlider on Mouse Hover", 'vslider'); ?>:
                           <select name="pauseOnHover">
                               <option value="1" <?php selected(1, $setting->pauseOnHover); ?>>Yes</option>
                               <option value="0" <?php selected(0, $setting->pauseOnHover); ?>>No</option>
                           </select>       
                       </p>
                       <p><?php _e("Manual Advance vSlider", 'vslider'); ?>:
                           <select name="manualAdvance">
                               <option value="1" <?php selected(1, $setting->manualAdvance); ?>>Yes</option>
                               <option value="0" <?php selected(0, $setting->manualAdvance); ?>>No</option>
                           </select>  
               </p>
            <p><?php _e("Previous button Text", 'vslider'); ?>:
                <input name="prevText" class="regular-text" value="<?php echo $setting->prevText; ?>" />       
            </p>
            <p><?php _e("Next button Text", 'vslider'); ?>:
                <input name="nextText" class="regular-text" value="<?php echo $setting->nextText; ?>" />       
            </p>
            <p><?php _e("Randomize image sequence", 'vslider'); ?>:
                <select name="randomStart">
                    <option value="true" <?php selected(true, $setting->randomStart); ?>>Yes</option>
                    <option value="false" <?php selected(false, $setting->randomStart); ?>>No</option>
                </select>       
            </p>
             <p><center><input type="submit" class="button-primary" name="save_setting" value="<?php _e('Save Settings') ?>" /></center></p>
               
   <input type="hidden" name="vs_setting" value="<?php echo $setting->name; ?>" /> 
   </form>
   </div>
         </div>
<?php
}
?>
