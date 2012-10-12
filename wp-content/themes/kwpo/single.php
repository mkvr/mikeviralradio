<?php get_header(); ?>
  
  <div id="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
        <div class="image-wrap">	
		<h1>
		<?php if ( has_post_thumbnail() ) {
			$thumbnail_id=get_the_post_thumbnail($post->ID);
			preg_match ('/src="(.*)" class/',$thumbnail_id,$link);
		?>
		<a href="<?php echo $link[1]; ?>" rel="lightbox"><?php the_post_thumbnail('kw-big'); ?></a>
			<?php
				} else { ?>
			<img src="<?php bloginfo('template_directory'); ?>/images/default.jpg" alt="<?php the_title(); ?>" />
		<?php } ?>
		</h1>
		</div>
		<?php if ( has_post_thumbnail() ) { ?>
		<p style="text-align:right;"><?php the_post_thumbnail_caption(); ?></p>
				<?php } else { ?>
		<p style="text-align:right;">Bufo viridis &copy; Matt Reinbold</p>
		<?php } ?>
        <h1><?php the_title(); ?></h1>
        <p><img src="<?php bloginfo( 'template_url' ); ?>/images/time.png" class="icons"> <?php the_date(get_option('date_format')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/label.png" class="icons"> <?php the_category(', ') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/author.png" class="icons"> <?php the_author(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo( 'template_url' ); ?>/images/comments.png" class="icons"> <a href="#comments"><?php comments_number(__('no responses',"kwpo"), __('one response',"kwpo"), __( '% responses',"kwpo") );?></a></p>
        <p style="margin-top:-10px;"></p><img src="<?php bloginfo( 'template_url' ); ?>/images/tag.png" class="icons"> <?php _e("Tagged with:", "kwpo"); ?> <?php the_tags('',' • ','<br />'); ?></p>
        <br /><br />

        <?php the_content(); ?>
        
        <br /><br />
        
        <div><a name="comments"></a></div>
        <?php comments_template(); ?>
    
    <?php endwhile; else: ?>
    
        <h3><?php _e("Sorry, no posts matched your criteria.", "kwpo"); ?></h3>
    
    <?php endif; ?>
    
  </div><!--//content-->
  
<?php get_sidebar('posts'); ?>
  
<?php get_footer(); ?>
