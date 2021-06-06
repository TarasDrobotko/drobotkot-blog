   <div class="sidebar-main">

   	<div class="sidebar-widget">
   		<div class="search-main">
   			<form action="<?php echo esc_url(home_url('/')); ?>" method="get">
   				<input id="search-input" name="s" class="search-txt" type="text" name="search" value="<?php esc_attr_e('Пошук ...', 'theme1'); ?>" onfocus="if(this.value=='<?php echo __('Пошук ...', 'theme1'); ?>') this.value=''" onblur="if(this.value=='') this.value='<?php echo __('Пошук ...', 'theme1'); ?>'" />
   				<input class="search-img" type="image" src="<?php bloginfo('template_url'); ?>/images/search-btn.jpg" />
   			</form>
   		</div>
   	</div>


   	<?php if (!dynamic_sidebar('sidebar')) : ?>
   		<div class="sidebar-widget">
   			<h3><?php _e('Тут віджети сайдбару', 'theme1'); ?>.</h3>
   		</div>
   	<?php endif; ?>

   </div>