  <?php if( is_archive() ): ?>
    <h3 class="top-section__heading"><span class="top-section__heading-inner"><?php the_archive_title(); ?></span></h3>
  <?php else: ?>
    <h3 class="top-section__heading"><span class="top-section__heading-inner">Entries</span></h3>
  <?php endif; ?>
    <div class="entries">
      <?php while (have_posts()) : the_post(); ?>
        <?php
          $thumbs_array = cb_get_thumbnail_by_id($post->ID); // defined functions.php
        ?>
      <article class="entries-article">
        <a class="entries-article__link" href="<?php the_permalink(); ?>">
          <div class="entries-article__thumb" style="background-image: url(<?php echo $thumbs_array[0]; ?>);">
          </div>
          <div class="entries-article__info">
            <?php $datetime = get_the_date('Y-m-d'); ?>
            <time datetime="<?php echo $datetime; ?>" class="entries-article__time"><?php echo $datetime; ?></time>
            <h2 class="entries-article__title"><?php the_title(); ?></h2>
          </div>
        </a>
        <?php if(get_the_category() !== ''): ?>
        <ul class="article-list__category">
          <li class="article-list__category-item"><?php the_category('</li><li class="article-list__category-item">'); ?></li>
        </ul>
        <?php endif; ?>
      </article>

      <?php endwhile; ?>
    </div>
    <div class="pagination pagination-top">
      <?php echo paginate_links(array(
        'type' => 'list',
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
      )); ?>
    </div>