  <?php if( is_archive() ): ?>
    <h3 class="top-section__heading"><?php the_archive_title(); ?></h3>
  <?php else: ?>
    <h3 class="top-section__heading">記事一覧</h3>
  <?php endif; ?>
    <div class="entries">
      <?php while (have_posts()) : the_post(); ?>
        <?php
          $thumbs_array = cb_get_thumbnail_by_id($post->ID); // defined functions.php
        ?>
        <article class="entries-article">
          <?php var_dump($thumbs_array[0]); ?>
          <a class="entries-article__link" href="<?php the_permalink() ?>">
            <div class="entries-article__thumb" style="background-image: url(<?php echo $thumbs_array[0]; ?>);height: 300px;width: 100%;"></div>
            <div class="entries-article__info">
              <h2 class="entries-article__title"><?php the_title(); ?></h2>
            </div>
          </a>
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