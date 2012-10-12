  <div id="sidebar">
  
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Posts') ) : ?>       
      
      <div class="side_box">
        <h3><?php _e("Widget title", "kwpo"); ?></h3>
        <p><?php _e("Put anything you want here...", "kwpo"); ?><br /><br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
      </div><!--//side_box-->
      
    <?php endif; ?>
  
  </div><!--//sidebar-->