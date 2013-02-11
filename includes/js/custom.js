var $=jQuery.noConflict();
$(document).ready(function($) {
$('.vslider_shortcode').each(function(){
    var vslider=$(this).parent();
    var name = vslider.find('.vslider_name').text();
    var theme = vslider.find('.vslider_theme');
    var shortcode='[vslider name="'+name+'"]';
    $(this).text(shortcode);
    });   
});

$(document).ready(function($) {
    var vslider=$('.select_slider').val();
    if(vslider){
        var data = {
		action: 'vslider_admin',
		name: vslider
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	$.post(ajaxurl, data, function(response) {
                $('.tr_select_slider').find('.vslider_attribute').remove();
		$('.tr_select_slider').append(response);
	});
    }else{ 
    $('.select_slider').change(function(){
        var value=$(this).val();
        var data = {
		action: 'vslider_admin',
		name: value
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	$.post(ajaxurl, data, function(response) {
                $('.tr_select_slider').find('.vslider_attribute').remove();
		$('.tr_select_slider').append(response);
                
	});
         
    });
    
    }
	
});

$(document).ready(function($) {
    var vslider=$('.select_images').val();
    if(vslider){
        var data = {
		action: 'vslider_images',
		name: vslider
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	$.post(ajaxurl, data, function(response) {
                $('.tr_select_images').parent().find('.image_attribute').remove();
		$('.tr_select_images').after(response);
                vslider_call();
	});
    }
    
    $('.select_images').change(function(){
        var value=$(this).val();
        var data = {
		action: 'vslider_images',
		name: value
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	$.post(ajaxurl, data, function(response) {
                $('.tr_select_images').parent().find('.image_attribute').remove();
		$('.tr_select_images').after(response);
                vslider_call();
	});
    });
});

$(document).ready(function($) {
    $(document).delegate("#generate_slides","click",function(e){
         var data = {
		action: 'generate_slides',
                name:$('.select_images').val(),
                image_num: parseInt($('#image_num').val()),
                posttype: $('#posttype').val(),
                taxonomy: $('#taxonomy').val(),
                taxonomy_term: $('#taxonomy_term').val(),
                type: $('#selecttype').val(),
                postids: $('#postids').val()
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	$.post(ajaxurl, data, function(response) {
                    $('#default_slide').after(response);  
                    sortable_call();
	});
         
    });
});

$(document).ready(function($) {
$(document).on("change", "#imgsrc", function(){ 
        var value=$(this).val();
         if(value == 'generate'){
        var data = {
		action: 'vslider_generate_images',
                data: true
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	$.post(ajaxurl, data, function(response) {
                $('.wp-list-table').find('.generate_imgsrc').remove();
		$('.tr_imgsrc').after(response);
	});
         }else{
             $('.wp-list-table').find('.generate_imgsrc').remove();
         }
    });
    
});





$(document).ready(function($) {
   $(document).delegate("#add-slide","click",function(e){
      if($('.vslider_slides').length > 0){
          var num=parseInt($('.vslider_slides').length);
          num=num+1;
      }else{
          num=1;
      } 
      var slide=$('#default_slide').clone();
      if($('.vslider_slides').length > 0){
          slide.insertAfter('.vslider_slides:last').show(200);
      }else{
          slide.insertAfter('#default_slide').show(200);
      }
      
      slide.addClass('vslider_slides');
      slide.attr('data-num',num);
      slide.attr('id','slide'+num);
      slide.find('.image_path').attr('id','image_path'+num);
      slide.find('.image_path').attr('name','images[][src]');
      
      slide.find('.slide_num').attr('id',num);
      slide.find('.slide_num').attr('name',num);
      slide.find('.slide_num').val(num);
      
      slide.find('.link').attr('id','link'+num);
      slide.find('.link').attr('name','link'+'images['+num+'][link]');
      
      slide.find('.lightbox').attr('id','lightbox'+num);
      slide.find('.lightbox').attr('name','lightbox'+'images['+num+'][lightbox]');
      
      slide.find('.caption_title').attr('id','caption_title'+num);
      slide.find('.caption_title').attr('name','caption_title'+'images['+num+'][heading]');
      
      slide.find('.caption_desc').attr('id','caption_desc'+num);
      slide.find('.caption_desc').attr('name','caption_desc'+'images['+num+'][description]');
      
      slide.find('.upload_image_button').attr('data-num',num);
      
      sortable_call();
});

$(document).ready(function($) {
   $(document).delegate(".slide_num","change",function(e){
       var slide=$(this).parent().parent().parent().parent();
       var num=$(this).val();
      slide.attr('data-num',num);
      slide.attr('id','slide'+num);
      slide.find('.image_path').attr('id','image_path'+num);
      slide.find('.image_path').attr('name','images[][src]');
      
      slide.find('.slide_num').attr('id',num);
      slide.find('.slide_num').attr('name',num);
      slide.find('.slide_num').val(num);
      
      slide.find('.link').attr('id','link'+num);
      slide.find('.link').attr('name','link'+'images['+num+'][link]');
      
      slide.find('.lightbox').attr('id','lightbox'+num);
      slide.find('.lightbox').attr('name','lightbox'+'images['+num+'][lightbox]');
      
      slide.find('.caption_title').attr('id','caption_title'+num);
      slide.find('.caption_title').attr('name','caption_title'+'images['+num+'][heading]');
      
      slide.find('.caption_desc').attr('id','caption_desc'+num);
      slide.find('.caption_desc').attr('name','caption_desc'+'images['+num+'][description]');
      
      slide.find('.upload_image_button').attr('data-num',num);
   });
});

  $(document).delegate(".delete_slide","click",function(e){ 
     $(this).parent().parent().remove(); 
     var num = $('.vslider_slides').length;
                  for (var i = 1; i <= num; i++) {
                      $('.slide_num:eq('+i+')').val(i);
                  }
  });
});


$(document).ready(function($) {
    
var id;
$(document).delegate(".upload_image_button","click",function(e){
 id=$(this).attr('data-num');   
 formfield = $('.upload_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
    imgurl = jQuery('img',html).attr('src');
    jQuery('#image_path'+id).val(imgurl); /*assign the value to the input*/
    tb_remove();
};
});

function sortable_call(){
         var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
      };

      $(".vslider_slide_arrange tbody").sortable({
                opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.handle',
                helper: fixHelper,
                stop: function(event, ui) { 
                  var num = $('.vslider_slides').length;
                  for (var i = 1; i <= num; i++) {
                      $('.slide_num:eq('+i+')').val(i);
                  }
                }
                }).disableSelection();
}
function vslider_call(){
var id=$('.vslider').attr('id');
    var vslider=eval(id);
    if(typeof vslider !== "undefined"){
        $.extend(true,vslider_global_settings,vslider ); 
        }
   $('#'+id).flexslider(vslider_global_settings);
   
   if($('.shadow').length >0){}else{
   $('.vslider.shadow-corner ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/corner.png" class="shadow" />');
    $('.vslider.shadow-center ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/center.png" class="shadow" />');
    $('.vslider.shadow-hover ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/hover.png" class="shadow" />');
    $('.vslider.shadow-perspective ul.slides').after('<img src="'+vslider_url+'/includes/themes/shadows/perspective.png" class="shadow" />');
    }
}

$(window).load(function() {
    vslider_call();
});

  
$(document).ready(function($) {
   $('#importall').click(function(){
      $('#import').toggle(400);
   }); 
});

$(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
});


$(window).load(function() {
  $('.vibe_products').flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 176,
    directionNav:false,
    itemMargin: 10
  });
});