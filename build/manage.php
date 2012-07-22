<?php

/* Credits: 
 * Author: Mr.Vibe
 * Website: www.VibeThemes.com
 * Version: 4.2
 */

function manage_vsliders()
{
    
    $manage=array();

    check_errors();
    start_manage();
    if(get_option('vslider_installed'))
    {
        $manage=array();
        $vsliderinfo=get_option('vsliders');
        if(is_string($vsliderinfo))
            $manage=unserialize($vsliderinfo);
        else
            $manage=$vsliderinfo;
        
        $vslider=array();
        $i=0;
        $settings=array();
        $themes=array();
        foreach($manage as $vslider){
            build_manage($vslider,$i);
            $i++;
        }
        
     $settinginfo= get_option('vslider_settings');  
     if(is_string($settinginfo))
            $settings=unserialize($settinginfo);
        else
            $settings=$settinginfo;
     
        $themeinfo=get_option('vslider_themes');
     if(is_string($themeinfo))
            $themes=unserialize($themeinfo);
        else
            $themes=$themeinfo;
         
     $settings=array_unique($settings);
     $themes=array_unique($themes);
     
     new_vslider_form($i,$settings,$themes);
    end_manage();
    }
    else{
        echo 'Please Update vSlider : <input type="submit" class="button-primary" style="padding: 10px 30px 10px 30px;" value="Upgrade to vSlider 4.2" />';
    }
    
}   

function start_manage()
{    
    ?><script>
var $jq=jQuery.noConflict();$jq(document).ready(function(){$jq('#vsliderdonate').change(function(){switch($jq('#vsliderdonate').val()){case'donate':{$jq('#vsliderdonatebox').show();$jq('#vsliderlink').hide();break}case'link':{$jq('#vsliderdonatebox').hide();$jq('#vsliderlink').show();break}case'nohelp':{$jq('#vsliderdonatebox').hide();$jq('#vsliderlink').hide();break}}})});
</script><?php
    echo '<div class="wrap" style="width:820px;"><div id="icon-options-general" class="icon32"><br /></div>
        <h2>vSlider 4.2.0 Settings</h2>
        <div class="metabox-holder" style="width: 820px; float:left;">
        <div class="inside">
        <br />
        </div>
        </div>
                <table class="widefat" cellspacing="0">
		<thead>
		<tr>
		<th scope="col" id="name" class="manage-column column-name" colspan="5">Table Of vSliders</th>
		</tr>
                <tr style="background: #efefef;">
                <td style="width: 100px;text-align:center;"> Sno </td>
                <td style="width: 100px;text-align:center;"> vSlider Name </td>
                <td style="width: 100px;text-align:center;"> vSlider Settings </td>
                <td style="width: 100px;text-align:center;"> vSlider Themes </td>
                <td style="width: 200px;text-align:center;"> Action </td>
                </tr>
		</thead>
		<tbody>';
}

function build_manage($vslider,$num)
{   $num++;
    echo ' <tr style="height:40px;">
                <td style="width: 100px;text-align:center;padding: 10px;" >'.
               $num
               .'</td><form method="post">
               <td style="width: 100px;text-align:center;padding: 10px;" valign="middle"> 
               '.$vslider['name']
               .' <input type="hidden" name="vs_name" value="'.$vslider['name'].'" /></td>
               <td style="width: 100px;text-align:center;padding: 10px;" >
                  '.$vslider['setting'].'<input type="hidden" name="vs_setting" value="'.$vslider['setting'].'" />        
               </td>
               <td style="width: 100px;text-align:center;padding: 10px;"> '.
               $vslider['theme']
               .' <input type="hidden" name="vs_theme" value="'.$vslider['theme'].'" /></td>
               <td style="width: 100px;text-align:center;padding: 10px;" > 
                <select id="default_post_format" name="vslider_action">
                <option value="">Select an action</option>
                <option value="changesetup">Change setup</option>
                <option value="editimages">Edit Images</option>
                <option value="edittheme">Edit Theme</option>
                <option value="editsetting">Edit Settings</option>
                </select>
                '.wp_nonce_field('vslider').'
                <input type="submit" class="button-primary" value="Go">
                </form>
               </td></tr>';             
}

