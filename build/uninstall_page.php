<?php

/* Credits
 * Uninstall Page
 * Author: Mr.Vibe
 * Website: www.VibeThemes.com
 */
?>
<form method="post" action="">
<div class="wrap">
	<h2><?php _e('Uninstall vSlider', 'vslider'); ?></h2>
	<p>
		<?php _e('Deactivating vSlider plugin does not remove any data that may have been created, such as the slider data and the image links. To completely remove this plugin, you can uninstall it here.', 'vslider'); ?>
	</p>
	<p style="color: red">
		<strong><?php _e('WARNING:', 'vslider'); ?></strong><br />
		<?php _e('Once uninstalled, this cannot be undone. You should use a Database Backup plugin of WordPress to back up all the data first.', 'vslider'); ?>
	</p>
	<p style="color: red">
		<strong><?php _e('The following WordPress Options/Tables will be DELETED:', 'vslider'); ?></strong><br />
	</p>
	<table class="widefat" style="width: 200px;">
		<thead>
			<tr>
                         <?php
                            global $wpdb;
                            $table_name = $wpdb->prefix . "vslider"; 
                            ?>
			<th><?php 
                            _e('Table: '.$table_name, 'vslider'); 
                            ?>
                        </th>
			</tr>
		</thead>
		<tr>
			<td valign="top" class="alternate">
			<ol>
			<?php
                        $vslider_data = $wpdb->get_results("SELECT option_name FROM $table_name ORDER BY id");
                        foreach ($vslider_data as $data) {
                        echo '<li>'.$data->option_name.'</li>';
                         }
			?>
			</ol>
			</td>
		</tr>
	</table>
	<p style="text-align: center;">
		<?php 
                    _e('Do you really want to uninstall vSlider?', 'vslider'); 
                    ?>
        <br /><br />
	<input type="checkbox" name="uninstall_vslider" value="yes" />&nbsp;<?php _e('Yes', 'vslider'); ?><br /><br />
	<input type="submit" name="uninstallvslider" value="<?php _e('UNINSTALL vSlider', 'vslider'); ?>" class="button-primary" onclick="return confirm('<?php _e('You Are About To Uninstall vSlider From WordPress.\nThis Action Is Not Reversible.\n\n Choose [Cancel] To Stop, [OK] To Uninstall.', 'vslider'); ?>')" />
	</p>
</div>
</form>

