<?php

/**
 * FILE: functions.php 
 * Created on Feb 1, 2013 at 1:42:38 PM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider 5.0
 * License: GPLv2
 */


add_action('wp_ajax_vslider_admin', 'vslider_admin_callback');

function vslider_admin_callback() {
        $name = $_POST['name'];
        vslider_settings($name);
        die(); // this is required to return a proper result
}

add_action('wp_ajax_vslider_images', 'vslider_images_callback');

function vslider_images_callback() {
        $name = $_POST['name'];
        $vs = new vSlider;
        $vs = get_option($name);  
    ?>
       <tr class="image_attribute tr_imgsrc">
	 <th>
             <label for="vsliders"><?php _e('Select Image source','vslider'); ?></label></th>
	 <td>
	     <select name="imgsrc" id="imgsrc">
                 <option value="custom" <?php selected('custom', $vslider['imgsrc']); ?>>Custom Images</option>
                 <option value="generate" <?php selected('generate', $vslider['imgsrc']); ?>>Generate Images</option>
	     <span class="description"> <?php _e('* Generate/Create Slides for Slider.','vslider'); ?></span>
	 </td>
	</tr> 
         <tr  class="image_attribute">
            <td>
                <center><h2>Live Preview</h2></center>
                    <?php
                      global $vslider_script;
                      $id='vslider'.rand(1,999);
                      echo $vs->vslider($id); 
                      $vslider_script .=$vs->vslider_script($id);
                      
                    ?>   
            </td>
            <td class="theme_controls">
                <h2> Select Theme </h2>
                <ul>
                    <li>
                        <label> vSlider Theme :</label>
                        <select name="theme" id="vslider_theme">
                            <option value="default" <?php selected($vs->theme['theme'],'default'); ?>>Default</option>
                            <option value="minimal" <?php selected($vs->theme['theme'],'minimal'); ?>>Minimal</option>
                            <option value="classic" <?php selected($vs->theme['theme'],'classic'); ?>>Classic</option>
                            <option value="creative" <?php selected($vs->theme['theme'],'creative'); ?>>Creative</option>
                            <option value="elegant" <?php selected($vs->theme['theme'],'elegant'); ?>>Elegant</option>
                        </select>
                    </li>
                    <li>
                        <label> Caption Style :</label>
                        <select name="caption" id="caption_style">
                            <option value="default" <?php selected($vs->theme['caption'],'default'); ?>>Default</option>
                            <option value="left" <?php selected($vs->theme['caption'],'left'); ?>>Left</option>
                            <option value="right" <?php selected($vs->theme['caption'],'right'); ?>>Right</option>
                            <option value="top" <?php selected($vs->theme['caption'],'top'); ?>>Top</option>
                            <option value="lefttop" <?php selected($vs->theme['caption'],'lefttop'); ?>>Left Top</option>
                            <option value="leftbottom" <?php selected($vs->theme['caption'],'leftbottom'); ?>>Left Bottom</option>
                            <option value="righttop" <?php selected($vs->theme['caption'],'righttop'); ?>>Right Top</option>
                            <option value="rightbottom" <?php selected($vs->theme['caption'],'rightbottom'); ?>>Right Bottom</option>
                        </select>
                    </li>
                    <li>
                        <label> Control Button :</label>
                        <select name="control_nav" id="control_nav">
                            <option value="default"  <?php selected($vs->theme['control_nav'],'default'); ?>>Default</option>
                            <option value="minimal" <?php selected($vs->theme['control_nav'],'minimal'); ?>>Minimal</option>
                            <option value="classic" <?php selected($vs->theme['control_nav'],'classic'); ?>>Classic</option>
                            <option value="creative" <?php selected($vs->theme['control_nav'],'creative'); ?>>Creative</option>
                            <option value="elegant" <?php selected($vs->theme['control_nav'],'elegant'); ?>>Elegant</option>
                        </select>
                    </li>
                    <li>
                        <label> Direction Arrows :</label>
                        <select name="direction_nav" id="direction_nav">
                             <option value="default"  <?php selected($vs->theme['direction_nav'],'default'); ?>>Default</option>
                            <option value="minimal" <?php selected($vs->theme['direction_nav'],'minimal'); ?>>Minimal</option>
                            <option value="classic" <?php selected($vs->theme['direction_nav'],'classic'); ?>>Classic</option>
                            <option value="creative" <?php selected($vs->theme['direction_nav'],'creative'); ?>>Creative</option>
                            <option value="elegant" <?php selected($vs->theme['direction_nav'],'elegant'); ?>>Elegant</option>
                        </select>
                    </li>
                    <li>
                        <label> Shadow :</label>
                        <select name="shadow" id="shadow_style">
                            <option value="" <?php selected($vs->theme['shadow'],''); ?>>None</option>
                            <option value="hover" <?php selected($vs->theme['shadow'],'hover'); ?>>Hover</option>
                            <option value="perspective" <?php selected($vs->theme['shadow'],'perspective'); ?>>Perspective</option>
                            <option value="corner" <?php selected($vs->theme['shadow'],'corner'); ?>>Corner</option>
                            <option value="center" <?php selected($vs->theme['shadow'],'center'); ?>>Center</option>
                        </select>
                    </li>
                    <li>
                        <label> Custom Class/CSS Style :</label>
                        <textarea name="custom_css" class="large-text" rows="5"><?php echo stripslashes($vs->theme['custom_css']); ?></textarea>
                        <small>* Applies to the Slider Container. To give Custom style, start with: <strong>" style="..write your CSS here"</strong></small>
                        </p>
                    </li>
                </ul>
            </td>
         </tr> 
         <tr  class="image_attribute generate_slides">
             <td align="center"> <h2>Slides/Image </h2></td>
             <td align="center" valign="middle"> 
                 <input type="submit" class="button button-primary button-hero" name="save_vslider_images" value="Save & Preview" />&nbsp;&nbsp;&nbsp;&nbsp;
                 <a class="button button-hero" id="add-slide">Add Slide</a>
             </td>
         </tr> 
         <tr class="image_attribute">
            <td colspan="2"> 
             <table class="vslider_slide_arrange">
                 <tbody>
                <tr id="default_slide"  data-num="0" style="display:none">
                <td class="image_controls">
                    <a class="handle"></a>
                    <a class="delete_slide"></a>
                    <ul>
                        <li>
                            <label><h3>Slide Number</h3></label>
                            <input type="text" class="slide_num small-text" value="1" />
                        </li>
                        <li>
                            <label>Image Path <small>* Select from media library</small></label>
                            <input type="text" class="image_path" value="Image Path..." /> <a class="button-primary upload_image_button" data-num="1">Upload</a> 
                        </li>
                        <li>
                            <label> Links to URL</label>
                            <input type="text" class="link" value="" />
                        </li>
                        <li>
                            <label> Connect with LightBox </label>
                            <input type="checkbox" class="lightbox" value="1" />
                        </li>
                    </ul>    
                </td>
                <td>
                    <label >Caption Title</label> <p><input type="text" class="caption_title large-text" value="Enter Title for Caption here..." /></p>
                    <label>Caption Description</label> <p><textarea class="captions_desc large-text" rows="3">Write you caption Description herer..</textarea></p>
                </td>
                </tr> 
                <?php
                $num=0;
                 foreach($vs->images as $image){$num++;
                     ?>
                <tr id="<?php echo 'slide'.$num; ?>"  data-num="<?php echo $num; ?>" class="vslider_slides">
                <td class="image_controls">
                    <a class="handle"></a>
                    <a class="delete_slide"></a>
                    <ul>
                        <li>
                            <label><h3>Slide Number</h3></label>
                            <input type="text" class="slide_num small-text" name="<?php echo $num; ?>" value="<?php echo $num; ?>" />
                        </li>
                        <li>
                            <label>Image Path <small>* Select from media library</small></label>
                            <input type="text" class="image_path" name="<?php echo 'images['.$num.'][src]'; ?>" id="<?php echo 'image_path'.$num; ?>" value="<?php echo $image['src']; ?>" /> <a class="button-primary upload_image_button" data-num="<?php echo $num; ?>">Upload</a> 
                        </li>
                        <li>
                            <label> Links to URL</label>
                            <input type="text" class="link" name="<?php echo 'images['.$num.'][link]'; ?>" id="<?php echo 'link'.$num; ?>" value="<?php echo $image['link']; ?>" />
                        </li>
                        <li>
                            <label> Connect with LightBox </label>
                            <input type="checkbox" class="lightbox" name="<?php echo 'images['.$num.'][lightbox]'; ?>" id="<?php echo 'lightbox'.$num; ?>" value="1" <?php checked( $image['lightbox'], 1 ); ?> />
                        </li>
                    </ul>    
                </td>
                <td>
                    <label >Caption Title</label> <p><input type="text" class="caption_title large-text" name="<?php echo 'images['.$num.'][heading]'; ?>" id="<?php echo 'caption_title'.$num; ?>" value="<?php echo stripslashes($image['heading']); ?>" /></p>
                    <label>Caption Description</label> <p><textarea class="captions_desc large-text" rows="3" name="<?php echo 'images['.$num.'][description]'; ?>" id="<?php echo 'caption_desc'.$num; ?>"><?php echo stripslashes($image['description']); ?></textarea></p>
                </td>
                </tr>
                <?php
                 }
                ?>
                 </tbody>
             </table>
            </td>   
          </tr>
        <?php
}


