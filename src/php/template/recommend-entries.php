<?php 

if( is_single() ) {
  $categories = get_the_category($post->ID);
  $category_ID = array();
  foreach($categories as $category):
    array_push($category_ID, $category->cat_ID);
  endforeach;
  $args = array(
    'post__not_in' => array($post->ID),
    'posts_per_page' => 5,
    'category__in' => $category_ID,
    'tag'     => 'recommend',
    'orderby' => 'rand'
  );
  $my_query = new WP_Query($args);
  $count = 0;
  $content = '';

  if( $my_query->have_posts() ) {
    while ( $my_query->have_posts() ) {
      $my_query->the_post();

      $post_id = $my_query->posts[$count]->ID;
      $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'middle' );
      $title = $my_query->posts[$count]->post_title;

      $content .= '<div class="related-entries__item">';
      $content .= '<div class="related-entries__thumb">';
      $content .= '<a href="' . get_the_permalink() . '"><img src="' . $post_thumbnail_url . '" alt="' . $title . '"></a>';
      $content .= '</div>';
      $content .= '<div class="related-entries__title">';
      $content .= '<p><a href="' . get_the_permalink() . '">' . $title . '</a></p>';
      $content .= '</div>';
      $content .= '</div>';
      $count++;
    }
  }
  // 上書きされた$postを元に戻す
  wp_reset_postdata();

  return $content;
}


 ?>