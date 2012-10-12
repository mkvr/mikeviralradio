  <div id="sidebar">
  
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Contact') ) : ?>       
      
      <div class="side_box">
        <h3><?php _e("Social Medias", "kwpo"); ?></h3>
        
        <p><?php _e("Enable links to your social medias accounts with the built-in widget.", "kwpo"); ?></p>
        <ul class="social_medias">
          <li><a href="#">Facebook</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" /></li>
          <li><a href="#">Twitter</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" /></li>
          <li><a href="#">Dribbble</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/dribbble.png" /></li>
          <li><a href="#">Forrst</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/forrst.png" /></li>
          <li><a href="#">Pinterest</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/pinterest.png" /></li>
          <li class="last"><a href="#"><?php _e("Subscribe to our RSS", "kwpo"); ?></a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" /></li>
        </ul>
        <div class="clear"></div>
        
      </div><!--//side_box-->
      
      
    <?php endif; ?>
  
  </div><!--//sidebar-->  