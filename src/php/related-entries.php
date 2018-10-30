<div class="related-entries">
  <h3 class="widget__title"><span class="widget__title-inner">関連記事</span></h3>
  <div class="related-entries__list">
  <?php 
  $categories = get_the_category($post->ID);
  $category_ID = array();
  foreach($categories as $category):
    array_push($category_ID, $category->cat_ID);
  endforeach;
  $args = array(
    'post__not_in' => array($post->ID),
    'posts_per_page' => 5,
    'category__in' => $category_ID,
    'orderby' => 'rand'
  );
  $query = new WP_Query($args);
  if($query->have_posts()):
    while($query->have_posts()) : $query->the_post();
  ?>
    <div class="related-entries__item">
      <div class="related-entries__thumb">
        <a href="<?php the_permalink(); ?>">
        <?php if(has_post_thumbnail()): ?>
          <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                $thumb2x_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>
          <img src="<?php echo $thumb_url; ?>"
               srcset="<?php echo $thumb_url; ?> 1x,
                       <?php echo $thumb2x_url; ?> 2x" alt="<?php the_title(); ?>" width="100" height="100">
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/no-image-thumbnail.jpg"
               srcset="<?php echo get_template_directory_uri(); ?>/img/no-image-thumbnail.jpg 1x,
                       <?php echo get_template_directory_uri(); ?>/img/no-image-thumbnail@2x.jpg 2x" alt="no image" width="100" height="100">
        <?php endif; ?>
        </a>
      </div>
      <div class="related-entries__title">
        <p><a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a></p>
      </div>
    </div>

      <?php endwhile; ?>
    <?php else: ?>
      <p>関連記事はありません。</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>