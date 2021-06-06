<?php get_header(); ?>
<div class="content-wrapper">
   <div class="content-main">
      <div class="content">
         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <?php setPostViews(get_the_ID()); ?>

               <?php
               if (function_exists('yoast_breadcrumb')) {
                  yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
               }
               ?>
               <div class="article border">

                  <div class="article-head">
                     <span class="article-date"><img src="<?php bloginfo('template_url'); ?>/images/articles-author.jpg" alt="Зображення автора" />
                        <span><?php the_author(); ?></span> - <?php the_time('d.m.Y'); ?>
                     </span>
                     <span class="article-comments"><img src="<?php bloginfo('template_url'); ?>/images/articles-comment.jpg" alt="Зображення коментаря" />
                        <?php plural_form(get_comments_number(), array(__('коментар', 'theme1'), __('коментарі', 'theme1'), __('коментарів', 'theme1'))); ?>
                     </span>
                  </div>
                  <h1><?php the_title(); ?></h1>
                  <?php get_template_part('templates/reading-time-views'); ?>
                  <?php the_content(); ?>
               </div>
               <div class="recomended"><?php recommend() ?></div>
            <?php endwhile; ?>
         <?php endif; ?>


         <div class="clearfix"></div>

         <?php get_template_part('templates/social-icons'); ?>


         <div class="pager">
            <?php previous_post_link('<span>&laquo;</span> %link');
            next_post_link('%link <span>&raquo;</span>');  ?>
         </div>
         <?php comments_template(); ?>
      </div>
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>