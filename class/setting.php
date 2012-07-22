<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class vslider_settings
{     
      var   $name = 'vs_settings';
      var   $effect= 'random';
      var   $slices = 15;
      var   $boxCols= 8; //spw
      var   $boxRows= 4; //sph
      var   $animSpeed= 500; //sdelay
      var   $pauseTime= 3000; //delay
      var   $startSlide= 0;
      var   $directionNav= true;  //'navigation' => true,
      var   $directionNavHide= true; //'stickynav' => false,
      var   $controlNav= true;        //'buttons' => true,
      var   $controlNavThumbs= false;
      var   $pauseOnHover= true;
      var   $manualAdvance= false;
      var   $prevText='Prev';
      var   $nextText='Next';
      var   $randomStart= false;  //rand
        /*'beforeChange'  function(){},
        afterChange: function(){},
        slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}*/
      
      function _construct(){
        $this->name='vs_settings';  
        $this->effect = 'random';
        $this->slices = 15;
        $this->boxCols = 8; //spw
        $this->boxRows = 4; //sph
        $this->animSpeed = 500; //sdelay
        $this->pauseTime = 3000; //delay
        $this->startSlide = 0;
        $this->directionNav = true;  //'navigation' => true,
        $this->directionNavHide = true; //'stickynav' => false,
        $this->controlNav = true;        //'buttons' => true,
        $this->controlNavThumbs = false;
        $this->pauseOnHover = true;
        $this->manualAdvance = false;
        $this->prevText= 'Prev';
        $this->nextText = 'Next';
        $this->randomStart = false;  //rand
        /*'beforeChange' => function(){},
        afterChange: function(){},
        slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}*/
      }
      
      function save()
       {
       $message = '<div class="updated" id="message"><p><strong>Settings Saved</strong></p></div>';
        $this->effect = $_POST['effect'];
        $this->slices = $_POST['slices'];
        $this->boxCols = $_POST['boxCols']; //spw
        $this->boxRows = $_POST['boxRows']; //sph
        $this->animSpeed = $_POST['animSpeed']; //sdelay
        $this->pauseTime = $_POST['pauseTime']; //delay
        $this->startSlide = $_POST['startSlide'];
        $this->directionNav = $_POST['directionNav'];  //'navigation' => true,
        $this->directionNavHide = $_POST['directionNavHide']; //'stickynav' => false,
        $this->controlNav = $_POST['controlNav'];        //'buttons' => true,
        $this->controlNavThumbs = $_POST['controlNavThumbs'];
        $this->pauseOnHover = $_POST['pauseOnHover'];
        $this->manualAdvance = $_POST['manualAdvance'];
        $this->prevText= $_POST['prevText'];
        $this->nextText = $_POST['nextText'];
        $this->randomStart = $_POST['randomStart'];  //rand
        update_option($this->name, serialize($this));
        return $message;
      }
      
      function reinitialize($name){
          $this->name=$name;
      }
      function generate_setting($name){
     
                    ($this->directionNav == true) ? $dn= 'true': $dn= 'false' ;
                    ($this->directionNavHide == true ) ? $dnh= 'true': $dnh= 'false' ;
                    ($this->controlNav > 0 ) ? $cn= 'true': $cn= 'false' ;
                    ($this->controlNavThumbs > 0 ) ? $cnt= 'true': $cnt= 'false' ;
                    ($this->pauseOnHover > 0 ) ? $poh= 'true': $poh= 'false' ;
                    ($this->manualAdvance > 0 ) ? $ma= 'true': $ma= 'false' ;
          ?>
        <script type="text/javascript">
                $(window).load(function() {
                        $('#<?php echo $name; ?>').nivoSlider({ <?php
                    echo '
                    effect:"'. $this->effect.'",
                    slices: '. $this->slices.',
                    boxCols: '. $this->boxCols.',
                    boxRows: '. $this->boxRows.',
                    animSpeed: '. $this->animSpeed.',
                    pauseTime: '. $this->pauseTime.',
                    startSlide: '. $this->startSlide.',
                    directionNav: '.$dn.',
                    directionNavHide: '.$dnh.',
                    controlNav: '.$cn.',
                    controlNavThumbs: '.$cnt.',
                    pauseOnHover: '.$poh.',
                    manualAdvance: '.$ma;        
                    
                    ?>
                     });
                 });
        </script>
    <?php
    
        }
  
}


?>