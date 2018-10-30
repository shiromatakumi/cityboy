<?php get_header(); ?>
  <div class="wrapper">
    <?php get_template_part( 'fixed-content' ); ?>
    <div class="wrapper-inner">
      <div class="content">
        <main id="main" class="main">
          <div class="main-inner">
            <?php get_template_part( 'template/entries' ); ?>
          </div>
        </main>
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
<?php get_footer(); ?>