<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<title><?php bloginfo('name'); ?> &bull; <?php wp_title('', true, 'right'); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>" type="text/css" media="screen" title="no title" charset="utf-8"/>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />
	
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/lightbox.css" type="text/css" media="screen" />
	
	<script language="JavaScript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/twittercb.js"></script>

  <?php wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/prototype.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/lightbox.js"></script>
</head>
<body>

<div id="header_full">
  <div id="header">
	<div id="logo">
      <a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" class="logo" /></a>
      <div class="clear"></div>    
    </div>

    <div id="search_container">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="search_box" name="s" id="s" placeholder="" />
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/search.png" class="search_icon" />
	</form>    
      <div class="clear"></div>
    </div>
    
    <div class="clear"></div>
  </div><!--//header-->
  
  <div id="infos">
  	<div id="area01">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('area-01')) : else : ?>
			<h3><?php _e("Widgetized Area", "kwpo"); ?></h3>
			<h1>1</h1>
			<p><?php _e("This panel is active and ready for you to add some widgets via the WP Admin.<br /><br />Prefer a text widget...", "kwpo"); ?><br /><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
		<?php endif; ?>
	</div>
  	<div id="area02">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('area-02')) : else : ?>
			<h3><?php _e("Widgetized Area", "kwpo"); ?></h3>
			<h1>2</h1>
			<p><?php _e("This panel is active and ready for you to add some widgets via the WP Admin.<br /><br />Prefer a text widget...", "kwpo"); ?><br /><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
		<?php endif; ?>
	</div>
  	<div id="area03">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('area-03')) : else : ?>
			<h3><?php _e("Widgetized Area", "kwpo"); ?></h3>
			<h1>3</h1>
			<p><?php _e("This panel is active and ready for you to add some widgets via the WP Admin.<br /><br />Prefer a text widget...", "kwpo"); ?><br /><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
		<?php endif; ?>
	</div>
  	<div id="summary">
  		<h3><?php bloginfo( description ); ?></h3>

				<!-- DEFAULT NAVIGATION -->
				<?php if ( has_nav_menu( 'primary' ) ) {
				echo '<li class="menu"><a href="'. get_option('home') . '/">';
				_e("Home", "kwpo");
				echo '</a></li>';
				wp_nav_menu( array(
					'theme_location' => 'primary',
 					'container' =>false,
					'menu_class' => 'menu',
					'echo' => true,
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'depth' => 0,
					'walker' => new description_walker())
				 ); 
				 } else {
				?>
				<ul>
				<li class="menu"><a style="color:#C95039;" href="<?php bloginfo( url ); ?>/wp-admin/nav-menus.php"><?php _e("Please create a navigation menu...", "kwpo"); ?></a></li>
				</ul> <!-- #top-nav -->
				<?php
				}
				?>
				 
				 <!-- /DEFAULT NAVIGATION -->

	</div>
  </div>
  
</div><!--//header_full-->

<div id="main_container">