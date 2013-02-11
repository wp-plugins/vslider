/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var $ = jQuery.noConflict();


$(window).load(function() {
    var vslider=eval($('.vslider').attr('id'));
    if(typeof vslider !== "undefined"){
        $.extend(true,vslider_global_settings,vslider ); 
        }
   $('.vslider').flexslider(vslider_global_settings);
   
    if($('.shadow').length >0){}else{
   $('.vslider.shadow-corner ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/corner.png" class="shadow" />');
    $('.vslider.shadow-center ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/center.png" class="shadow" />');
    $('.vslider.shadow-hover ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/hover.png" class="shadow" />');
    $('.vslider.shadow-perspective ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/perspective.png" class="shadow" />');
    }
});

$(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
});