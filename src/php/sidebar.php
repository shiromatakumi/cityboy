<div class="sidebar">
  <?php if ( is_active_sidebar( 'sidebar-top' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-top' ); ?>
  <?php endif; ?>
  <?php if ( is_active_sidebar( 'sidebar-bottom' ) ) : ?>
    <div class="sidebar-module sidebar-module--sticky">
    <?php dynamic_sidebar( 'sidebar-bottom' ); ?>
    </div>
  <?php endif; ?>
</div>