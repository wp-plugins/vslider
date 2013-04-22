<?php

/*
Plugin Name: vSlider
Plugin URI: http://www.vibethemes.com
Description: Implementing a featured image gallery into your WordPress theme has never been easier! Showcase your portfolio, animate your header or manage your banners with vSlider.Create unlimited image sliders, the best wordpress image slider plugin vSlider by  <a href="http://www.vibethemes.com/" title="premium wordpress themes">VibeThemes</a>.
Author: Mr.Vibe@VibeThemes.Com
Version: 5.0.1
Author URI: http://www.vibethemes.com
Text Domain: vslider
Domain Path: /includes/lang/
*/

/*      vSlider is released under GPL v 2:
	http://www.opensource.org/licenses/gpl-license.php

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
	ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
	WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
	DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
	ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
	(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
	LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
	ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
	(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
	SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

/*====== BEGIN VSLIDER======*/

include_once('includes/config.php');
include_once('classes/vslider.class.php');
include_once('includes/functions.php');
include_once('includes/register.php');
include_once('includes/shortcode.php');
include_once('includes/widget.php');

/*====== END VSLIDER ======*/


/*====== INSTALLATION HOOKS VSLIDER======*/        
// Runs when plugin is activated and creates new database field
register_activation_hook(__FILE__,'vslider5_plugin_install');
function vslider5_plugin_install() {
    add_option('vslider_support', 0);
    global $wpdb;
	$table_name = $wpdb->prefix . "vslider"; 
    
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  option_name VARCHAR(255) NOT NULL DEFAULT  'vslider_options',
		  active tinyint(1) NOT NULL DEFAULT  '0',
		  PRIMARY KEY (`id`),
          UNIQUE (
                    `option_name`
            )
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

}

// Runs on plugin deactivation and deletes the database field
register_deactivation_hook( __FILE__, 'vslider5_plugin_remove' );
function vslider5_plugin_remove() {
    global $wpdb;
	$table_name = $wpdb->prefix . "vslider"; 
    $vslider_data = $wpdb->get_results("SELECT option_name FROM $table_name ORDER BY id");
    foreach ($vslider_data as $data) {
        delete_option($data->option_name);
        }
    $sql = "DROP TABLE " . $table_name;
		$wpdb->query( $sql );
}

?>
