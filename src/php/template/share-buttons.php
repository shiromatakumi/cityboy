  <ul class="share-btn__list">
    <?php 
      $url = esc_url( get_the_permalink() );
      $title = get_the_title();
     ?>
    <li class="share-btn__item share-btn__item--tw">
      <a href="http://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo $title;?>" target="_blank" rel="nofollow">
        <span class="share-btn__icon"><i class="fa fa-twitter"></i></span>
        <span class="share-btn_text">Twitter</span>
      </a>
    </li>
    <li class="share-btn__item share-btn__item--fb">
      <a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>&t=<?php echo $title; ?>" target="_blank" rel="nofollow">
        <span class="share-btn__icon"><i class="fa fa-facebook-square"></i></span>
        <span class="share-btn_text">facebook</span>
      </a>
    </li>
    <li class="share-btn__item share-btn__item--hatebu">
      <a href="http://b.hatena.ne.jp/entry/<?php echo $url; ?>" target="_blank" rel="nofollow">
        <span class="share-btn__icon">B!</span>
        <span class="share-btn_text">はてブ</span>
      </a>
    </li>
  </ul>