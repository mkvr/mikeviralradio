<?php get_header(); ?>
  
  <div id="content">
  
  
          <?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2><?php _e("Archive for the", "kwpo"); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e("Category", "kwpo"); ?></h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2><?php _e("Posts Tagged", "kwpo"); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2><?php _e("Archive for", "kwpo"); ?> <?php the_date(get_option('date_format')); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2><?php _e("Archive for", "kwpo"); ?> <?php the_time(__('F, Y', 'kwpo')); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2><?php _e("Archive for", "kwpo"); ?> <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2><?php _e("Author Archive", "kwpo"); ?>Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2><?php _e("Blog Archive for", "kwpo"); ?></h2>
 	  <?php } ?>

  

    <?php while (have_posts()) : the_post(); ?>
  
    <div id="featured_big_box">
		<div class="image-wrap">	
			<h1><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kw-big'); ?></a></h1>
		</div>
      <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <p><?php $temp_arr_content = explode(" ",substr(strip_tags(get_the_content()),0,550)); $temp_arr_content[count($temp_arr_content)-1] = ""; $display_arr_content = implode(" ",$temp_arr_content); echo $display_arr_content; ?><?php if(strlen(strip_tags(get_the_content())) > 550) echo "..."; ?></p><p style="text-align:right;"></span><a href="<?php the_permalink(); ?>"><?php _e("Read more...", "kwpo"); ?></a></p>
      <br />
      <div id="separation"></div>
    </div><!--//featured_big_box-->

    <?php endwhile; ?>
    
    <div class="pagination">
    <?php if (function_exists("kriesi_pagination")) {
    kriesi_pagination($additional_loop->max_num_pages);
	} ?>
    </div>

	<?php else :

		if ( is_category() ) { // If this is a category archive ?>
			<h2 class="center">
		<?php	
			printf(__('Sorry, but there aren\'t any posts in the %s category yet.', "kwpo"), single_cat_title('',false)); ?>
			</h2>
		<?php
		} else if ( is_date() ) { // If this is a date archive ?>
			<h2 class="center">
		<?php	
			_e("Sorry, but there aren't any posts with this date.", "kwpo"); ?>
			</h2>
		<?php
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name')); ?>
			<h2 class="center">
		<?php	
			printf(__('Sorry, but there aren\'t any posts by %s yet.', "kwpo"), $userdata->display_name); ?>
			</h2>
		<?php
		} else { ?>
			<h2 class="center">
			<?php
				_e("No posts found.", "kwpo"); ?>
			</h2>
		<?php
		}
		get_search_form();

	endif;
?>
    
    <?php wp_reset_query(); ?>
    
  </div><!--//content-->
  
<?php get_sidebar('posts'); ?>
  
<?php get_footer(); ?>