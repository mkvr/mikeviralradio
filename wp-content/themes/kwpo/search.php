<?php get_header(); ?>
  
  <div style="margin-top:20px;"></div>
  <div id="content">
  
  
    <?php if (have_posts()) : ?>
    
    <?php while (have_posts()) : the_post(); ?>
  
    <div id="featured_big_box">
      <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kw-big'); ?></a>
      <p><?php $temp_arr_content = explode(" ",substr(strip_tags(get_the_content()),0,550)); $temp_arr_content[count($temp_arr_content)-1] = ""; $display_arr_content = implode(" ",$temp_arr_content); echo $display_arr_content; ?><?php if(strlen(strip_tags(get_the_content())) > 550) echo "..."; ?></p>
    </div><!--//featured_big_box-->

	<br />
	<hr>
	<br />
    <?php endwhile; ?>
    
    <div class="pagination">
    <?php if (function_exists("kriesi_pagination")) {
    kriesi_pagination($additional_loop->max_num_pages);
	} ?>
    </div>

	<?php else : ?>

		<h2 class="center"><?php _e("No posts found. Try a different search?", "kwpo"); ?></h2>
		<?php get_search_form(); ?>

	<?php endif; ?>
    
    <?php wp_reset_query(); ?>
    
  </div><!--//content-->
  
<?php get_sidebar('posts'); ?>
  
<?php get_footer(); ?>