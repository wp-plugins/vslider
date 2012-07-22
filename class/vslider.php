<?php

/* Credits: 
 * Author: Mr.Vibe
 * Website: www.VibeThemes.com
 * Version: 4.2
 */

class vslider
{
    var $version = '4.2';
    var $name = 'vslider_default';
    var $settings = 'vs_settings';
    var $themes = 'vs_theme';
    public $responsive=0;
    public $tt=true;
    public $quality=100;
    public $width=630;
    public $height=280;
    public $num= 3;
    public $target= '_blank';
    public $imgsrc='category';
    public $imgCat='';
    public $excerpt='no';
    public $chars=100;
    public $imgcap='featured';
    public $images = array();
    public $descs = array();
    public $links = array();
    public $transition = array();
    public $thumbs = array();
    
    
    function __construct(){
        // assign default values to above vars;
        $this->name = 'vslider_default';
        $this->settings = 'vs_settings';
        $this->themes = 'vs_theme';
        $responsive=1;
        $this->tt=true;
        $this->quality=100;
        $this->imgwidth=630;
        $this->imgheight=280;
        $this->num=3;
        $this->imgsrc='category';
        $this->imgCat='';
        $this->excerpt='no';
        $this->chars=200;
        $this->imgcap='featured';
        $this->target= '_blank';
        $this->images= array(
          'slide1'  => WP_PLUGIN_URL.'/vslider/images/slide1.jpg',
          'slide2'  => WP_PLUGIN_URL.'/vslider/images/slide2.jpg',
    	  'slide3'  => WP_PLUGIN_URL.'/vslider/images/slide3.jpg',
        );
        $this->thumbs= array(
          'thumb1'  => WP_PLUGIN_URL.'/vslider/images/slide1.jpg',
          'thumb2'  => WP_PLUGIN_URL.'/vslider/images/slide2.jpg',
    	  'thumb3'  => WP_PLUGIN_URL.'/vslider/images/slide3.jpg',
        );
        $this->links= array(
          'link1'  => 'http://www.VibeThemes.com',
          'link2'  => 'http://www.VibeThemes.com',
    	  'link3'  => 'http://www.VibeThemes.com',
        );
        $this->transition= array(
          'transition1'  => '',
          'transition2'  => '',
    	  'transition3'  => '',
        );
        $this->descs= array(
          'desc1'  => '<strong>ADD HTML Caption HERE</strong>',
          'desc2'  => 'Add html caption',
    	  'desc3'  => 'Add html images/videos here ',
        );
    }
    
    
   /*
   * Save options, and reset options
   */
  function reinitialize($name,$type)
  {
      Switch($type){
          case 'name':{
              $this->name=$name;
              break;
          }
           case 'setting':{
              $this->settings=$name;
              break;
          }
           case 'theme':{
              $this->themes=$name;
              break;
          }
              
      }
  }
  function save()
  {
       $message = '<div class="updated" id="message"><p><strong>Settings Saved '.$_POST['imgsrc'].'</strong></p></div>';
        $this->responsive=$_POST['responsive'];
        $this->tt=$_POST['tt'];
        $this->quality=$_POST['quality'];
        $this->width=$_POST['width'];
        $this->height=$_POST['height'];
        $this->num=$_POST['num'];
        $this->imgsrc=$_POST['imgsrc'];
        $this->imgCat=$_POST['imgCat'];
        $this->excerpt=$_POST['excerpt'];
        $this->chars=$_POST['chars'];
        $this->imgcap=$_POST['imgcap'];
        $this->target= $_POST['target'];
        for($i=1;$i<=$_POST['num'];$i++)
        {
            $this->images['slide'.$i]=$_POST['slide'.$i];
            if($_POST['thumb'.$i]){
                if(isset($_POST['thumb'.$i]))
                $this->thumbs['thumb'.$i]=$_POST['thumb'.$i];
                if(isset($_POST['thumb'.$i]))
                $this->transition['transition'.$i]=$_POST['transition'.$i];
            }
            
            $this->images['link'.$i]=$_POST['link'.$i];
            if($this->imgsrc =='custom')
            {
                $this->descs['desc'.$i]=$_POST['desc'.$i]; 
            }
        }
        update_option($this->name,serialize($this));
        return $message;
      }
     
  
  
