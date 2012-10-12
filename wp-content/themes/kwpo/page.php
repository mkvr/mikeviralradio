<?php get_header(); ?>
  
  <div id="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
        <div class="image-wrap">	
        <h1><?php the_title(); ?></h1>
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
		<p style="text-align:right;"></p>
		<?php } ?>

		<h1>&nbsp;</h1>

        <?php the_content(); ?>
        
    <?php endwhile; else: ?>
    
        <h3><?php _e("Sorry, no posts matched your criteria.", "kwpo"); ?></h3>
    
    <?php endif; ?>
    
  </div><!--//content-->
  
<?php get_sidebar('posts'); ?>
	  
<?php get_footer(); ?>

