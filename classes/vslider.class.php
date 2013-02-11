<?php

/**
 * FILE: vslider.class.php 
 * Created on Feb 1, 2013 at 1:41:15 PM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider 5.0
 * License: GPLv2
 */


class vSlider{
    private $version = '5.0';
    private $namespace = 'vslider-';
    public $settings = array();
    public $theme = array();
    public $images = array();
    
    function __construct() {
       $this->settings=array(
         'animation'=> '"fade"',  
         'direction'   => '"horizontal"',   
         'animationLoop' => 'true',
         'slideshow' => 'true',   
         'slideshowSpeed' => '7000',
         'animationSpeed' => '600',
         'controlNav' => 'true', 
         'directionNav' => 'true');
        $this->theme=array(
         'theme'=> 'default',  
         'caption'   => '"horizontal"',   
         'control_nav' => 'default',
         'direction_nav' => 'default',   
         'shadow' => 'none',
         'custom_css' => '');
       $this->images=array(
                 '1'=> array(
                      'src' => VSLIDER_URL.'/includes/themes/default/img/slide1.png',
                      'link' => 'First Slide',
                      'lightbox' => '',
                      'heading' => 'First Slide',
                      'description' => 'Some Description' 
                       ),
                 '2'=> array(
                      'src' => VSLIDER_URL.'/includes/themes/default/img/slide2.jpg',
                      'link' => 'Second Slide',
                      'lightbox' => '',
                      'heading' => 'Second Slide',
                      'description' => 'Some Description' 
                       )      
                    );
    }
   
   
function initialize($vslider){
    if($vslider instanceof vSlider){
        $this->settings=$vslider->settings;
        $this->theme=$vslider->theme;
        $this->images=$vslider->images;
    }else{ 
        if(is_array($vslider)){
             $serial_vslider=$vslider;
        }else{
             $serial_vslider=unserialize($vslider);
        }
       
        if(count($serial_vslider) > 0){
            if($serial_vslider['slideNr'] >0){
                for($i=1;$i<=$serial_vslider['slideNr'];$i++){
                  $this->images[$i]=array(
                    'src' =>   $serial_vslider['slide'.$i],
                    'link' =>   $serial_vslider['link'.$i],
                    'lightbox' =>   '',
                    'heading' =>   $serial_vslider['heading'.$i],
                    'description' =>   $serial_vslider['desc'.$i],  
                  );  
                }
                
                $this->theme['custom_css']='" style="width:'.$serial_vslider['width'].'px; height:'.$serial_vslider['height'].'px;"';
            }
        }
    }
    
}

function add_vslider($name){
    $check = get_option($name);
    if(empty($name)){
        $check=1;
    }
    if(empty($check)){
        global $wpdb;
        $table_name = $wpdb->prefix . "vslider"; 
        $sql = "INSERT INTO " . $table_name . " values ('','".$name."','1');";
                if ($wpdb->query( $sql )){
                        add_option($name,$this);
                        echo "<div class='save'>New vSlider $name created.</div>";
                        }else{
                            echo "<div class='error'>Could not create vSlider, DB issue</div>"; 
                        }
        
    }else{
        echo "<div class='error'>Could not create vSlider with name : $name </div>";
    }
}    
function get_vsliders()
 {  
     if(isset($_GET['delete']) && $_GET['delete']){
         $this->delete($_GET['vslider']);
     }
     
     if(isset($_GET['export']) && $_GET['export']){
         $this->export($_GET['vslider']);
     }
     
     if(isset($_POST['delete'])){
         $this->bulk_delete($_POST['vsliders']);
     }
     
     if(isset($_POST['export'])){
         $this->bulk_export($_POST['vsliders']);
     }
     
     if(isset($_POST['import'])){
         $this->bulk_import($_POST['vslider_import']);
     }
     
     if(isset($_POST['add-slider'])){
        $this->add_vslider(stripslashes($_POST['vslider_name']));
     }
    global $wpdb;
    $num=1;
    $table_name = $wpdb->prefix . "vslider"; 
    $vslider_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
    ?>
<form method="post" action="<?php echo vslider_admin_url( 'admin.php').'?page=vslider5&tab=main'; ?>">
    <?php wp_nonce_field('get_vslider_settings'); ?>
    <table class="wp-list-table widefat fixed" cellspacing="0">
    <thead>
	<tr>
		<th scope="col" id="cb" class="manage-column column-cb check-column" style="">
                    <label class="screen-reader-text" for="cb-select-all-1"><?php _e('Select All','vslider'); ?></label>
                    <input id="cb-select-all-1" type="checkbox"></th>
                <th scope="col" id="id" class="manage-column column-id" style="width:10%;"><?php _e('ID','vslider'); ?></th>
                <th scope="col" id="vslider_name" class="manage-column column-vslidername" style=""><?php _e('vSlider Name','vslider'); ?></th>
                <th scope="col" id="shortcode" class="manage-column column-shortcode" style=""><?php _e('ShortCode','vslider'); ?></th>
        </tr>
	</thead>

	<tfoot>
	<tr>
		<th scope="col" class="manage-column column-cb check-column" style="">
                    <label class="screen-reader-text" for="cb-select-all-2"><?php _e('Select All','vslider'); ?></label>
                    <input id="cb-select-all-2" type="checkbox">
                </th>
                <th scope="col" id="id" class="manage-column column-id"><?php _e('ID','vslider'); ?></th>
                <th scope="col" id="vslider_name" class="manage-column column-vslidername" style=""><?php _e('vSlider Name','vslider'); ?></th>
                <th scope="col" id="shortcode" class="manage-column column-shortcode" style=""><?php _e('ShortCode','vslider'); ?></th>
	</tr>
	</tfoot>
        <tbody id="the-list">
    <?php
    
    foreach ($vslider_data as $data) { 
        
       echo '<tr>
             <th scope="row" class="check-column"><input type="checkbox" name="vsliders[]" value="'.$data->option_name.'"></th>
             <td scope="row" style="padding: 10px;">'.$num.'</td>
             <td valign="middle" style="padding: 10px;"><span class="vslider_name"> '.$data->option_name.' </span>
             <div class="row-actions">
             <span class="edit">
             <a href="'. wp_nonce_url(vslider_admin_url('admin.php').'?page=vslider5&tab=settings&vslider='.$data->option_name .''). '">' . __('Edit','vslider') . '</a>
             </span> |<span class="edit">
             <a href="'. wp_nonce_url(vslider_admin_url('admin.php').'?page=vslider5&tab=images&vslider='.$data->option_name .''). '">' . __('Images','vslider') . '</a>
             </span> | <span class="edit">
             <a href="'. wp_nonce_url(vslider_admin_url('admin.php').'?page=vslider5&export=1&vslider='.$data->option_name .''). '">' . __('Export','vslider') . '</a>
             </span> |  <span class="delete">
             <a href="'. wp_nonce_url(vslider_admin_url('admin.php').'?page=vslider5&delete=1&vslider='.$data->option_name .''). '"  onClick="return confirm( \'Are you sure you want to delete the '.$data->option_name .' vSlider ?\' )">' . __('Delete','vslider') . '</a>
             </span>
             </td>
             <td style="padding: 10px;" class="vslider_shortcode">[vslider name=""]</td>    
             </tr>';
         $num++;}
         ?>
       <tr style="height:60px;"> 
       <th scope="row" class="check-column">
           <input type="checkbox" value=""></th>     
       <td style="padding: 10px;"><?php echo $num; ?> </td>
       
       
       <td colspan="1" style="padding: 10px;"><input type="text" id="option_name" name="vslider_name" size="50" />
       <span style="font-size:10px;padding:10px;"><br /><?php _e('* Do not use spaces or special characters in the name.','vslider'); ?></span>
       </td>
       <td colspan="1" style="padding: 10px;"><input type="submit" class="button-primary" name="add-slider" value="<?php _e('Add new vSlider','vslider'); ?>"></td>
       </tr>
       
       </tbody>
       
    </table>
       <?php
       echo '<p>Bulk Actions : <input type="submit" style="margin:5px;" class="button-primary" value="Export All" name="export" /> <a style="margin:5px;" class="button-primary" id="importall">Import All</a> <input type="submit" style="margin:5px;" class="button" value="Delete All" name="delete" onClick="return confirm( \'Are you sure you want to Delete the selected vSliders?\' )" /> 
           <a href="?page=vslider&tab=more"><img src="'.VSLIDER_URL.'/includes/images/donate.png" style="width:16px;float:right;margin:0 5px;" /></a><a href="http://www.twitter.com/vibethemes" target="_blank"><img src="'.VSLIDER_URL.'/includes/images/twitter.gif" style="width:16px;float:right;margin:0 5px;" /></a><a href="http://www.facebook.com/vibethemes" target="_blank"><img src="'.VSLIDER_URL.'/includes/images/facebook.png" style="width:16px;float:right;margin:0 5px;" /></a><a href="http://vibethemes.com/forums/forumdisplay.php?30-vSlider" target="_blank"><img src="'.VSLIDER_URL.'/includes/images/icon.png" style="width:16px;float:right;margin:0 5px;" /></a></p>';
       echo '<div id="import" style="display:none;"><textarea name="vslider_import" class="widefat" rows="8" onfocus="if(this.value=this.defaultValue){this.value=\'\'}; return false;">Copy and Paste the vSlider Export text here.</textarea><input type="submit" name="import" value="Import vSliders" class="button-primary" /></div>';
       ?>
    </form>
    <?php
    }
 
    
    
function save_settings($name){
    $vslider = get_option($name);
    if(empty($vslider)){
        echo "<div class='error'>Could not save vSlider, $name does not exist !</div>";
    }else{
        $this->initialize($vslider);
        foreach($this->settings as $key=>$value){
           if(isset($_POST[$key])){
               $this->settings[$key]=stripslashes($_POST[$key]);
           }   
        }
        update_option($name,$this);
        echo "<div class='save'>vSlider <strong>$name</strong> settings saved.</div>";
    }
} 
   