  function add_vslider(){
      //Cleaning up name
     $err_message=''; 
    if(!get_option($this->name))
    {    
        add_option($this->name, serialize($this));

    }else{
        $err_message= ' Unable to Add vSlider, try a different name';
    }
    return($err_message);
  }
  
 
  function generate_vslider(){
      if(!$this->responsive) {
         $noresponsive='style="width:'.$this->width.'px !important;height:'.$this->height.'px !important;"';           
      }
      echo '<div class="slider-wrapper '.$this->name.'" '.$noresponsive.'>
            <div id="'.$this->name.'"  class="nivoSlider">';

      if($this->imgsrc=='custom'){
          $this->custom_images();
          $this->custom_descs();
      }
      else{
        switch($this->imgcap){
          case 'featured':{
                   $this->featured_images();
              break;
           }
          case 'first':{
                 $this->first_images();
              break;
           }
          }
        }  //end else 
        
        echo '</div>';
         
      }
      
function custom_images(){ 
    
    if($this->tt)
    {
        for($i=1;$i<=$this->num;$i++)
      {
          if($this->links['link'.$i]){
              echo ' <a href="'.$this->links['link'.$i].'" target="'.$this->target.'">';
          }
          if(intval(strlen($this->descs['desc'.$i]))){
          $title='title="#'.$this->name.'slide'.$i.'"';
           }
           
          $image = str_replace(site_url(), '', $this->images['slide'.$i]); 
          $img_url = WP_PLUGIN_URL.'/vslider/timthumb.php?src='.urlencode($image).'&amp;w='.$this->width.'&amp;h='.$this->height.'&amp;zc=1&amp;q='.$this->quality;
          
          if(intval(strlen($this->thumbs['thumb'.$i]))){
          $thumb = str_replace(site_url(), '', $this->thumbs['thumb'.$i]); 
          $twidth=round($this->width/$this->num);
          $theight=round($this->height/$this->num);
          $thumb_url = WP_PLUGIN_URL.'/vslider/timthumb.php?src='.urlencode($thumb).'&amp;w='.$twidth.'&amp;h='.$theight.'&amp;zc=1&amp;q='.$this->quality;
          
          }
          echo'<img src="'.$img_url.'" data-thumb="'.$thumb_url.'" '.$title.' " data-transition="'.$this->transition['transition'.$i].'"/>';
          
          if($this->links['link'.$i]){
              echo ' </a>';
          }
      }
    }
    else{    
      for($i=1;$i<=$this->num;$i++)
      { 
          if(intval(strlen($this->descs['desc'.$i]))){
          $title='title="#'.$this->name.'slide'.$i.'"';
           }
          if($this->links['link'.$i]){
              echo ' <a href="'.$this->links['link'.$i].'" target="'.$this->target.'">';
          }
          echo'<img src="'.$this->images['slide'.$i].'" data-thumb="'.$this->thumbs['thumb'.$i].'" '.$title.'   data-transition="'.$this->transition['transition'.$i].'"/>';
          
          if($this->links['link'.$i]){
              echo ' </a>';
          }
          
      }
    }//end else
      echo'</div>';            
  }

  function custom_descs(){
     for($i=1;$i<=$this->num;$i++)
      {       
      if(intval(strlen($this->descs['desc'.$i])))
          {
              echo '<div id="'.$this->name.'slide'.$i.'" class="nivo-html-caption">';
              echo $this->descs['desc'.$i];
              echo '</div>';
          }
      }
  }
  function featured_images(){
      $i=0;
      global $post;
      $recent = new WP_Query("cat=".$this->imgCat."&showposts=".$this->num); 
      while($recent->have_posts()) : $recent->the_post();
      $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID)); 
      $thumbnailSrc = $src[0]; 
      echo '<a href="';
          the_permalink();
          echo '" alt="';
          the_title();
          echo '">
            <img src="'.$thumbnailSrc.'" alt="'.get_the_title().'" title="#'.$this->name.'slide'.$i.'"/>
            </a>';
      $content[$i]=get_the_excerpt();
      $i++;
      endwhile;
      foreach($content as $excerpt)
      {
          echo '<div id="'.$this->name.'slide'.$i.'" class="nivo-html-caption">';
              echo $excerpt;
              echo '</div>';
          
      }
      
  }
  function first_images(){
      $i=1;
      $recent = new WP_Query("cat=".$this->imgCat."&showposts=".$this->num); 
      while($recent->have_posts()) : $recent->the_post();
      $iPostID = get_the_ID();
                    $content_post = get_post($iPostID);
                    $content = $content_post->post_content;
                    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$content, $matches);
                    $thumbnailSrc = $matches [1] [0];
                    
      echo '<a href="';
          the_permalink();
          echo '" alt="';
          the_title();
          echo '">
            <img src="'.$thumbnailSrc.'" alt="'.get_the_title().'" title="#'.$this->name.'slide'.$i.'"/>
            </a>';
      $i++;
      //$img_url = WP_PLUGIN_URL.'/vsliderdev/timthumb.php?src='.$thumbnailSrc.'&amp;w='.$options['width'].'&amp;h='.$options['height'].'&amp;zc=1&amp;q='.$options['quality'];
      endwhile;
      $i=1;
      while($recent->have_posts()) : $recent->the_post();
      
          $excerpt=get_the_excerpt();
          echo '<div id="'.$this->name.'slide'.$i.'" class="nivo-html-caption">';
              echo $excerpt;
              echo '</div>';
              $i++;
          
      endwhile;
  }
   function migrate_vslider($name){
       $this->name=$name;
       $this->themes='vstheme_'.$name;
       
       $option=get_option($name);
       if(is_string($option))
       {
          $option=unserialize($option);
       }
       
       if(isset($option->version)){
           return (1);
       } else{
       echo '<br><br>Migrating vSlider '.$this->name;
       
         ($option['timthumb'] == 1)? $this->tt=true : $this->tt=false;
          $this->quality=$option['quality'];
          $this->width=$option['width'];
          $this->height=$option['height'];
          $this->num=$option['slideNr'];
          ($option['customImg'] == 'true')? $this->imgsrc='custom' : $this->imgsrc = 'category';
          $this->imgCat=$option['imgCat'];
          $this->excerpt=$option['excerpt'];
          $this->chars=$option['chars'];
          $this->imgcap=$option['catchimage'];
          if(isset($option['target']))
          $this->target= $option['target'];
          if($option['customImg'] == 'true'){
          for($i=1;$i<$option['slideNr'];$i++)
          {
              $this->images['slide'.$i]=$option['slide'.$i];
              $this->links['link'.$i]=$option['link'.$i];
              $this->descs['desc'.$i]='<strong>'.$option['heading'.$i].'</strong>'.$option['desc'.$i];
              if($option['heading'.$i] == '')
              {
              $this->descs['desc'.$i]='';
              }
          }
          }
     } 
    
   }
  
}     
?>