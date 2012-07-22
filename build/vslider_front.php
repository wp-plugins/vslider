<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// VSLIDER MAIN FUNCTION
function vslider($name='vslider_options')
{ 
    
    $vslider = new vslider;
    $vslider->name=$name;
    $vslider=$vslider->get_vslider($name);
    
    foreach ($vslider_data as $data) { 
        if($data->active == 1)
            {  
    ?>
    <div id="<?php echo $option.'container'; ?>">
    <?php
  echo '<div id="'.$option.'">';
  if($options['customImg'] == 'false') {
      if($options['randimg']){$randimg="orderby=rand&";}//Randomise Images
      $recent = new WP_Query($randimg."cat=".$options['imgCat']."&showposts=".$options['slideNr']); 
      while($recent->have_posts()) : $recent->the_post(); ?>
          <a href="<?php the_permalink(); ?>" target="<?php echo $options['target']; ?>">
          <?php 
          if($options['catchimage'] == 'featured'){ // CATCH THE FEATURED IMAGE OF THE POST
             if($options['timthumb'])    // get the src of the post thumbnail
            {    
                $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300 ), false, '' ); 
                $thumbnailSrc = $src[0]; 
                $img_url = WP_PLUGIN_URL.'/vslider/timthumb.php?src='.$thumbnailSrc.'&amp;w='.$options['width'].'&amp;h='.$options['height'].'&amp;zc=1&amp;q='.$options['quality'];
      
                ?>
                <img src="<?php echo $img_url; ?>" alt="" />
                <?php } else {
                              the_post_thumbnail ( array($options['width'], $options['height']) );
                              }
            }else if($options['catchimage'] == 'first'){
                  // CATCH THE FIRST IMAGE OF THE POST 
                    $iPostID = get_the_ID();
                    $content_post = get_post($iPostID);
                    $content = $content_post->post_content;
                    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$content, $matches);
                    $firstsrc = $matches [1] [0];
                    if($options['timthumb'])    // get the src of the post thumbnail
                    {  $image = str_replace(get_bloginfo('siteurl'), '', $firstsrc); 
                       $img_url = WP_PLUGIN_URL.'/vslider/timthumb.php?src='.urlencode($image).'&amp;w='.$options['width'].'&amp;h='.$options['height'].'&amp;zc=1&amp;q='.$options['quality'];
                       }else {$img_url= $firstsrc;}
                        ?>
                        <div style="background: url(<?php echo $img_url; ?>) no-repeat;<?php echo "width:".$options['width'].";height:".$options['height'].";"; ?>" alt="">
                        </div>
                        <?php                          
            }    
             if($options['excerpt'] == 'true') { ?>
              <span><h4><?php the_title(); ?></h4><?php vslider_limitpost($options['chars'], "" ); ?></span>
          <?php } ?>
          </a>
      <?php endwhile; //endwhile
  } else {
    //$slides = $options['slideNr'] + 1;
    $randx = range(1, $options['slideNr']);
    if($options['randimg']){        //RANDOMISING IMAGES
           shuffle($randx);
    }//Randomise Images
    
    foreach( $randx as $x){ ?>
       <a href="<?php echo $options['link'.$x.'']; ?>" style="background:#fff;" target="<?php echo $options['target']; ?>">
       <?php 
       if($options['timthumb']){
       $image = str_replace(get_bloginfo('siteurl'), '', $options['slide'.$x.'']); 
       $img_url =WP_PLUGIN_URL.'/vslider/timthumb.php?src='.urlencode($image).'&amp;w='.$options['width'].'&amp;h='.$options['height'].'&amp;zc=1&amp;q='.$options['quality'];
       }else{
        $img_url=$options['slide'.$x.''];
       }
       ?>
       <img src="<?php echo $img_url; ?>" style="width:<?php echo $options['width']; ?>px;height:<?php echo $options['height']; ?>px;" alt="<?php echo $options['heading'.$x.'']; ?>" />
         <?php if($options['heading'.$x.''] || $options['desc'.$x.'']) { ?>
           <span><h4><?php echo $options['heading'.$x.'']; ?></h4><?php echo $options['desc'.$x.'']; ?></span>
         <?php } ?>
       </a>
    <?php }
  }
  echo '</div></div>';
   }//ENDIF
  }//END-FOR
}//END FUNCTION VSLIDER


?>