    function settings(){
        if(isset($_POST['save_vslider_settings'])){
           $this->save_settings(stripslashes($_POST['vslider']));    
           $vslider_name=$_POST['vslider'];
        }
        if(isset($_GET['vslider'])){
            $vslider_name=$_GET['vslider'];
        }
        global $wpdb;
        $num=1;
        $table_name = $wpdb->prefix . "vslider"; 
        $vslider_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
    
        ?>
       <form method="post" action="<?php echo vslider_admin_url( 'admin.php').'?page=vslider5&tab=settings'; ?>">
        <?php wp_nonce_field('get_vslider_settings'); ?>
            <table class="wp-list-table widefat fixed tr_select_slider">
       <tr>
	 <th><label for="vsliders">Select a Slider:</label></th>
	 <td>
	     <select name="vslider" class="select_slider">
                 <option value="">Select a Slider</option>
                 <?php
                     foreach ($vslider_data as $data) { 
                         echo '<option value="'.$data->option_name.'" '.selected($data->option_name, $vslider_name).'>'.$data->option_name.'</option>';
                     }
                 ?>
             </select>
	     <span class="description"> Select a slider to edit settings.</span>
	 </td>
	</tr>
        
       </table>
           
     <?php
     
     
    }
    

/*=== Images Functions ===*/  
    
function save_images(){
    $name = stripslashes($_POST['vslider']);
    $vslider = get_option(stripslashes($_POST['vslider']));
    if(empty($vslider)){
        echo "<div class='error'>Could not save vSlider, $name does not exist !</div>";
    }else{
        
        $this->initialize($vslider);
        
        foreach($this->theme as $key=>$value){
           if(isset($_POST[$key])){
               $this->theme[$key]=stripslashes($_POST[$key]);
           }   
        }
        $this->images = $_POST['images'];
        update_option($name,$this);
        echo "<div class='save'>vSlider $name settings saved.</div>";
    }
}    
function images(){
        if(isset($_POST['save_vslider_images'])){
           $this->save_images(stripslashes($_POST['vslider']));    
           $vslider_name=$_POST['vslider'];
        }
        
        if(isset($_GET['vslider'])){
            $vslider_name=$_GET['vslider'];
        }
        global $wpdb;
        $num=1;
        $table_name = $wpdb->prefix . "vslider"; 
        $vslider_data = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id");
         
        ?>
       <form method="post" action="<?php echo vslider_admin_url( 'admin.php').'?page=vslider5&tab=images'.(isset($vslider)?'&vslider='.$vslider_name : '').''; ?>">
        <?php wp_nonce_field('get_vslider_images'); ?>
       <table class="wp-list-table widefat fixed">
       <tr class="tr_select_images">
	 <th><label for="vsliders">Select a Slider:</label></th>
	 <td>
	     <select name="vslider" class="select_images">
                 <option value="">Select a Slider</option>
                 <?php
                     foreach ($vslider_data as $data) { 
                         echo '<option value="'.$data->option_name.'" '.selected($data->option_name, $vslider_name).'>'.$data->option_name.'</option>';
                     }
                 ?>
             </select>
	     <span class="description"> Select a slider to edit images.</span>
	 </td>
	</tr>
       </table>
           
     <?php
     
     
    }

// Main Function
  function vslider($id){
         $theme_classes='vslider';
         foreach($this->theme as $key => $value){
             if($key == 'custom_css'){
                 $custom_style=$value;
             }else
             $theme_classes .=' '.$key.'-'.$value;
         }
         
         $vslider_html ='<div id="'.$id.'" class="'.$theme_classes.' '.stripslashes($custom_style).'">';
         $vslider_html .='<ul class="slides">';
         foreach($this->images as $images){
             $vslider_html .='<li><a href="'.$images['link'].'" '.(isset($images['lightbox'])?'rel="prettyPhoto['.$id.']"':'').'>
                                  <img src="'.$images['src'].'" /></a>
                                  <div class="vslider-caption">
                                  '.(empty($images['heading'])?'':'<h4>'.stripslashes($images['heading']).'</h4>').'
                                  '.(empty($images['description'])?'':'<p>'.do_shortcode(stripslashes($images['description'])).'</p>').'
                                  </div></li>';
         }
         $vslider_html .='</ul>';
         $vslider_html .='</div>';
         
          return $vslider_html;
    }
    
