var $jq=jQuery.noConflict();$jq(document).ready(function(){$jq(".updated").fadeIn(1000).fadeTo(1000,1).fadeOut(1000);
$jq('.click').click(function(){var id=$jq(this).attr('id');$jq('#box'+id).slideToggle('slow',function(){})})
});

$jq(document).ready(function(){$jq('#textColor, #bgColor, #boundaryColor, #borderColor').ColorPicker({onShow:function(colpkr){$jq(colpkr).fadeIn(500);return false},onHide:function(colpkr){$jq(colpkr).fadeOut(500);return false},onSubmit:function(hsb,hex,rgb,el){$jq(el).val(hex);$jq(el).ColorPickerHide()},onBeforeShow:function(){$jq(this).ColorPickerSetColor(this.value)}}).bind('keyup',function(){$jq(this).ColorPickerSetColor(this.value)})});$jq(document).ready(function(){$jq('#holder').change(function(){switch($jq('#holder').val()){case'ipadsmall':{$jq('#holdersrc').val('../images/ipad400x312.png');$jq('#holderpad').val('20px 0 0 20px');$jq('#holdermar').val('0 0 10px 0');break}case'ipadbig':{$jq('#holdersrc').val('../images/ipad540x420.png');$jq('#holderpad').val('40px 0 0 40px');$jq('#holdermar').val('0 0 10px 0');break}case'ipadvertical':{$jq('#holdersrc').val('../images/ipad420x540.png');$jq('#holderpad').val('40px 0 0 40px');$jq('#holdermar').val()='0 0 10px 0';break}case'imac':{$jq('#holdersrc').val('../images/imac449x417.png');$jq('#holderpad').val('15px 0 0 15px');$jq('#holdermar').val()='0 0 10px 0';break}default:{}}})});$jq(document).ready(function(){$jq('#majorshadow').change(function(){$jq('#pminorshadow').show();switch($jq('#majorshadow').val()){case'left RightWarpShadow':{$jq('#minorshadow').append('<option value="WLarge WNormal" selected="selected">Large-Normal</option>');$jq('#minorshadow').append('<option value="WLarge WDark">Large-Dark</option>');break}case'right LeftWarpShadow':{$jq('#minorshadow').append('<option value="WLarge WNormal" selected="selected">Large-Normal</option>');$jq('#minorshadow').append('<option value="WLarge WDark">Large-Dark</option>');break}case'LeftPerspectiveShadow':{$jq('#minorshadow').append('<option value="LPLarge LPNormal" selected="selected">Large-Normal</option>');$jq('#minorshadow').append('<option value="LPMedium LPNormal" >Medium-Normal</option>');$jq('#minorshadow').append('<option value="LPSmall LPNormal" >Normal-Small</option>');break}case'RightPerspectiveShadow':{$jq('#minorshadow').append('<option value="RPLarge RPNormal" selected="selected">Large-Normal</option>');$jq('#minorshadow').append('<option value="RPMedium RPNormal" >Medium-Normal</option>');$jq('#minorshadow').append('<option value="RPSmall RPNormal" >Normal-Small</option>');break}case'left BottomShadow':{$jq('#minorshadow').append('<option value="BSmall BLight" selected="selected">Small-Light</option>');$jq('#minorshadow').append('<option value="BSmall BDark">Small-Dark</option>');break}case'right BottomShadow':{$jq('#minorshadow').append('<option value="BSmall BNormal" selected="selected">Small-Normal</option>');$jq('#minorshadow').append('<option value="BSmall BDark">Small-Dark</option>');break}}})});$jq(document).ready(function(){$jq('.tooltip span').css({'opacity':0.4}).animate({'opacity':1},1000)});