<?php
/* Template name: Portfolio */
get_header(); ?>
 
<div id="container">

	<h1><?php the_title(); ?></h1>



	<?php getCategoryPostList(); ?>

</div>
 
<?php get_footer(); ?>