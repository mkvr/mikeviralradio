<?php

// Default options values
$sa_options = array(
	'ga_text' => '',
	'cat_to_exclude' => '',
	'twitter_user' => '',
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sa_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );

// Store categories in array
$sa_categories[0] = array(
	'value' => 0,
	'label' => ''
);
$sa_cats = get_categories(); $i = 1;
foreach( $sa_cats as $sa_cat ) :
	$sa_categories[$sa_cat->cat_ID] = array(
		'value' => $sa_cat->cat_ID,
		'label' => $sa_cat->cat_name
	);
	$i++;
endforeach;

function sa_theme_options() {
	// Add theme options page to the admin menu
	add_theme_page( 'Kw.po Options', 'Kw.po Options', 'edit_theme_options', 'theme_options', 'sa_theme_options_page' );
}

add_action( 'admin_menu', 'sa_theme_options' );

// Function to generate options page
function sa_theme_options_page() {
	global $sa_options, $sa_categories, $sa_layouts;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'kwpo' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e("Options saved", "kwpo"); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'sa_options', $sa_options ); ?>
	
	<?php settings_fields( 'sa_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->

	<tr valign="top"><th scope="row"><label for="cat_to_exclude" style="font-weight:bold;"><?php _e("Category to exclude", "kwpo"); ?></label></th>
	<td>
	<select id="cat_to_exclude" name="sa_options[cat_to_exclude]">
	<?php
	foreach ( $sa_categories as $category ) :
		$label = $category['label'];
		$selected = '';
		if ( $category['value'] == $settings['cat_to_exclude'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $category['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;
	?>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<p><?php _e("Enter the name of the category you want to exclude from the 'portfolio' page.", "kwpo"); ?><br /><?php _e("This category will also be considered as the 'blog' one.", "kwpo"); ?></p>
	<hr width="50%" align="left">
	</td>
	</tr>

	<tr valign="top"><th scope="row"><label for="ga_text" style="font-weight:bold;"><?php _e("Google Analytics tracking code", "kwpo"); ?></label></th>
	<td>
	<textarea id="ga_text" name="sa_options[ga_text]" rows="1" cols="30"><?php echo stripslashes($settings['ga_text']); ?></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<p><?php _e("Paste your code here... Just your code (UA-XXXXX-X), not the entire script...", "kwpo"); ?></p>
	<hr width="50%" align="left">
	</td>
	</tr>
	
	<tr valign="top"><th scope="row"><label for="ga_text" style="font-weight:bold;"><?php _e("Twitter Username", "kwpo"); ?></label></th>
	<td>
	<textarea id="ga_text" name="sa_options[twitter_user]" rows="1" cols="30"><?php echo stripslashes($settings['twitter_user']); ?></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<p><?php _e("Enter your Twitter Username here if you want to use the 'Latest Tweets' built-in widget", "kwpo"); ?></p>
	<hr width="50%" align="left">
	</td>
	</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function sa_validate_options( $input ) {
	global $sa_options, $sa_categories, $sa_layouts;

	$settings = get_option( 'sa_options', $sa_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['ga_text'] = wp_filter_post_kses( $input['ga_text'] );
	$input['twitter_user'] = wp_filter_post_kses( $input['twitter_user'] );
	
	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['cat_to_exclude'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['cat_to_exclude'], $sa_categories ) )
		$input['cat_to_exclude'] = $prev;
	
	
	return $input;
}

endif;  // EndIf is_admin()