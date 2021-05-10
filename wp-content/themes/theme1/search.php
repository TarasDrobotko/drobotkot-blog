<?php get_header(); ?>
<div class="content-wrapper">
   <div class="content-main">
      <div class="content">
         <h1 class="search-result">Результати пошуку за <b>&laquo;<?php the_search_query() ?>&raquo;</b></h1>
         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

               <div class="article">
                  <div class="article-gen-img">
                     <?php if (has_post_thumbnail()) : ?>
                        <div class="image">
                           <?php the_post_thumbnail(array(300, 200)); ?>
                        </div>
                     <?php endif; ?>
                  </div>
                  <div class="article-head">
                     <span class="article-date"><img src="<?php bloginfo('template_url'); ?>/images/articles-author.jpg" alt="Зображення автора" />
                        <span class="article-author"><?php the_author(); ?></span> - <?php the_time('d.m.Y'); ?>
                     </span>
                     <span class="article-comments"><img src="<?php bloginfo('template_url'); ?>/images/articles-comment.jpg" alt="Зображення коментаря" />
                        <a href="#"><?php plural_form(
                                       get_comments_number(),
                                       array('коментар', 'коментарі', 'коментарів')
                                    ); ?></a>
                     </span>
                  </div>
                  <h2 class="post-cycle"><a href="<?php the_permalink(); ?>"><?php
                                                                              $title = get_the_title();
                                                                              $keys = explode(" ", $s);
                                                                              $title = preg_replace('/(' . implode('|', $keys) . ')/iu', '<strong class="search_expt">\0</strong>', $title);
                                                                              echo $title;
                                                                              ?></a></h2>
                  <?php get_template_part('templates/reading-time-views'); ?>
                  <?php
                  $excerpt = get_the_excerpt();
                  $keys = explode(" ", $s);
                  $excerpt = preg_replace('/(' . implode('|', $keys) . ')/iu', '<strong class="search_expt">\0</strong>', $excerpt);
                  echo $excerpt;
                  ?>
                  <p><a href="<?php the_permalink(); ?>">Читати далі</a></p>
               </div>

            <?php endwhile; ?>
         <?php else : ?>
            <p>За Вашим запитом нічого не знайдено.</p>
         <?php endif; ?>

         <?php get_template_part('templates/social-icons'); ?>

         <div class="pager">
            <?php posts_nav_link('<span> - </span>', 'Попередня сторінка', 'Наступна сторінка'); ?>
         </div>
      </div>
      <?php get_sidebar(); ?>
   </div>
</div>
<?php get_footer(); ?>