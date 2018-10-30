<?php get_header(); ?>
<?php $entry_post_type = get_post_type(); ?>
  <div class="wrapper">
    <?php get_template_part( 'fixed-content' ); ?>
    <div class="wrapper-inner wrapper-inner--article">
      <div class="content">
        <main id="main" class="main">
          <div class="main-inner">
            <article id="entry" <?php post_class(); ?>>
            <?php if (have_posts()) : while (have_posts()) :  the_post(); ?>
              <?php get_template_part('template/entry-header'); ?>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
              <?php get_template_part('template/entry-footer'); ?>
            <?php endwhile;endif; ?>
            </article>
          </div>
        </main>
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
  <?php 
    $inline_css = get_post_meta($post->ID, 'inline_css', true);
    $inline_javascript = get_post_meta($post->ID, 'inline_javascript', true);
  if( $inline_css ): ?>
  <style>
  <?php echo $inline_css; ?>
  </style>
  <?php endif; ?>
  <?php if( $inline_javascript ): ?>
  <script>
  <?php echo $inline_javascript; ?>
  </script>
  <?php endif; ?>
<?php get_footer(); ?>