function new_vslider_form($num,$settings=array(),$themes=array())
        { 
    ?>
      <form method="post" >
       <tr style="height:60px;"> 
       <td style="width: 100px;text-align:center;padding: 20px;"><?php echo ($num+1); ?> </td>
       <td style="padding: 20px;" >
           <input type="text" id="vslider_name" name="vslider_name"/>
           <small>
            &nbsp;&nbsp;&nbsp;&nbsp;* Do not use spaces, numbers or special characters in the name.
            </small>
       </td>     
       <td>    
           <select id="default_post_format" name="vslider_setting" style="margin:20px 0;">
           <?php
           $settings=array_unique($settings);
           foreach($settings as $setting){
               echo '<option value='.$setting.'>'.$setting.'</option>';
           }
           
           ?>
            <option value="new_setting">Add New Setting</option>   
           </select>
       </td>
       <td>
           <select id="default_post_format" name="vslider_theme" style="margin:20px 0;">
           <?php
           $themes=array_unique($themes);
           foreach($themes as $theme){
               echo '<option value='.$theme.'>'.$theme.'</option>';
           }
           
           ?>
               <option value="new_theme">Add New Theme</option>
           </select>
           <?php
           wp_nonce_field('newvslider');
           ?>
       </td>
       <td style="width: 100px;text-align:center;padding: 20px;" colspan="2"><input type="submit" class="button-primary" name="new_vslider" style="padding: 10px 30px 10px 30px;" value="Add new vSlider" />  </td>
       </tr>
       </form>
<?php
}

function end_manage()
{
    echo '  </tbody>
            <tfoot>
            <tr><th scope="col"  class="manage-column column-name" colspan="3">';    
             if(get_option('vslider_support') == 1 ){
                 _e('Thank You for Supporting Us! ');
                      echo '<form method="post" style="float: right;margin-right: 250px;" action="?page=vslider"><input type="submit" style="padding: 3px 10px 3px 10px;" name="removelink" class="button" value="Remove Link" /></form>';
                        }
                        else{
                      _e('Support development'); ?>: 
        <select id="vsliderdonate" onchange="support(this);">
        <option value="link" selected="<?php echo $link; ?>"><?php _e('OK, this will place a link to author in footer.'); ?></option>
        <option value="donate" selected="<?php echo $donate; ?>"><?php _e('OK, I would prefer to donate some money.'); ?></option>
        <option value="nohelp" selected="selected"><?php _e('I do not think it\'s worth supporting it.'); ?></option>
        </select>
        <div id="vsliderdonatebox" style="display:none;">
        <?php _e('Donate Amount'); ?>:
        <small>
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=19&currency_code=USD" target="_blank">$19 USD</a> |
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=9&currency_code=USD" target="_blank">$9 USD</a> |
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=6&currency_code=USD" target="_blank">$6 USD</a> |
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=3&currency_code=USD" target="_blank">$3 USD</a>
        </small></div>
        <div id="vsliderlink" style="display:none;margin:5px 2px 2px 2px">
        <?php _e('Confirm text link in the Footer'); ?> : <form method="post" style="float: right;margin-right: 250px;" action="?page=vslider"><input type="submit" style="padding: 3px 10px 3px 10px;" class="button-primary" name="link" value="Add Link" /></form>
        </div>
        <?php
        }
       echo '
                </th>
            <th scope="col"  class="manage-column column-name" colspan="2">
            <small>Stay Connected </small>
            &nbsp;<a href="http://twitter.com/#!/vibethemes/" target="_blank">
                  <img src="'.WP_CONTENT_URL.'/plugins/vslider/images/twitter.gif" />
                  </a>
            &nbsp;<a href="http://www.facebook.com/vibethemes/" target="_blank">
                  <img src="'.WP_CONTENT_URL.'/plugins/vslider/images/facebook.png" />
                  </a>
            &nbsp;<a href="http://www.vibethemes.com/forum/" target="_blank" title="VibeThemes Forums">
                  <img src="'.WP_CONTENT_URL.'/plugins/vslider/images/vibeforums.png" />
                  </a>
            </th>
            </tr>
            </tfoot>
            </table>
            </div>
            <br /><br />';check_oldvslider();
    }
    
    
