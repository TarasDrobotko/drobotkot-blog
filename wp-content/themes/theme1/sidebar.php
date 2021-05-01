   <div class="sidebar-main">

   	<div class="sidebar-widget">
   		<div class="search-main">
   			<form action="<?php echo esc_url(home_url('/')); ?>" method="get">
   				<input name="s" class="search-txt" type="text" name="search" value="<?php esc_attr_e('Пошук ...'); ?>" onfocus="if(this.value=='Пошук ...') this.value=''" onblur="if(this.value=='') this.value='Пошук ...'" />
   				<input class="search-img" type="image" src="<?php bloginfo('template_url'); ?>/images/search-btn.jpg" />
   			</form>
   		</div>
   	</div>


   	<?php if (!dynamic_sidebar('sidebar')) : ?>
   		<div class="sidebar-widget">
   			<h3>Тут віджети сайдбару.</h3>
   		</div>
   	<?php endif; ?>

   </div>