  <footer class="footer" id="footer">
    <div class="footer-inner">
      <?php if ( is_active_sidebar( 'footer' ) ) : ?>
        <?php dynamic_sidebar( 'footer' ); ?>
      <?php endif; ?>
    </div>
    <div class="copyright">
      <?php $now = date('Y'); ?>
      <p class="copyright__text">copyright&copy;<?php echo $now; bloginfo( 'name' ); ?></p>
    </div>
  </footer>
</div><!-- .container -->
<?php wp_footer(); ?>
<script>@@include('temp/js/script.min.js')</script>
</body>
</html>