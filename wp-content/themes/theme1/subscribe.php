<?php  
/* Template Name: Subscribe To Comments */
if (isset($wp_subscribe_reloaded)){ global $posts; $posts = $wp_subscribe_reloaded->stcr->subscribe_reloaded_manage(); } ?>
<? get_header(); ?>
<div class="content-wrapper">
   <div class="content-main">
   <div class="content">
   
   <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
   
    <div class="article">
   
   <h1><?php the_title(); ?></h1>
   <?php the_content(); ?>
   </div>
   
   <?php endwhile; ?>
   <?php endif; ?>
   
   </div>
<?php get_sidebar();?>
   </div>
</div>
<?php get_footer(); ?>