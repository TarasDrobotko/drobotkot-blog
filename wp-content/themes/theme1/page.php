<?php get_header(); ?>
<div class="content-wrapper">
   <div class="content-main">
      <div class="content">
         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

               <div class="article">
                  <h1><?php the_title(); ?></h1>
                  <?php the_content(); ?>
                   <?php if (is_page('Про мене')) {
                  echo getPostLikeLink(get_the_ID());
               } ?>
               </div>
            <?php endwhile; ?>
         <?php endif; ?>

         <?php get_template_part('templates/social-icons'); ?>

      </div>
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>