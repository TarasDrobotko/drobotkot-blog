<?php get_header(); ?>
<div class="content-wrapper">
   <div class="content-main">
      <div class="content">
         <h1 class="search-result">Записи в категорії:</h1>
         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

               <div class="article">
                  <div class="article-gen-img">
                     <?php if (has_post_thumbnail()) : ?>
                        <div class="image">
                           <?php the_post_thumbnail(array(150, 100)); ?>
                        </div>
                     <?php endif; ?>
                  </div>
                  <div class="article-head">
                     <span class="article-date"><img src="<?php bloginfo('template_url'); ?>/images/articles-author.jpg" alt="Зображення автора" />
                        <span class="article-author"><?php the_author(); ?></span> - <?php the_time('d.m.Y'); ?>
                     </span>
                     <span class="article-comments"><img src="<?php bloginfo('template_url'); ?>/images/articles-comment.jpg" alt="Зображення коментаря" />
                        <a href="<?php the_permalink(); ?>">
                           <?php
                           plural_form(
                              get_comments_number(),
                              array('коментар', 'коментарі', 'коментарів')
                           );
                           ?>
                        </a>
                     </span>
                  </div>
                  <h2 class="post-cycle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <?php get_template_part('templates/reading-time-views'); ?>
                  <?php the_excerpt(); ?>
                  <p class="permalink"><a href="<?php the_permalink(); ?>">Читати далі</a></p>
               </div>

            <?php endwhile; ?>
         <?php endif; ?>

         <div class="pager">
            <?php the_posts_pagination($args = array(
               'show_all' => false,
               'end_size' => 1,
               'mid_size' => 1,
               'prev_next' => true,
               'prev_text' => '«',
               'next_text' => '»',
               'add_args' => false,
               'add_fragment' => '',
               'before_page_number' => '',
               'after_page_number' => '',
               'screen_reader_text' => ' ',
            )); ?>
         </div>
      </div>
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>