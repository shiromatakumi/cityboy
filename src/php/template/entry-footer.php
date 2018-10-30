<footer class="entry-footer">
  <?php 
    //記事上アドセンス
    if ( is_active_sidebar( 'adsence-bottom' ) ) { 
      $post_id = get_the_ID();
      $hide_ad_value = get_post_meta( $post_id,'no_ad', true );
      if( $hide_ad_value !== 'is-off' ){
        dynamic_sidebar( 'adsence-bottom' );
      }
    }
  ?>
  <div class="share-area share-area__buttom">
    <?php get_template_part( 'template/share-buttons' ); ?>
  </div>
  <div class="paging">
    <div class="paging__link paging__link--next">
  <?php if (get_next_post()):?>
    <p class="paging__text">次の記事</p>
    <?php next_post_link('%link','%title'); ?>
  <?php endif; ?>
    </div>
    <div class="paging__link paging__link--prev">
  <?php if (get_previous_post()):?>
    <p class="paging__text paging__text--prev">前の記事</p>
    <?php previous_post_link('%link','%title'); ?>
  <?php endif; ?>
    </div>
  </div>
  <?php 
    //記事上アドセンス
    if ( is_active_sidebar( 'adsence-related' ) ) { 
      $post_id = get_the_ID();
      $hide_ad_value = get_post_meta( $post_id,'no_ad', true );
      if( $hide_ad_value !== 'is-off' ){
        dynamic_sidebar( 'adsence-related' );
      }
    }
  ?>
  <div class="comment-area">
    <?php comments_template(); ?>
  </div>
  <?php get_template_part( 'related-entries' ); ?>
</footer>