add_action('wp_ajax_vslider_generate_images', 'vslider_generate_images_callback');

function vslider_generate_images_callback() {
        ?>
          <tr class="image_attribute generate_imgsrc">
	 <th>
             <label><?php _e('Number of Images','vslider'); ?></label></th>
	 <td>
	     <input type="text" id="image_num" value="" class="small-text" />
	     <span class="description"> <?php _e('* Number of images/slides in the slider.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="image_attribute generate_imgsrc">
	 <th>
             <label><?php _e('Select Post Type','vslider'); ?></label></th>
	 <td>
	     <select id="posttype">
                 <?php
                 $post_types=get_post_types('','names'); 
                    foreach ($post_types as $posttype ) {
                    echo '<option value="'.$posttype.'">'.$posttype.'</option>';
                    }
                 ?>
             </select>
	     <span class="description"> <?php _e('* Select a Post Type eg: Posts, Pages....','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="image_attribute generate_imgsrc">
	 <th>
             <label><?php _e('Select Taxonomy','vslider'); ?></label></th>
	 <td>
	     <select id="taxonomy">
                 <option value=''>All</option>
                 <?php
                 $taxonomies=get_taxonomies('','names'); 
                    foreach ($taxonomies as $taxonomy ) {
                        if($taxonomy =='category'){$taxonomy='category_name';}
                     echo '<option value="'.$taxonomy.'">'.$taxonomy.'</option>';
                    }
                 ?>
             </select>
	     <span class="description"> <?php _e('* Select a Taxonomy eg: Categories, Tags.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="image_attribute generate_imgsrc">
	 <th>
             <label><?php _e('Select Taxonomy Term ','vslider'); ?></label></th>
	 <td>
	     <select id="taxonomy_term">
                 <option value=''>All</option>
                 <?php
                 $tax_terms=getall_taxonomy_terms(); 
                    foreach ($tax_terms as $term ) {
                     echo '<option value="'.$term.'">'.$term.'</option>';
                    }
                 ?>
             </select>
	     <span class="description"> <?php _e('* Select correct taxonomy term value.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="image_attribute generate_imgsrc">
	 <th>
             <label><?php _e('Select Type','vslider'); ?></label></th>
	 <td>
	     <select id="selecttype">
                 <option value="recent">Recent</option>
                 <option value="popular">Popular</option>
             </select>
	     <span class="description"> <?php _e('* Select type ','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="image_attribute generate_imgsrc">
	 <th>
             <label><?php _e('OR Enter distinct Post Ids (comma separated)','vslider'); ?></label></th>
	 <td>
	     <input type="text" id="postids" value="" />
	     <span class="description"> <?php _e('* PostIds should belong to correct Post Type.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="image_attribute generate_imgsrc">
	 <td colspan="2" align="center">
             <a class="button button-primary" id="generate_slides"><?php _e('Generate Images/Slides','vslider'); ?></a></td>
	</tr>
        <?php
        die(); // this is required to return a proper result
}

function vslider_settings($name){
    $vs = new vSlider;
    $vs = get_option($name);
    $vslider = $vs->settings;
    //Create a vSlider object and pass values from option to object
    ?>
      <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('Animation','vslider'); ?></label></th>
	 <td>
	     <select name="animation">
                 <option value='"fade"' <?php selected('"fade"', $vslider['animation']); ?>><?php _e('Fade','vslider'); ?></option>
                 <option value='"slide"' <?php selected('"slide"', $vslider['animation']); ?>><?php _e('Slide','vslider'); ?></option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
      <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('Direction','vslider'); ?></label></th>
	 <td>
	     <select name="direction">
                 <option value='"horizontal"' <?php selected('"horizontal"', $vslider['direction']); ?>><?php _e('Horizontal','vslider'); ?></option>
                 <option value='"vertical"' <?php selected('"vertical"', $vslider['direction']); ?>><?php _e('Vertical','vslider'); ?></option>
             </select>
	     <span class="description"> <?php _e('* For Slide animation only','vslider'); ?></span>
	 </td>
     </tr>
     <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('Animation Loop','vslider'); ?></label></th>
	 <td>
	     <select name="animationLoop">
                 <option value="true" <?php selected('true', $vslider['animationLoop']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['animationLoop']); ?>>No</option></select>
	     <span class="description"> <?php _e('* Loop back animation when complete.','vslider'); ?></span>
	 </td>
	</tr>
     <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('SlideShow ','vslider'); ?></label></th>
	 <td>
	     <select name="slideshow">
                 <option value="true" <?php selected('true', $vslider['slideshow']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['slideshow']); ?>>No</option>
             </select>
	     <span class="description"> <?php _e('* Auto Start slider on load.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('SlideShow Speed','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="slideshowSpeed" value="<?php echo $vslider['slideshowSpeed']; ?>" />
	     <span class="description"> <?php _e('* Delay between slides in ms.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('Animation Speed','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="animationSpeed" value="<?php echo $vslider['animationSpeed']; ?>" />
	     <span class="description"> <?php _e('* Animation duration.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('Enable Control Navigation','vslider'); ?></label></th>
	 <td>
	     <select name="controlNav">
                 <option value="true" <?php selected('true', $vslider['controlNav']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['controlNav']); ?>>No</option>
	     <span class="description"> <?php _e('* Enable Slider Slide buttons.','vslider'); ?></span>
	 </td>
	</tr>
        <tr class="vslider_attribute">
	 <th>
             <label for="vsliders"><?php _e('Enable Direction Navigation','vslider'); ?></label></th>
	 <td>
	     <select name="directionNav">
             <option value="true" <?php selected('true', $vslider['directionNav']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['directionNav']); ?>>No</option>
             </select>
	     <span class="description"> <?php _e('* Enable Direction Arrows for slide changing.','vslider'); ?></span>
	 </td>
	</tr>   
        <tr class="vslider_attribute">
            <td colspan="2" align="center" ><input type="submit" name="save_vslider_settings" value="Save Settings" class="button button-primary button-hero" style="margin:20px;" /></td>
        </tr>
     <?php
}


function global_settings(){
     if(isset($_POST['save_global_settings']))
       $vslider= save_vslider_global_settings();
    else
       $vslider= get_vslider_global_settings();

       ?>
        <form method="post" action="<?php echo vslider_admin_url( 'admin.php').'?page=vslider&tab=global-settings'; ?>">
    <?php wp_nonce_field('get_vslider_settings'); ?>
    <table class="wp-list-table widefat fixed">
       <tr>
	 <th>
             <label for="vsliders"><?php _e('Default Animation','vslider'); ?></label></th>
	 <td>
	     <select name="animation">
                 <option value="fade" <?php selected('fade', $vslider['animation']); ?>><?php _e('Fade','vslider'); ?></option>
                 <option value="slide" <?php selected('fade', $vslider['animation']); ?>><?php _e('Slide','vslider'); ?></option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Direction','vslider'); ?></label></th>
	 <td>
	     <select name="direction">
                 <option value="horizontal" <?php selected('horizontal', $vslider['direction']); ?>><?php _e('Horizontal','vslider'); ?></option>
                 <option value="vertical" <?php selected('vertical', $vslider['direction']); ?>><?php _e('Vertical','vslider'); ?></option>
             </select>
	     <span class="description"> <?php _e('* For Slide animation only','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Reverse Animation','vslider'); ?></label></th>
	 <td>
	     <select name="reverse">
                 <option value="true" <?php selected('true', $vslider['reverse']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['reverse']); ?>>No</option></select>
	     <span class="description"> <?php _e('* Slide Back/Down if previous button is clicked.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Animation Loop','vslider'); ?></label></th>
	 <td>
	     <select name="animationLoop">
                 <option value="true" <?php selected('true', $vslider['animationLoop']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['animationLoop']); ?>>No</option></select>
	     <span class="description"> <?php _e('* Loop back animation when complete.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Default Start from Slide','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="startAt" value="<?php echo $vslider['startAt']; ?>" />
	     <span class="description"> <?php _e('* Start from Slide 0.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('SlideShow ','vslider'); ?></label></th>
	 <td>
	     <select name="slideshow">
                 <option value="true" <?php selected('true', $vslider['slideshow']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['slideshow']); ?>>No</option>
             </select>
	     <span class="description"> <?php _e('* Auto Start slider on load.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('SlideShow Speed','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="slideshowSpeed" value="<?php echo $vslider['slideshowSpeed']; ?>" />
	     <span class="description"> <?php _e('* Delay between slides in ms.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Animation Speed','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="animationSpeed" value="<?php echo $vslider['animationSpeed']; ?>" />
	     <span class="description"> <?php _e('* Animation duration.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Initial Delay','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="initDelay" value="<?php echo $vslider['initDelay']; ?>" />
	     <span class="description"> <?php _e('* Initial Delay in Slider Start.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Randomise Slides','vslider'); ?></label></th>
	 <td>
	     <select name="reverse">
                 <option value="true" <?php selected('true', $vslider['reverse']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['reverse']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Pause Slides on Action','vslider'); ?></label></th>
	 <td>
	     <select name="pauseOnAction">
                 <option value="true" <?php selected('true', $vslider['pauseOnAction']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['pauseOnAction']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Pause Slides on Hover','vslider'); ?></label></th>
	 <td>
	     <select name="pauseOnHover">
                 <option value="true" <?php selected('true', $vslider['pauseOnHover']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['pauseOnHover']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Touch Support','vslider'); ?></label></th>
	 <td>
	     <select name="touch">
                <option value="true" <?php selected('true', $vslider['touch']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['touch']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Video Support','vslider'); ?></label></th>
	 <td>
	     <select name="video">
                 <option value="true" <?php selected('video', $vslider['video']); ?>>Yes</option>
                 <option value="false" <?php selected('video', $vslider['video']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Control Navigation','vslider'); ?></label></th>
	 <td>
	     <select name="controlNav">
                 <option value="true" <?php selected('true', $vslider['controlNav']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['controlNav']); ?>>No</option>
	     <span class="description"> <?php _e('* Enable Slider Slide buttons.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Direction Navigation','vslider'); ?></label></th>
	 <td>
	     <select name="directionNav">
             <option value="true" <?php selected('true', $vslider['directionNav']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['directionNav']); ?>>No</option>
             </select>
	     <span class="description"> <?php _e('* Enable Direction Arrows for slide changing.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Text for Previous direction arrow','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="prevText" value='<?php echo $vslider['prevText']; ?>' />
	     <span class="description"> <?php _e('* Previous Slide Text.','vslider'); ?></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Text for Next direction arrow','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="nextText" value='<?php echo $vslider['nextText']; ?>' />
	     <span class="description"> <?php _e('* Next Slide Text.','vslider'); ?></span>
	 </td>
	</tr>
        
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Keyboard Support','vslider'); ?></label></th>
	 <td>
	     <select name="keyboard">
             <option value="true" <?php selected('true', $vslider['keyboard']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['keyboard']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Multiple Keyboard Support','vslider'); ?></label></th>
	 <td>
	     <select name="multipleKeyboard">
                 <option value="true" <?php selected('true', $vslider['multipleKeyboard']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['multipleKeyboard']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
         <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Mouse Wheel Support','vslider'); ?></label></th>
	 <td>
	     <select name="mousewheel">
                <option value="true" <?php selected('true', $vslider['mousewheel']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['mousewheel']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
         <tr>
	 <th>
             <label for="vsliders"><?php _e('Enable Pause and Play Support','vslider'); ?></label></th>
	 <td>
	     <select name="pausePlay">
                 <option value="true" <?php selected('true', $vslider['pausePlay']); ?>>Yes</option>
                 <option value="false" <?php selected('false', $vslider['pausePlay']); ?>>No</option>
             </select>
	     <span class="description"></span>
	 </td>
	</tr>
         <tr>
	 <th>
             <label for="vsliders"><?php _e('Pause Text','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="pauseText" value='<?php echo $vslider['pauseText']; ?>' />
	     <span class="description"></span>
	 </td>
	</tr>
         <tr>
	 <th>
             <label for="vsliders"><?php _e('Play Text','vslider'); ?></label></th>
	 <td>
	     <input type="text" name="playText" value='<?php echo $vslider['playText']; ?>' class="text" />
	     <span class="description"></span>
	 </td>
	</tr>
        <tr>
            <td colspan="2" align="center" ><input type="submit" name="save_global_settings" value="Save Settings" class="button button-primary button-hero" style="margin:20px;" /></td>
        </tr>
    
    </table>
        </form>        
     <?php
    }
    
    
function get_vslider_global_settings(){

    $vslider_global_settings=get_option('vslider_global_settings');
    
    if(!isset($vslider_global_settings)){
        global $global_settings;
        add_option('vslider_global_settings',$global_settings);
    }  
    
    return $vslider_global_settings;
} 

function save_vslider_global_settings(){
    $global_settings=get_option('vslider_global_settings');
    
    if(isset($_POST['save_global_settings'])){
        foreach($global_settings as $key=>$value){
            $global_settings[$key]= stripslashes($_POST[$key]);
        } 
        update_option('vslider_global_settings', $global_settings);
        echo "<div class='save'>Settings Saved</div>";
    }
    return $global_settings;
} 



add_action('wp_ajax_generate_slides', 'generate_slides');

function generate_slides(){
        
        $name=$_POST['name'];
        $num=$_POST['image_num'];
        $post_type=$_POST['posttype'];
        $taxonomy=$_POST['taxonomy'];
        $term=$_POST['taxonomy_term'];
        $postids=$_POST['postids'];
        $type=$_POST['type'];
        
        $check=get_option($name);
        if(empty($check)){
            echo "<div class='error'>vSlider not found !</div>";
        }else{
            if(!isset($postids) || empty($postids) || $postids=""){
             $args=array(
            'post_type' => $post_type,
            "$taxonomy" => $term,
            'post_status' => 'publish',
            'posts_per_page' => $num,
            );
             if($type=='popular'){
                 $args['orderby'] = $type;
             }
            }else{
                $post_ids=explode(',',$postids);
                $args=array( 
                    'post_type' => $post_type, 
                    'post__in' => $post_ids ); 
            }
             $the_query = new WP_Query( $args );
             // The Loop
             $i=1;
             while ( $the_query->have_posts() ) :
                    $the_query->the_post();
               
             $thumbnail_src=wp_get_attachment_image_src( get_post_thumbnail_id($the_query->post->ID), 'full' );
             if(is_array($thumbnail_src)){$thumbnail_src=$thumbnail_src[0];}
             
             echo '<tr id="slide'.$i.'" data-num="'.$i.'" class="vslider_slides">
                    <td class="image_controls">
                    <a class="handle"></a>
                    <a class="delete_slide"></a>
                    <ul>
                        <li>
                            <label><h3>Slide Number </h3></label>
                            <input type="text" class="slide_num small-text" name="'.$i.'" value="'.$i.'">
                        </li>
                        <li>
                            <label>Image Path <small>* Select from media library</small></label>
                            <input type="text" class="image_path" name="images['.$i.'][src]" id="image_path'.$i.'" value="'.$thumbnail_src.'"> <a class="button-primary upload_image_button" data-num="'.$i.'">Upload</a> 
                        </li>
                        <li>
                            <label> Links to URL</label>
                            <input type="text" class="link" name="images['.$i.'][link]" id="link'.$i.'" value="'.get_permalink($the_query->post->ID).'">
                        </li>
                        <li>
                            <label> Connect with LightBox </label>
                            <input type="checkbox" class="lightbox" name="images['.$i.'][lightbox]" id="lightbox'.$i.'" value="1">
                        </li>
                    </ul>    
                </td>
                <td>
                    <label>Caption Title</label> <p><input type="text" class="caption_title large-text" name="images['.$i.'][heading]" id="caption_title'.$i.'" value="'.get_the_title($the_query->post->ID).'"></p>
                    <label>Caption Description</label> <p><textarea class="captions_desc large-text" rows="3" name="images['.$i.'][description]" id="caption_desc'.$i.'">'.get_the_excerpt($the_query->post->ID).'</textarea></p>
                </td>
                </tr>';
             
                $i++;
                endwhile;

            wp_reset_postdata();
        }
      die(); 
    }

?>
