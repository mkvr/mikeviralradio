<?php

/* Settings for the theme
-------------------------------------------------------------- */
include('theme-options.php');

/* Enabling WP Menus
-------------------------------------------------------------- */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array(
		'primary' => 'Primary Navigation'
						)
	);
}

/* Sidebars
-------------------------------------------------------------- */
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}
if ( function_exists( 'add_image_size' ) ) {
  add_image_size('kw-big',610,400,true);
  add_image_size('kw-blog',300,300,true);
  add_image_size('kw-feat',300,200,true);
  add_image_size('kw-small',150,100,true);
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Area 01',
		'id'   => 'area-01',
		'description'   => __('Widgetized area 01', 'kwpo'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Area 02',
		'id'   => 'area-02',
		'description'   => __('Widgetized area 02', 'kwpo'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Area 03',
		'id'   => 'area-03',
		'description'   => __('Widgetized area 03', 'kwpo'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
    register_sidebar(array(
        'name'=>'Sidebar Contact',
        'id' => 'sidebar-contact',
		'description'   => __('Sidebar for the contact page', 'kwpo'),
		'before_widget' => '<div class="side_box">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
    register_sidebar(array(
        'name'=>'Sidebar Posts',
        'id' => 'sidebar-posts',
		'description'   => __('Sidebar for the posts', 'kwpo'),
		'before_widget' => '<div class="side_box">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}

/* WordPress Post Pagination without plugin
  Credit to Christian Kriesi
-------------------------------------------------------------- */

function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/* Twitter Widget
-------------------------------------------------------------- */
add_action( 'widgets_init', 'latest_tweet_widget' );

function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Latest_Tweets() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => '', 'description' => __('Display a list of latest tweets', 'kwpo') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest-tweets-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'latest-tweets-widget', __('Kwpo Latest Tweets', 'kwpo'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = $instance['no_of_tweets'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		if ( $title )
			echo '<h2 class="twitter">'. $title . $after_title;

		if ( $no_of_tweets )?>
			<div id="twitterBox">
				<ul id="twitter_update_list"></ul>
			</div>
			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/
					<?php 
					global $sa_options;
					$sa_settings = get_option( 'sa_options', $sa_options );
					$gt = $sa_settings['twitter_user'];
					echo $gt; ?>
				.json?callback=twitterCallback3&amp;count=<?php echo $no_of_tweets ?>">
			</script>
			<div class="clear"></div>
	<?php 

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Our Latest Tweets', 'kwpo'), 'no_of_tweets' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kwpo'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>


		<!-- No of Tweets: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e('No. of Tweets:', 'kwpo'); ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo $instance['no_of_tweets']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
	

/* Recent Posts Widget
-------------------------------------------------------------- */
class kw_recent_posts extends WP_Widget {

	function kw_recent_posts() {
		parent::WP_Widget(false, $name = 'Kwpo Recent Posts', array('name' => __('Kwpo Recent Posts', 'kwpo'), 'description' => __('Display a list of the most recent posts', 'kwpo')));
	}

	function widget($args, $instance) {
		$args['title'] = $instance['title'];
		kw_func_recentposts($args);
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<?php
	}
 }
function kw_func_recentposts($args = array(), $displayComments = TRUE, $interval = '') {

	global $wpdb;

        echo $args['before_widget'] . $args['before_title'] . $args['title'] . $args['after_title'];
        ?>
        <ul class="recent_posts_list">
           <?php
           global $post;
           $myposts = get_posts('numberposts=5');
           foreach($myposts as $post) :
             setup_postdata($post);
           ?>
          <li style="list-style-type:none;">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(70,70) ); ?></a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p><img class="tiny" src="<?php bloginfo( 'template_url' ); ?>/images/label.png"> <?php the_category(', ') ?></p>
          <div class="clear"></div>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php
        wp_reset_query();
        
        echo $args['after_widget'];

}
register_widget('kw_recent_posts');  

/* Social Widget
-------------------------------------------------------------- */
class kw_social extends WP_Widget {

	function kw_social() {
		parent::WP_Widget(false, $name = 'Kwpo Social Medias', array('name' => __('Kwpo Social Medias', 'kwpo'), 'description' => __('Display a list of your Social Medias accounts', 'kwpo')));
	}

	function widget($args, $instance) {
                $args['social_title'] = $instance['social_title'];
				$args['dribbble_link'] = $instance['dribbble_link'];
                $args['forrst_link'] = $instance['forrst_link'];
                $args['facebook_link'] = $instance['facebook_link'];
                $args['twitter_link'] = $instance['twitter_link'];
                $args['pinterest_link'] = $instance['pinterest_link'];
                $args['rss_link'] = $instance['rss_link'];
		kw_func_social($args);
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
                $social_title = esc_attr($instance['social_title']);
				$dribbble_link = esc_attr($instance['dribbble_link']);
                $forrst_link = esc_attr($instance['forrst_link']);
                $facebook_link = esc_attr($instance['facebook_link']);
                $twitter_link = esc_attr($instance['twitter_link']);
                $pinterest_link = esc_attr($instance['pinterest_link']);
                $rss_link = esc_attr($instance['rss_link']);
?>
                <p><label for="<?php echo $this->get_field_id('social_title'); ?>"><?php _e("Title:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('social_title'); ?>" name="<?php echo $this->get_field_name('social_title'); ?>" type="text" value="<?php echo $social_title; ?>" /></label></p>
				<p><label for="<?php echo $this->get_field_id('dribbble_link'); ?>"><?php _e("Dribbble Link:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('dribbble_link'); ?>" name="<?php echo $this->get_field_name('dribbble_link'); ?>" type="text" value="<?php echo $dribbble_link; ?>" /></label></p>
                <p><label for="<?php echo $this->get_field_id('forrst_link'); ?>"><?php _e("Forrst Link:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('forrst_link'); ?>" name="<?php echo $this->get_field_name('forrst_link'); ?>" type="text" value="<?php echo $forrst_link; ?>" /></label></p>
                <p><label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e("Facebook Link:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo $facebook_link; ?>" /></label></p>
                <p><label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e("Twitter Link:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo $twitter_link; ?>" /></label></p>
                <p><label for="<?php echo $this->get_field_id('pinterest_link'); ?>"><?php _e("Pinterest Link:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('pinterest_link'); ?>" name="<?php echo $this->get_field_name('pinterest_link'); ?>" type="text" value="<?php echo $pinterest_link; ?>" /></label></p>
                <p><label for="<?php echo $this->get_field_id('rss_link'); ?>"><?php _e("RSS Link:", "kwpo"); ?> <input class="widefat" id="<?php echo $this->get_field_id('rss_link'); ?>" name="<?php echo $this->get_field_name('rss_link'); ?>" type="text" value="<?php echo $rss_link; ?>" /></label></p>
<?php
	}
 }
function kw_func_social($args = array(), $displayComments = TRUE, $interval = '') {

	global $wpdb;

        //echo $args['before_widget'] . $args['before_title'] . $args['title'] . $args['after_title'];
        echo $args['before_widget'] . $args['before_title'] . $args['social_title'] . $args['after_title'];
        ?>
        <ul class="social_medias">
        	<?php if ($args['facebook_link'] != '') { ?>
          <li><a href="<?php echo $args['facebook_link']; ?>" target="_blank">Facebook</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" /></li>
          	<?php } ?>
        	<?php if ($args['twitter_link'] != '') { ?>
          <li><a href="<?php echo $args['twitter_link']; ?>" target="_blank">Twitter</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" /></li>
          	<?php } ?>
        	<?php if ($args['dribbble_link'] != '') { ?>
          <li><a href="<?php echo $args['dribbble_link']; ?>" target="_blank">Dribbble</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/dribbble.png" /></li>
          	<?php } ?>
        	<?php if ($args['forrst_link'] != '') { ?>
          <li><a href="<?php echo $args['forrst_link']; ?>" target="_blank">Forrst</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/forrst.png" /></li>
          	<?php } ?>
        	<?php if ($args['pinterest_link'] != '') { ?>
          <li><a href="<?php echo $args['pinterest_link']; ?>" target="_blank">Pinterest</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/pinterest.png" /></li>
          	<?php } ?>
        	<?php if ($args['rss_link'] != '') { ?>
          <li><a href="<?php echo $args['rss_link']; ?>" target="_blank"><?php _e("Subscribe to our RSS", "kwpo"); ?></a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" /></li>
          	<?php } ?>
        </ul>
        <?php
        
        echo $args['after_widget'];

}
register_widget('kw_social');  

/* Post Limit 
-------------------------------------------------------------- */
function my_post_limit($limit) {
	global $paged, $myOffset;
	if (empty($paged)) {
			$paged = 1;
	}
        $postperpage = 4;
	$pgstrt = ((intval($paged) -1) * $postperpage) + $myOffset . ', ';
	$limit = 'LIMIT '.$pgstrt.$postperpage;
	return $limit;
}


/* Custom Navigation Menu 
   Allows for us to use the Description field
   as the sub-text to the navigation.
   Credit to Christian Kriesi
   for the initial example of this walker class
-------------------------------------------------------------- */
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong><br />';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}


/* Post Thumbnail Caption
-------------------------------------------------------------- */
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
}

/* Adding rel="lightbox" to all images
-------------------------------------------------------------- */
function fb_add_lightbox($content){
	$content = preg_replace('/<a(.*?)href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"(.*?)><img/U', '<a$1href="$2.$3" $4 rel="lightbox"><img', $content);
	return $content;
}
add_filter('the_content', 'fb_add_lightbox', 2);


/* Loading jQuery from the Google CDN
-------------------------------------------------------------- */
// * even more smart jquery inclusion :)
 add_action( 'init', 'jquery_register' );

// * register from google and for footer
 function jquery_register() {

if ( !is_admin() ) {

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' ), false, null, true );
    wp_enqueue_script( 'jquery' );
}
}

/* Replace Default Gravatar with Custom Image
-------------------------------------------------------------- */
function custom_gravatar($avatar_defaults) {
    $logo = get_bloginfo('template_directory') . '/images/gravatar_logo.png';
    $avatar_defaults[$logo] = get_bloginfo('name');
    return $avatar_defaults;
}//END FUNCTION    
add_filter( 'avatar_defaults', 'custom_gravatar' );

/* Sharing (FB + Twitter) Shortcode
-------------------------------------------------------------- */
function shreplz() {
   return '
    <div class="sharebox">
    <div class="shareface"><a name="fb_share"></a> <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></div>
    <div class="twittme"><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></div>
    <br style="clear: left;" />
    </div>
   ';
}
add_shortcode('sharethis', 'shreplz');

/* Drop Caps Shortcode
-------------------------------------------------------------- */
function dropcap($atts, $content = null) {
	return '<span class="dropcap">'.$content.'</span>';
}
add_shortcode('dropcap', 'dropcap');

/* Columns Shortcodes
-------------------------------------------------------------- */
function kwpo_columns($atts, $content = null, $name='') {
	
	$content = do_shortcode($content);
	
	$pos = strpos($name,'_last');	

	if($pos !== false)
		$name = str_replace('_last',' last',$name);
	
	$output = "<div class='{$name}'>
					{$content}
				</div>";
	if($pos !== false) 
		$output .= "<div class='clear'></div>";
	
	return $output;
}
add_shortcode('one_half', 'kwpo_columns');
add_shortcode('one_half_last', 'kwpo_columns');
add_shortcode('one_third', 'kwpo_columns');
add_shortcode('one_third_last', 'kwpo_columns');
add_shortcode('one_fourth', 'kwpo_columns');
add_shortcode('one_fourth_last', 'kwpo_columns');
add_shortcode('two_third', 'kwpo_columns');
add_shortcode('two_third_last', 'kwpo_columns');
add_shortcode('three_fourth', 'kwpo_columns');
add_shortcode('three_fourth_last', 'kwpo_columns');

/* Internationalization
-------------------------------------------------------------- */
load_theme_textdomain( 'kwpo', TEMPLATEPATH.'/lang' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/lang/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
	
/* Get Category Post Lists
-------------------------------------------------------------- */
function getCategoryPostList($args = array())
{
    if (is_string($args)) {
        parse_str($args, $args);
    }
 
    // Set up defaults.
    $defaults = array(
        'echo'        => true,
    );
 
    // Merge the defaults with the parameters.
    $options = array_merge($defaults, (array)$args);
 
    $output = '';
 
    // Get the IDs from the categories to exclude
    
	global $sa_options;
	$sa_settings = get_option( 'sa_options', $sa_options );

	$go = $sa_settings['cat_to_exclude'];

    // Get top level categories
    $categories = get_categories(array('hierarchical' => 0, 'exclude' => $go));
    // Loop through the categories found.
    foreach ($categories as $cat) {

        // Print out category name
        $output .= '<div class="cattitle"><h2>' . $cat->name . '</h2></div>';
 
        // Get posts associated with the category
        $tmpPosts = get_posts('category=' . $cat->cat_ID);
        // Make sure some posts were found.
        if (count($tmpPosts) > 0) {
            // Loop through each post found.
            foreach ($tmpPosts as $post) {
                // Get post meta data.
                setup_postdata($post);
                // Print out post information
                $output .= '<div class="portfolio-box"><div class="pb_img_container">';
                $output .= '<h3><a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '">' . $post->post_title . '</a></h3>';
                // Print out post information
                $output .= '<a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '">' . get_the_post_thumbnail($post->ID, array(150,150)) . '</a>';
                $output .= '</div></div>';
            }
        }
    }
 
    if ($options['echo'] == true) {
        // Print out the $output variable.
        echo $output;
    }
 
    // Return
    return $output;
}

/* Google Analytics
-------------------------------------------------------------- */
function ga() {
	global $sa_options;
	$sa_settings = get_option( 'sa_options', $sa_options );

	$gakw = $sa_settings['ga_text'];

    $account = $gakw;


    $GAcode = "<script type=\"text/javascript\">

    var _gaq = _gaq || [];
    _gaq.push(['_setDomainName', 'fredserva.fr']);
    _gaq.push(['_trackPageview']);
    _gaq.push(['_setAccount', '$account']);

    (function()

    {

        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

    })();

    </script>";

 

    echo $GAcode;

}

add_action('wp_head', 'ga');

/* Creating media_buttons for shortcode selection
-------------------------------------------------------------- */
add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    global $shortcode_tags;
     /* ------------------------------------- */
     /* enter names of shortcode to exclude bellow */
     /* ------------------------------------- */
    $exclude = array("wp_caption", "embed", "caption", "gallery");
    echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
    foreach ($shortcode_tags as $key => $val){
	    if(!in_array($key,$exclude)){
            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
    	    }
        }
     echo $shortcodes_list;
     echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
	echo '<script type="text/javascript">
	jQuery(document).ready(function(){
	   jQuery("#sc_select").change(function() {
			  send_to_editor(jQuery("#sc_select :selected").val());
        		  return false;
		});
	});
	</script>';
}