    function vslider_script($id){
        $vslider_script= '';
        $vslider_script .= 'var '.$id.' = {';
        foreach($this->settings as $key => $value){
            $vslider_script .= '"'.stripslashes($key).'" : '.stripslashes($value).',';
        }
         $vslider_script .= '"touch" : true};';
         
         return $vslider_script;
    }
    
    function delete($name){
        $check = get_option($name);
        if(empty($check)){
            echo "<div class='error'>Could not delete vSlider with name : <strong>$name</strong> | Use clean database ! </div>";
        }else{
        global $wpdb;
        $table_name = $wpdb->prefix . "vslider"; 
        $sql = "DELETE FROM " . $table_name . " WHERE option_name='$name';";
                if ($wpdb->query( $sql )){
                        delete_option($name);
                        echo "<div class='save'> vSlider <strong>$name</strong> deleted.</div>";
                        }else{
                            echo "<div class='error'>Unable to delete vSlider!</div>"; 
                        }
        
        }
    }
    
    function bulk_delete($vsliders){
        foreach($vsliders as $vslider){
            $this->delete($vslider);
        }
    }
    
    function export($name){
        $vslider = get_option($name);
		if(empty($vslider)){
                  echo "<div class='error'>Unable to export vSlider !</div>";   
                }else{
                    $content = '###'.$name.'@@'.serialize($vslider).'###';
                    $fsize = strlen($content);
                    ob_end_clean();
                    header('HTTP/1.1 200 OK');
                    header('Content-Description: File Transfer');
                    header('Content-type: application/txt');
                    header('Content-Disposition: attachment; filename="vslider_'.$name.'_backup_'.date('d-m-Y').'.txt"');
                    header('Content-Transfer-Encoding: binary');
                   // header("Content-Length: ".$fsize);
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header("Pragma: no-cache");
                    echo $content;
                    exit;
                    
                    }
                }
    
