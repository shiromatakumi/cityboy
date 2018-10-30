<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label>
    <input type="search" class="search-field" placeholder="search" value="<?php echo get_search_query(); ?>" name="s" />
  </label>
  <div class="search-submit-wrap">
    <input type="submit" class="search-submit" value="検索" />
  </div>
</form>