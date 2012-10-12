<?php get_header(); ?>
  
<div id="content-home">
  
	<div id="featured-posts">
    <div class="clear"></div>

    <div class="loop-title"><?php _e("Featured", "kwpo"); ?></div>
    <ul class="featured_home_big">

		<?php
		$args = array(
			'posts_per_page' => 1,
			'post__in'  => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1
		);
		query_posts( $args );
		if (have_posts()) :
		while (have_posts()) : the_post(); ?>
        <li>
        	<div id="feat_img_container">
        		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kw-big'); ?></a>
        	</div>
        	<div id="donnees">
        		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        		<p><?php the_excerpt(); ?></p>
        		<a href="<?php the_permalink(); ?>"><?php _e("Read more...", "kwpo"); ?></a>
        	</div>
        </li>
    <?php endwhile; ?>
	<?php endif; ?>
	</div>
	
	<div id="other-posts">
    <div class="loop-title-2"><p><?php _e("Our latest articles", "kwpo"); ?></p></div>
	    <ul class="other-posts">
    <?php
	global $sa_options;
	$sa_settings = get_option( 'sa_options', $sa_options );

	$go = $sa_settings['cat_to_exclude'];


    $args = array(
					'post_type' => 'post',
					'posts_per_page' => 6,
					'offset' => 0,
					'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
					'post__not_in' => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1,
					'cat' => -$go,
                 );
    query_posts($args);
    $x = 0;
    while (have_posts()) : the_post(); ?>
      <?php if($x == 2 || $x == 4) { ?>
        <li class="last">
		<div class="blog_img_container">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kw-feat'); ?></a>
		</div>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p>
		<?php $temp_arr_content = explode(" ",substr(strip_tags(get_the_content()),0,200)); $temp_arr_content[count($temp_arr_content)-1] = ""; $display_arr_content = implode(" ",$temp_arr_content); echo $display_arr_content; ?>
		<?php if(strlen(strip_tags(get_the_content())) > 200) echo "[...]"; ?>
		</p>
		<a href="<?php the_permalink(); ?>"><?php _e("Read more...", "kwpo"); ?></a>
		<br /><br />
	    <hr>
        </li>
      <?php } else { ?>
	<li>
		<div class="blog_img_container">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kw-feat'); ?></a>
		</div>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p>
		<?php $temp_arr_content = explode(" ",substr(strip_tags(get_the_content()),0,200)); $temp_arr_content[count($temp_arr_content)-1] = ""; $display_arr_content = implode(" ",$temp_arr_content); echo $display_arr_content; ?>
		<?php if(strlen(strip_tags(get_the_content())) > 200) echo "[...]"; ?>
		</p>
		<a href="<?php the_permalink(); ?>"><?php _e("Read more...", "kwpo"); ?></a>
		<br /><br />
	    <hr>
	</li>
      <?php } ?>
    <?php $x++; ?>
    <?php endwhile; ?>

    <?php wp_reset_query(); ?>
    </ul>
	</div>





</div><!--//content-->
    
<?php get_footer(); ?>