<?php get_header(); ?>
  <div class="wrapper">
    <?php if( is_home() || is_front_page() ): ?>
    <?php if ( $paged < 2 ) : //　1ページ目 ?>

    <?php endif; ?>
    <?php endif; ?>
    <div class="wrapper-inner">
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
    </div>
  </div>
<?php get_footer(); ?>