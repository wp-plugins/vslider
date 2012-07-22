<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class vslider_themes
{
        var $name = 'vs_theme';
        var $opacity = 80;
    	var $textColor = 'FFFFFF';
    	var $bgColor = '222222';
    	var $navstyle = 'none';
        var $arrstyle = 'none';
        var $navplace = '0px 0px 0px 0px';
        var $layout = 'stripe-bottom';
        var $borderWidth = '5';
        var $borderRadius = '0';
        var $borderColor = 'FFFFFF';
        var $holdermar = '0px 0px 0px 0px';
        var $holderfloat = 'none';
        var $timthumb = 1;
        var $quality = 100;
        var $vnav = 0 ; 
        
        function _construct(){
        $this->name= 'vs_theme';
        $this->opacity = 80;
    	$this->titleFont = 16;
    	$this->fontSize = 12;
    	$this->textColor = 'FFFFFF';
    	$this->bgColor = '222222';   
        $this->navstyle = 'none';
        $this->arrstyle = 'none';
        $this->navplace = '0px 0px 0px 0px';
        $this->layout = 'stripe-bottom';
        $this->borderWidth = '5';
        $this->borderRadius = '0';
        $this->borderColor = 'FFFFFF';
        $this->holdermar = '0px 0px 0px 0px';
        $this->holderfloat = 'none';
        $this->timthumb = 1;
        $this->quality = 100;
        $this->vnav = 0 ;     
        }
        

    function save()
    {
       
        $message = '<div class="updated" id="message"><p><strong>Theme '.$this->name.' Saved</strong></p></div>';
        $this->width = $_POST['width'];
    	$this->height = $_POST['height'];
        $this->opacity = $_POST['opacity'];
    	$this->titleFont = $_POST['titleFont'];
    	$this->fontSize = $_POST['fontSize'];
    	$this->textColor = $_POST['textColor'];
    	$this->bgColor = $_POST['bgColor'];
        $this->navstyle = $_POST['navstyle'];
        $this->arrstyle = $_POST['arrstyle'];
        $this->navplace = $_POST['navplace'];
        $this->layout = $_POST['layout'];
        $this->borderWidth = $_POST['borderWidth'];
        $this->borderRadius = $_POST['borderRadius'];
        $this->borderColor = $_POST['borderColor'];
        $this->holdermar = $_POST['holdermar'];
        $this->holderfloat = $_POST['holderfloat'];
        $this->timthumb = $_POST['timthumb'];
        $this->quality = $_POST['quality'];
        $this->vnav = $_POST['vnav'];
        update_option($this->name, serialize($this));
        return $message;
      }
      
      
     function reinitialize($name){
          $this->name=$name;
      }
      
     function migrate_theme($name){
     $this->name='vstheme_'.$name;
     $option=get_option($name);
     echo '<br><br>Generating vSlider Theme'.$this->name;
     if(is_string($option))
     {
        $option=unserialize($option);
      }
      
       if(isset($option['opacity']))
      $this->opacity = $option['opacity'];
       
      if(isset($option['textColor']))
      $this->textColor = $option['textColor'];
      if(isset($option['bgColor']))
      $this->bgColor = $option['bgColor'];
      if(isset($option['navstyle']))
      $this->navstyle = $option['navstyle'];
      if(isset($option['arrstyle']))
      $this->arrstyle = $option['arrstyle'];
      if(isset($option['navplace']))
      $this->navplace = $option['navplace'];
      if(isset($option['layout']))
      $this->layout = $option['layout'];
      if(isset($option['borderWidth']))
      $this->borderWidth = $option['borderWidth'];
      if(isset($option['borderRadius']))
      $this->borderRadius = $option['borderRadius'];
      if(isset($option['borderColor']))
      $this->borderColor = $option['borderColor'];
      if(isset($option['holdermar']))
      $this->holdermar = $option['holdermar'];
      if(isset($option['holderfloat']))
      $this->holderfloat = $option['holderfloat'];
      if(isset($option['vnavenable']))
      $this->vnav = $option['vnavenable'] ; 
     }
      
      function generate_theme($name){

          echo '<style>.'.$name.' {
                                    float:'.$this->holderfloat.';   
                                    margin:'.$this->holdermar.';
                                        }
                         #'.$name.' {
                                    border:'.$this->borderWidth.'px solid #'.$this->borderColor.';
                                    -webkit-border-radius: '.$this->borderRadius.'px;
                                    border-radius: '.$this->borderRadius.'px; 
                                    }
                 .'.$name.' .nivo-caption{
                                    background: none repeat scroll 0 0 #'.$this->bgColor.';
                                    opacity: '.($this->opacity/100).'; 
                                    }
                .'.$name.' .nivo-caption a {
                                    color:#'.$this->textColor.';
                                    border-bottom:1px dotted #'.$this->textColor.';
                                    }
                .'.$name.' .nivo-caption a:hover {
                                    color:#'.$this->textColor.';
                                    }
                .'.$name.' .nivo-controlNav.nivo-thumbs-enabled {
                                    width: 100%;
                                    }
                .'.$name.' .nivo-controlNav.nivo-thumbs-enabled a {
                                    width: auto;
                                    height: auto;
                                    background: none;
                                    margin-bottom: 5px;
                                    }
                .'.$name.' .nivo-controlNav.nivo-thumbs-enabled img {
                                    display: block;
                                    width: 120px;
                                    height: auto;
                                    }
                .'.$name.' .nivo-controlNav {
                                    text-align: center;
                                    margin: '.$this->navplace.';
                                    }';
          
          switch($this->arrstyle){
              case 'arr_style1':{   
                  echo '
                  .'.$name.' .nivo-directionNav a {
                                    display:block;
                                    width:50px;
                                    height:50px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/arr_style1.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    }
                .'.$name.' a.nivo-nextNav {
                                    background-position:-50px 0;
                                    right:15px;
                                    }
                .'.$name.' a.nivo-prevNav {
                                    left:15px;
                                    }';
              break;}
     
              case 'arr_style2':{ echo '
                  .'.$name.' .nivo-directionNav a {
                                    display:block;
                                    width:30px;
                                    height:30px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/arr_style2.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    }
                .'.$name.' a.nivo-nextNav {
                                    background-position:-30px 0;
                                    right:15px;
                                    }
                .'.$name.' a.nivo-prevNav {
                                    left:15px;
                                    }';
                                
              break;}
              case 'arr_style3':{ 
                  echo '
                  .'.$name.' .nivo-directionNav a {
                                    display:block;
                                    width:50px;
                                    height:50px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/arr_style3.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    }
                .'.$name.' a.nivo-nextNav {
                                    background-position:-50px 0;
                                    right:15px;
                                    }
                .'.$name.' a.nivo-prevNav {
                                    left:15px;
                                    }';
                  
              break;}
              case 'none':{
                         echo '   .'.$name.' .nivo-directionNav {
                                    display:none;
                                    text-indent:-9999px;
                                    }';
                  break;
              }
              default:{ echo '
                  .'.$name.' .nivo-directionNav a {
                                    display:block;
                                    width:30px;
                                    height:30px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/css/themes/default/arrows.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    }
                .'.$name.' a.nivo-nextNav {
                                    background-position:-30px 0;
                                    right:15px;
                                    }
                .'.$name.' a.nivo-prevNav {
                                    left:15px;
                                    }';
                  
              break;}
          }
          
          switch($this->navstyle){
              
              case 'nav_small':{
             echo '   .'.$name.' .nivo-controlNav { 
                                            background: #dfdfdf;
                                              -webkit-border-radius: 5px;
                                              -moz-border-radius: 5px;
                                              border-radius: 5px;
                                              }
                      .'.$name.' .nivo-controlNav a {
                                    background:#'.$this->bgColor.';
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background: #'.$this->textColor.';
                                    }

                ';
                  break;
              }
              case 'nav_style1':{
                        echo '     .'.$name.' .nivo-controlNav a {
                                    display:inline-block;
                                    width:16px;
                                    height:16px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_style1.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    margin: 0 2px;
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background-position:0 -16px;
                                    }

                ';
                  break;
              }
              case 'nav_style2':{
                        echo '    .'.$name.' .nivo-controlNav a {
                                    display:inline-block;
                                    width:33px;
                                    height:33px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_2.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    margin: 0 2px;
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_2_active.png) no-repeat;
                                    }

                ';
                  break;
              }
             case 'nav_style3':{
                        echo '    .'.$name.' .nivo-controlNav a {
                                    display:inline-block;
                                    width:33px;
                                    height:33px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_2.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    margin: 0 2px;
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_2_active.png) no-repeat;
                                    }

                ';
                  break;
              }
              case 'nav_style4':{
                   echo '          .'.$name.' .nivo-controlNav a {
                                    display:inline-block;
                                    width:12px;
                                    height:12px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_style_4.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    margin: 0 2px;
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background-position:0 -12px;
                                    }

                ';
                  break;
              }
              case 'nav_style5':{
                         echo '   .'.$name.' .nivo-controlNav a {
                                    display:inline-block;
                                    width:14px;
                                    height:14px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_style5.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    margin: 0 2px;
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background-position: 0 -14px;
                                    }

                ';
                  break;
              }
              case 'none':{
                         echo '   .'.$name.' .nivo-controlNav {
                                    display:none;
                                    text-indent:-9999px;
                                    }';
                  break;
              }
              default:{
                               echo '   .'.$name.' .nivo-controlNav a {
                                    display:inline-block;
                                    width:14px;
                                    height:14px;
                                    background:url('.WP_PLUGIN_URL.'/vslider/images/nav_style5.png) no-repeat;
                                    text-indent:-9999px;
                                    border:0;
                                    margin: 0 2px;
                                    }
                .'.$name.' .nivo-controlNav a.active {
                                    background-position:0 -14px;
                                    }

                ';
              }
              
          }
          switch($this->layout){
              case 'stripe-top':{
              echo '.nivo-caption {
                                    left:0px;
                                    top:0px;
                                    height:20%;}';
                  break;
              }
              case 'stripe-left':{
              echo '.nivo-caption {
                                    left:0px;
                                    top:0px;
                                    width:20%;
                                    }';
                  break;
              }
              case 'stripe-right':{
              echo '.nivo-caption {
                                    right:0px;
                                    top:0px;
                                    width:20%;}';
                  break;
              }
              
          }
        
       echo '</style>';
        }
}
?>