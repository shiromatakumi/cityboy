<?php get_header(); ?>
  <?php if( is_home() || is_front_page() ): ?>
    <?php if ( $paged < 2 && get_header_image() ) : //　1ページ目 ?>
  <div class="top-header-image" style="background-image: url(<?php echo get_header_image(); ?>)"></div>
    <?php endif; ?>
  <?php endif; ?>
  <?php get_template_part( 'top-recommend' ) ?>
  <div class="wrapper">
    <?php get_template_part( 'fixed-content' ); ?>
    <?php if( is_home() || is_front_page() ): ?>
    <?php if ( $paged < 2 ) : //　1ページ目 ?>
    
    <?php 
      global $post;

      $args = array(
        'posts_per_page' => 6,
        'tag'     => 'pickup',
      );
      $my_query = new WP_Query($args);
      $count = 0;
      $content = '';

      if( $my_query->have_posts() ) {
    ?>
    <div class="pickup-entries-wrap">
      <h3 class="top-section__heading"><span class="top-section__heading-inner">Pickup</span></h3>
      <div class="pickup-entries">

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
    ?>
    
      <div class="pickup-entries__item">
        <a href="<?php echo get_the_permalink(); ?>" class="pickup-entries__item-link">
          <span class="pickup-entries__pickup">pickup</span>
          <div class="pickup-entries__thumb" style="background-image: url(<?php echo $post_thumbnail_url; ?>"></div>
          <div class="pickup-entries__title"><?php echo $title; ?></div>
        </a>
      </div>
    <?php
        $count++;
        }
      ?>
        </div>
      </div>
      <?php
      }
      wp_reset_postdata();
    ?>
    
    <?php endif; ?>
    <?php endif; ?>
    <div class="wrapper-inner">
      <div class="content">
        <main id="main" class="main">
          <div class="main-inner">
            <section class="top-section top-section--entries">
              <?php if( have_posts() ): ?>
                <?php get_template_part( 'template/entries' ); ?>
              <?php else: ?>
                <?php get_template_part( 'template/no-entries' ); ?>
              <?php endif; ?>
            </section>
          </div>
        </main>
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
<?php get_footer(); ?>