function check_errors()
{
        $msg=0;
    if(isset($_POST['new_vslider']))
    {
        
        $vslider=new vslider();
        $vslider->reinitialize(preg_replace('/[^a-z0-9\s]/i', '', $_POST['vslider_name']),'name');  
        $vslider->reinitialize(str_replace(" ", "_", $vslider->name),'name');
        if($vslider->name == ''){
            $msg='vSlider Name cannot be left blank!';
        }
    if(!$msg)
    {
        if($_POST['vslider_setting'] =='new_setting')
        {
            $setting=new vslider_settings();
            $name=substr($vslider->name,0,2)."_setting";
            $setting->reinitialize($name);
            update_option($setting->name,  serialize($setting));
            $all_settings=unserialize(get_option('vslider_settings'));
            $vslider->reinitialize($setting->name,'setting');
            array_push($all_settings,$setting->name);
            $all_settings=array_unique($all_settings);
            update_option('vslider_settings',serialize($all_settings));
        }else{
        $vslider->reinitialize($_POST['vslider_setting'],'setting');
        }
        
        if($_POST['vslider_theme'] =='new_theme')
        {
            $theme=new vslider_themes();
            $name=substr($vslider->name,0,2)."_theme";
            $theme->reinitialize($name);
            update_option($theme->name,  serialize($theme));
            
            $all_themes=unserialize(get_option('vslider_themes'));
            $vslider->reinitialize($theme->name,'theme');
            array_push($all_themes,$theme->name);
            $all_themes=array_unique($all_themes);
            update_option('vslider_themes',serialize($all_themes));
        }else{
        $vslider->reinitialize($_POST['vslider_theme'],'theme');
        }
        
        $new_vslider=array('name'=>$vslider->name,'setting'=>$vslider->settings,'theme'=>$vslider->themes);
        
        $vsliders=array();
        
        $vsliders=unserialize(get_option('vsliders'));
        $msg=$vslider->add_vslider();
        
    }
        if(!$msg)
        {   
            echo '<div class="updated" id="message"><p><strong>vSlider Successfully Added!</strong></p></div>';
            array_push($vsliders,$new_vslider); 
            update_option('vsliders',serialize($vsliders));
            update_option($vslider->name, serialize($vslider));
        }else{
             echo '<div class="updated" id="message"><p><strong>'.$msg.'</strong></p></div>';
        }
    }
    
    if(isset($_POST['save_images']))    
    {
        $vslider=new vslider();
        $vslider=unserialize(get_option($_POST['vs_name']));
        $msg=$vslider->save();
        echo $msg;
        edit_vsliderpage($vslider);
        exit;
    }
    
     if(isset($_POST['save_theme']))    
    {
        $vslider_theme=new vslider_themes();
        
        if(isset($_POST['vs_theme']))
        {
            $vslider_theme=unserialize(get_option($_POST['vs_theme']));
            $msg=$vslider_theme->save();
        }
    else 
        $msg="Theme doesnot exist";
    
        
        echo $msg;
        edit_vslidertheme($vslider_theme);
        exit;
    }
    
    if(isset($_POST['save_setting']))    
    {
        $vslider_setting=new vslider_settings();
        $vslider_setting=unserialize(get_option($_POST['vs_setting']));
        $msg=$vslider_setting->save();
        echo $msg;
        edit_vslidersettings($vslider_setting);
        exit;
    }
    
    if(isset($_POST['save_changevslider']))    
    {
        $vslider= new vslider();
        $vslider=unserialize(get_option($_POST['vslider_name']));
        $vslider->reinitialize($_POST['vs_setting'], 'setting');
        $vslider->reinitialize($_POST['vs_theme'], 'theme');
        echo '<div class="updated" id="message"><p><strong>Settings Saved</strong></p></div>';
         
        $vsliders=unserialize(get_option('vsliders'));
        $new_vsliders=array();
        $i=0;
        foreach($vsliders as $vs){
            if($vs['name']==$vslider->name)
            {
                $vs['setting']=$vslider->settings;
                $vs['theme']=$vslider->themes;
            }
            $new_vsliders[$i]=$vs;
            $i++;
        }
        $vsliders=serialize($new_vsliders); //Serialize and convert into string
        update_option('vsliders',$vsliders);
        update_option($vslider->name,serialize($vslider));
    }
    //Save theme | save Settings
    
    if(isset($_POST['vslider_action']))
    {
        $nonce=$_REQUEST['_wpnonce'];
        if (! wp_verify_nonce($nonce, 'vslider') ) 
          die("Security check");
        else
        { 
            check_admin_referer('vslider');
            switch($_POST['vslider_action'])
            {
                case 'changesetup':{
                    $vslider=new vslider();
                    $vslider=unserialize(get_option($_POST['vs_name']));
                    change_vslidersetup($vslider);
                    break;
                }
                case 'editimages':{
                    $vslider=new vslider();
                    $vslider=unserialize(get_option($_POST['vs_name']));
                    edit_vsliderpage($vslider);
                    break;
                }
                case 'editsetting':{
                $vs_setting=new vslider_settings();
                if(isset($_POST['vs_setting']))
                $vs_setting=unserialize(get_option($_POST['vs_setting']));
                edit_vslidersettings($vs_setting);
                break;
                }
                case 'edittheme':{
                $vs_theme=new vslider_themes();
                if(isset($_POST['vs_theme']))
                $vs_theme=unserialize(get_option($_POST['vs_theme']));
                
                edit_vslidertheme($vs_theme);
                break;
            }
        }
        
    }
    exit;
}

if(isset($_POST['migrate_vsliders']))
    {
    echo "<br><br><br><h3>1. Starting Migration to vSlider 4.2 Version</h3>";
    migrate_vsliders();
    exit();
}
if(isset($_POST['skip_migrate_vsliders']))
{
    skip_migrate_vsliders();
}

if(isset($_POST['new_vslider']))
{
    $nonce=$_REQUEST['_wpnonce'];  
    if (! wp_verify_nonce($nonce, 'newvslider') ) 
       die("Security check");
    else
    {
        check_admin_referer('newvslider');
    }
}  

}