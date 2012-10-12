<?php
/* Template name: Blog */
get_header(); ?>
 
        <div id="container">

        <h1><?php the_title(); ?></h1>
 
		<?php 
			global $sa_options;
			$sa_settings = get_option( 'sa_options', $sa_options );

			$go = $sa_settings['cat_to_exclude'];


			$args = array(
			    'post_type'=> 'post',
			    'post_status' => 'publish',
			    'order' => 'DESC',
			    'cat' => $go,
			);

		query_posts( $args );
		if (have_posts()) :
		while (have_posts()) : the_post(); ?>

    		<div id="blog_box">
				
				<div class="blog-image-wrap">	
					<h1><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(400,280) ); ?></a></h1>
				</div>
      			
      			<div class="blog-box-datas">
      			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<p><img src="<?php bloginfo( 'template_url' ); ?>/images/time.png" class="icons"> <?php the_date(get_option('date_format')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/label.png" class="icons"> <?php the_category(', ') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/author.png" class="icons"> <?php the_author(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/comments.png" class="icons"> <?php comments_number(__('no responses',"kwpo"), __('one response',"kwpo"), __( '% responses',"kwpo") );?></p>
					<p style="margin-top:-10px;"></p><img src="<?php bloginfo( 'template_url' ); ?>/images/tag.png" class="icons"> <?php _e("Tagged with:", "kwpo"); ?> <?php the_tags('',' • ','<br />'); ?></p>
					<p><?php $temp_arr_content = explode(" ",substr(strip_tags(get_the_content()),0,900)); $temp_arr_content[count($temp_arr_content)-1] = ""; $display_arr_content = implode(" ",$temp_arr_content); echo $display_arr_content; ?><?php if(strlen(strip_tags(get_the_content())) > 900) echo "..."; ?></p>
					<p style="text-align:left;"></span><a href="<?php the_permalink(); ?>"><?php _e("Read more...", "kwpo"); ?></a></p>
				<br />
				</div>

			</div><!--//featured_big_box-->
			
			<?php endwhile; endif; ?>
 
				<div id="separation"></div>

        </div><!-- #container -->
 
<?php get_footer(); ?>