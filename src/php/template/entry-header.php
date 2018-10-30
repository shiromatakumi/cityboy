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
    //記事上アドセンス
    if ( is_active_sidebar( 'adsence-top' ) ) { 
      $post_id = get_the_ID();
      $hide_ad_value = get_post_meta( $post_id,'no_ad', true );
      if( $hide_ad_value !== 'is-off' ){
        dynamic_sidebar( 'adsence-top' );
      }
    }
  ?>
  <div class="share-area share-area__top">
    <?php get_template_part( 'template/share-buttons' ); ?>
  </div>
</header>