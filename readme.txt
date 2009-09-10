=== vSlider ===
Contributors: VibeThemes.com
Donate link: http://www.vibethemes.com/wordpress-plugins/vslider-wordpress-image-slider-plugin/
Tags: image, gallery, slider, image slider, content slider, featured category, featured posts, featured images
Requires at least: 2.7
Tested up to: 2.8.4
Stable tag: 1.1

vSlider help you create an image slider featured section in your site. Images can be featured from a specific category or inserting your own images.

== Description ==

**vSlider is a jQuery based image slide show** script that can display specific images on your WordPress based website with fading or sliding transitions. This way you can future the more important pages or products from your website or even other websites.

How is different vSlider from any other WordPress image slider plugins? The answer is simple! It makes use of the core WordPress jQuery library, this makes it very tiny and you don't have to have any knowledge of coding for using it! But the best part is just to come! It can use images from your posts using custom fields or scanning for images in the post to feature your latest posts from a specific category (for example a featured category), this way with every new post the slider will automatically update it self, so NO extra work for you. Or you can add your own images and where each image links to. vSlider is tested in different browsers and all settings are made from an easy to use options page.

You can set up:

* How many latest posts to rotate.
* Up to 5 custom images and links.
* Slider width and height.
* Animation Speed.
* Transition mode (fade and slide).
* Customize CSS to integrate it better in your WordPress theme.

**vSlider Demo: [View Demo](http://www.vibethemes.com/ "Premium WordPress Themes")**

= Usage: =

After you installed and activated the plugin and placed this code **`<?php if (function_exists('vSlider')) { vSlider(); }?>`** in your template file where you want the slider to appear:

1. Set the slider with and height, the animation type, speed, number of post to feature and the featured category from the vSlider options menu.
1. Set up custom CSS code for vSlider (for advanced users) from vSlider options menu.
1. Add the path to the images and where to link if you want to use custom images.

The vSlider WordPress plugin will scan the posts from the selected category and will show the first image found on the post. The image will be resized as you selected from the slider menu. If the image does not fit well from your post to the slider, simply edit your post, go to custom fields and add a new custom field named "slider" and as value add the path to the image you want to appear in the slider. In this case vSlider will pick the image added in the custom field.

vSlider make use of the [jQuery InnerFade](http://medienfreunde.com/lab/innerfade/ "jQuery InnerFade") script.

== Installation ==

In order to install vSlider plugin you need to do the following:

1. Upload vSlider folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place **`<?php if (function_exists('vSlider')) { vSlider(); }?>`** in your template file outside of [the loop](http://codex.wordpress.org/The_Loop "the loop") in your theme to where you want the slider to appear.

= Example of usage: =

**For using on homepage** you need to insert the code snippet into the homepage template.

*wp-content/themes/&lt;name of theme&gt;/index.php*

`<div id="content" class="narrowcolumn">

    <!-- You can put here the vSlider call -->
    <?php if (function_exists('vSlider')) { vSlider(); }?>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

            <!-- The Loop -->

		<?php endwhile; ?>`

**For using on header** you need to insert the code snippet into the header template.

*wp-content/themes/&lt;name of theme&gt;/header.php*

`<div id="header">
	<div id="headerimg">
        <!-- You can put here the vSlider call -->
        <?php if (function_exists('vSlider')) { vSlider(); }?>
	</div>
</div>`

**For using on sidebar** you need to insert the code snippet into the sidebar template.

*wp-content/themes/&lt;name of theme&gt;/sidebar.php*

`<div id="sidebar">
		<ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			<li>
                <!-- You can put here the vSlider call -->
                <?php if (function_exists('vSlider')) { vSlider(); }?>
			</li>
        </ul>`

== Frequently Asked Questions ==

= Error: Result of expression 'jQuery('ul#sliderbody').innerfade' [undefined] is not a function =

It might be result of installing the plugin from the WordPress dashboard > Plugins > Add New. In some cases the script -vSlider.js- is not uploaded in the plugin folder. If is the case, upload the plugin in the classic way: Upload with your preferred FTP program the vSlider plugin to wp-content/plugins folder and activate the plugin from your dashboard.

= I sell stuff on my site. Can I use this plugin on my commercial site to promote my products? =

Sure, this is why the plugin is here.

= If I donate to this plugin can I get some extra help for setting it up? =

You do not need to donate for getting extra help. Contact me trough my [site](http://www.vibethemes.com/ "Premium WordPress Themes") and if I have the time I help you with pleasure. No donation is needed for that. By donating you show your appreciation and support the work, there is no extra thing for it.

== Screenshots ==

1. vSlider configuration page

== Changelog ==

Feel free to [contact me](http://www.vibethemes.com/ "Premium WordPress Themes") with ideas of improving this plugin. Your name and link will appear on this change log and the [plugin page](http://www.vibethemes.com/wordpress-plugins/vslider-wordpress-image-slider-plugin/ "Premium WordPress Themes").


     Version Date       Changes
     1.2     2009/09/10 Debuging.
     1.1     2009/09/05 Force to apply 0 margin and padding to vSlider unordered list.
     1.0     2009/07/20 Initial release of vSlider plugin