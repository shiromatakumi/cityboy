    <?php if( is_home() || is_front_page() ): ?>
    <?php if ( $paged < 2 ) : //　1ページ目 ?>
    
    <?php 
      global $post;

      $args = array(
        'posts_per_page' => 2,
        'tag'     => 'recommend',
      );
      $my_query = new WP_Query($args);
      $count = 0;
      $content = '';

      if( $my_query->have_posts() ) {
    ?>
    <div class="recommend-entry-top">

    <?php
        while ( $my_query->have_posts() ) {
          $my_query->the_post();

          $post_id = $my_query->posts[$count]->ID;
          if (has_post_thumbnail()) {
            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'large' );
          } else {
            $post_thumbnail_url = get_template_directory_uri() . '/img/no-image.jpg';
          }
          
          $title = $my_query->posts[$count]->post_title;
          $article_link = get_the_permalink();
    ?>
    
      <div class="recommend-entry-top__item">
        <a href="<?php echo $article_link; ?>" class="recommend-entry-top__thumb-link">
          <div class="recommend-entry-top__thumb" style="background-image: url(<?php echo $post_thumbnail_url; ?>"></div>
        </a>
        <div class="recommend-entry-top__text">
          <div class="recommend-entry-top__text-inner">
            <p class="recommend-entry-top__title"><a href="<?php echo $article_link; ?>"><?php echo $title; ?></a></p>
            <span class="recommend-entry-top__read"><a href="<?php echo $article_link; ?>">Read Article</a></span>
          </div>
        </div>
      </div><!-- /ecommend-entry-top -->
      <?php
        $count++;
        }
      ?>
      </div>
      <?php
      }
      wp_reset_postdata();
    ?>
    
    <?php endif; ?>
    <?php endif; ?>