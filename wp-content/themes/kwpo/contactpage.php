<?php
/*
  Template Name: Contact
*/
?>

<?php get_header(); ?>
  
  <div id="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
        <div class="image-wrap">	
		<h1><?php the_post_thumbnail('kw-big'); ?></h1>
		</div>
        <h1><?php the_title(); ?></h1>
        <br /><br />

        <?php the_content(); ?>
        
    <?php endwhile; else: ?>
    
        <h3><?php _e("Sorry, no posts matched your criteria", "kwpo"); ?>.</h3>
    
    <?php endif; ?>
    
  </div><!--//content-->
  
<?php get_sidebar('contact'); ?>
  
<?php get_footer(); ?>