    function bulk_export($vsliders){
            $content ='';
        foreach($vsliders as $name){
             $vslider = get_option($name);
		if(empty($vslider)){
                  echo "<div class='error'>Unable to export vSlider !</div>"; 
                  return;
                }else{
                    $content .= '###'.$name.'@@'.serialize($vslider).'###';
                    }
                   }
        
                    $fsize = strlen($content);
                    ob_end_clean();
                    header('HTTP/1.1 200 OK');
                    header('Content-Description: File Transfer');
                    header('Content-type: application/txt');
                    header('Content-Disposition: attachment; filename="vslider_backup_'.date('d-m-Y').'.txt"');
                    header('Content-Transfer-Encoding: binary');
                   // header("Content-Length: ".$fsize);
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header("Pragma: no-cache");
                    echo base64_encode($content);
                    exit;
    }
    
    function bulk_import($vslider_hash){
            $vslider_hash = base64_decode($vslider_hash);
            $vsliders = explode('###', $vslider_hash);
            foreach($vsliders as $vslider_code){ 
                
                if(strpos($vslider_code,'@@') > 0){ 
                $vs=explode('@@',$vslider_code);
                $vslider_name=$vs[0];
                $vslider = unserialize($vs[1]);
                $check =get_option($vslider_name);
                if(empty($check) || !isset($check)){
                       $this->initialize($vslider);
                     global $wpdb;
                     $table_name = $wpdb->prefix . "vslider"; 
                     $sql = "INSERT INTO " . $table_name . " values ('','".$vslider_name."','1');";
                     if ($wpdb->query( $sql )){
                            add_option($vslider_name,$this);
                            echo "<div class='save'>New vSlider <strong>$vslidername</strong> Imported.</div>";
                        }else{
                            echo "<div class='error'>Could not create vSlider, DB issue</div>"; 
                        }
                    }else{
                        echo "<div class='error'>vSlider <strong>$vslidername</strong> already exists !</div>";
                    }// Check is option already exists  
                    
                    
              } // Verify correct vslider code  
              
            } // END-For
    }
   
}

?>
