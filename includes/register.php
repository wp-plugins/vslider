<?php

/**
 * FILE: register.php 
 * Created on Feb 1, 2013 at 1:42:45 PM 
 * Author: Mr.Vibe 
 * Credits: www.VibeThemes.com
 * Project: vSlider
 * License: GPLv2
 */



add_action( 'admin_enqueue_scripts', 'enqueue_vslider_admin_styles' );
function enqueue_vslider_admin_styles() {
        
        
        wp_enqueue_style('vslider-admin-css', VSLIDER_URL.'/includes/css/admin.css');
        wp_enqueue_style('vslider-css', VSLIDER_URL.'/includes/css/vslider.css');
        wp_enqueue_style('vslider-classic-css', VSLIDER_URL.'/includes/themes/classic/classic.css');
        wp_enqueue_style('vslider-creative-css', VSLIDER_URL.'/includes/themes/creative/creative.css');
        wp_enqueue_style('vslider-minimal-css', VSLIDER_URL.'/includes/themes/minimal/minimal.css');
        wp_enqueue_style('vslider-elegant-css', VSLIDER_URL.'/includes/themes/elegant/elegant.css');
        wp_enqueue_style('prettyPhoto-css', VSLIDER_URL.'/includes/css/prettyPhoto.css');
        wp_enqueue_style('thickbox');

}

add_action( 'admin_footer', 'enqueue_vslider_admin_scripts' );
function enqueue_vslider_admin_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script( 'prettyPhoto-js', VSLIDER_URL.'/includes/js/jquery.prettyPhoto.js', array('jquery'));
        wp_enqueue_script( 'flexslider', VSLIDER_URL.'/js/jquery.flexslider-min.js', array('jquery'));
        vslider_global_settings();
        global $vslider_script;
        echo '<script type="text/javascript">'.$vslider_script.'</script>';
        wp_enqueue_script( 'ajax-script', VSLIDER_URL.'/includes/js/custom.js', array('jquery'));
    
}

add_action( 'wp_enqueue_scripts', 'enqueue_vslider_styles' );
function enqueue_vslider_styles() {
        wp_enqueue_style('vslider-css', VSLIDER_URL.'/includes/css/vslider.css');
        wp_enqueue_style('vslider-classic-css', VSLIDER_URL.'/includes/themes/classic/classic.css');
        wp_enqueue_style('vslider-creative-css', VSLIDER_URL.'/includes/themes/creative/creative.css');
        wp_enqueue_style('vslider-minimal-css', VSLIDER_URL.'/includes/themes/minimal/minimal.css');
        wp_enqueue_style('vslider-elegant-css', VSLIDER_URL.'/includes/themes/elegant/elegant.css'); 
        wp_enqueue_style('prettyPhoto-css', VSLIDER_URL.'/includes/css/prettyPhoto.css');
}

add_action( 'wp_footer', 'enqueue_vslider_scripts' );
function enqueue_vslider_scripts() {  
        vslider_global_settings();
        global $vslider_script;
        echo '<script type="text/javascript">'.$vslider_script.'</script>';
        
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'flexslider', VSLIDER_URL.'/js/jquery.flexslider-min.js', array('jquery'));
        wp_enqueue_script( 'prettyPhoto-js', VSLIDER_URL.'/includes/js/jquery.prettyPhoto.js', array('jquery'));
        wp_enqueue_script( 'custom-script', VSLIDER_URL.'/js/custom.js', array('jquery'));
}



add_action( 'init', 'vslider_admin_init' );
add_action( 'admin_menu', 'vslider_settings_page_init' );

function vslider_admin_init() {
	$global_settings = get_option( "vslider_global_settings" );
	if ( empty( $global_settings ) ) {
                global $global_settings;
		add_option( "vslider_global_settings", $global_settings, '', 'yes' );
	}	
}

function vslider_settings_page_init() {
    $settings_page = add_menu_page( 'vSlider 5.0', 'vSlider', 'publish_posts', 'vslider', 'vslider_settings_page', VSLIDER_URL.'/includes/images/icon.png' );
	
	//add_action( "load-{$settings_page}", 'vibe_backup_load_settings_page' );
}


function vslider_admin_tabs( $current = 'main' ) { 
    $tabs = array( 'main' => 'vSlider 5.0', 'settings' => 'Settings', 'images' => 'Images', 'global-settings' => 'Global Settings', 'more' => 'More' ); 
    $links = array();
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=vslider&tab=$tab'>$name</a>";
        
    }
    echo '</h2>';
}

