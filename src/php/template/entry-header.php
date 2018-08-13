<header class="article-header entry-header">
  <?php $post_type = get_post_type( get_the_ID() ); ?>
  <?php if( $post_type === 'post' ): ?>
    <?php get_template_part('template/breadcrumbs'); ?>
  <?php endif; ?>
  <h1 class="entry-title single-title"><?php the_title(); //タイトル?></h1>
  <?php if( $post_type === 'post' ): ?>
    <div class="post-date">
    <?php if(get_the_modified_date('Ymd') > get_the_date('Ymd')): ?>
      投稿日：<time class="pubdate entry-time"><?php echo get_the_date('Y-m-d'); ?></time>
      更新日：<time class="updated entry-time" datetime="<?php echo get_the_modified_date('Y-m-d'); ?>"><?php echo get_the_modified_date('Y-m-d'); ?></time>
    <?php else: ?>
      投稿日：<time class="pubdate entry-time" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y-m-d'); ?></time>
    <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php 
    $thumbs_array = cb_get_thumbnail_by_id($post->ID); // defined functions.php
  ?>
  <?php if( $thumbs_array ): ?>
    <div class="entry-eyecache"><img src="<?php echo $thumbs_array[0]; ?>" srcset="<?php echo $thumbs_array[0]; ?> 1x,<?php echo $thumbs_array[1]; ?> 2x" alt="<?php the_title(); ?>"></div>
  <?php endif; ?>
</header>