function vslider_settings_page() {
	global $pagenow;
	//$settings = get_option( "vslider_settings" );
        $vslider= new vSlider();
       
	?>
	
	<div class="wrap">
		<h2><?php _e('Welcome to vSlider 5.0','vslider'); ?></h2>
		
		<?php
			if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Settings updated.</p></div>';
			
			if ( isset ( $_GET['tab'] ) ) vslider_admin_tabs($_GET['tab']); 
                        else vslider_admin_tabs('main');
		?>

		<div id="poststuff">
			<?php
				if ( $pagenow == 'admin.php' && $_GET['page'] == 'vslider' ){ 
				
					if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
					else $tab = 'main'; 
					
					
					switch ( $tab ){
                                                
						case 'main' :
							$vslider->get_vsliders();
						break;
						case 'settings' :
							$vslider->settings();
						break; 
                                                case 'images' :
							$vslider->images();
						break;
                                                case 'global-settings' :
							global_settings();
						break;
                                                case 'help' :
							$vslider->settings();
						break;
						case 'more' : 
							?>
		<table class="wp-list-table widefat fixed">
                <tbody>
                <tr>
                <td><img src="<?php echo VSLIDER_URL.'/includes/images/donate.png'; ?>" style="float:left;" /><p style="padding:5px 40px 0;"><?php _e('Support Us, Buy me a Coffee','vslider'); ?></p> </td>
                <td><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=19&currency_code=USD" target="_blank" class="button-primary">$19 USD</a> 
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=15&currency_code=USD" target="_blank" class="button">$15 USD</a> 
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=9&currency_code=USD" target="_blank" class="button">$9 USD</a> 
                     <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=7&currency_code=USD" target="_blank" class="button">$7 USD</a> 
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=5&currency_code=USD" target="_blank" class="button">$5 USD</a> 
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=3&currency_code=USD" target="_blank" class="button">$3 USD</a>
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=99fusion%40gmail.com&item_name=vSlider Donation&no_note=1&tax=0&amount=1&currency_code=USD" target="_blank" class="button">$1 USD</a>
                </td>
                </tr>
                <tr>
                <td><label style="padding:5px 0;">Important Links</label> </td>
                <td>
                    <a href="http://vibethemes.com/forums/forumdisplay.php?30-vSlider" target="_blank" class="button-primary">vSlider Support Forums</a>
                    <a href="http://www.vibethemes.com/vslider-wordpress-plugin/" target="_blank" class="button">vSlider plugin page</a>
                </td>
                </tr>
                <tr>
                <td colspan="2"><h2> Checkout awesome products from VibeThemes:</h2> </td>
                </tr>
                <tr>
                <td colspan="2">
                    <div class="vibe_products">
                        <ul class="slides">
                            <li>
                               <div class="product">
                                <div class="featured_r"></div> 
                                  <a href="http://themeforest.net/item/vibecom-responsive-mutipurpose-wordpress-theme/3805977?ref=vibethemes" target="_blank">
                                    <img src="<?php echo VSLIDER_URL.'/includes/images/vibecom.png'; ?>" alt="vibecom">
                                    <h2 style="line-height: 20px;"> VibeCom Responsive Muti-Purpose WordPress Theme</h2></a>
                                    <p>Multipurpose Responsive Theme, Page Builder, 25+ drag drop templates,Live Color/Font Changer ......</p>
                                </div>   
                            </li>
                            <li>
                               <div class="product">
                                <div class="featured_r"></div> 
                                  <a href="http://www.vibethemes.com/wppinteresttheme-pinterest-inspired-wordpress-theme/" target="_blank">
                                    <img src="<?php echo VSLIDER_URL.'/includes/images/wppinteresttheme.png'; ?>" alt="wppinteresttheme">
                                    <h2 style="line-height: 20px;"> WPPinterestTheme : Pinterest inspired WordPress Theme</h2></a>
                                    <p>Pinterest Inspired responsive WordPress theme, infinite scroll, advanced search, ...</p>
                                </div>   
                            </li>
                            <li>
                               <div class="product">
                                <div class="free_r"></div> 
                                  <a href="http://www.vibethemes.com/vibelivre-free-responsive-portfolio-wordpress-theme/" target="_blank">
                                    <img src="<?php echo VSLIDER_URL.'/includes/images/vibelivre.png'; ?>" alt="vibelivre">
                                    <h2 style="line-height: 20px;">  VibeLivre: Free Responsive Portfolio WordPress Theme</h2></a>
                                    <p>Showcase your work using this awesome free WordPress Responsive Theme for creative...</p>
                                </div>   
                            </li>
                            <li>
                               <div class="product">
                                <div class="free_r"></div> 
                                  <a href="http://www.vibethemes.com/vflex-free-responsive-wordpress-theme/" target="_blank">
                                    <img src="<?php echo VSLIDER_URL.'/includes/images/vFlex.png'; ?>" alt="vFlex">
                                    <h2 style="line-height: 20px;"> vFlex : Free Responsive WordPress Theme</h2></a>
                                    <p>A Free Responsive Theme for WordPress Designers, Bloggers and media companies......</p>
                                </div>   
                            </li>
                            <li>
                               <div class="product">
                                <div class="featured_r"></div> 
                                  <a href="http://www.vibethemes.com/vcandy-fastest-wordpress-theme/" target="_blank">
                                    <img src="<?php echo VSLIDER_URL.'/includes/images/vcandy.png'; ?>" alt="vcandy">
                                    <h2 style="line-height: 20px;"> vCandy : Fastest WordPress Theme</h2></a>
                                    <p>vCandy the Fastest wordpress theme, loads faster than Twenty Eleven, CSS sprites ...</p>
                                </div>   
                            </li>
                        </ul>   
                    </div> 
                </td>
                </tr>
                </tbody>
                </table>
							<?php
						break;
					}
					
				}
				?>
			</form>
		</div>

	</div>
<?php
}


function getall_taxonomy_terms(){
$taxonomies=get_taxonomies('','names'); 
$termchildren = array();
    foreach ($taxonomies as $taxonomy ) {
        $toplevelterms = get_terms($taxonomy, 'hide_empty=0&hierarchical=0&parent=0');
        	foreach ($toplevelterms as $toplevelterm) {
            $termchildren[ $toplevelterm->slug] = $toplevelterm->name;//
        		}
          }
    return $termchildren;  
}


function vslider_global_settings(){ 
    global $vslider_script;
   $vslider_global_settings=get_option('vslider_global_settings');
   $vslider_script.='var vslider_global_settings = {';
    if(isset($vslider_global_settings)){
        foreach($vslider_global_settings as $key=>$value){
            if(isset($value))
            $vslider_script.= '"'.$key.'" : '.$value.',';
        } 
   $vslider_script.= '}; var vslider_url="'.VSLIDER_URL.'";';  
    }
}
?>
