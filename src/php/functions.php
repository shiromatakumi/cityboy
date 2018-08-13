<?php
/**
 * prefix "cb_"
 */
require_once( 'lib/functions-widget.php' );
require_once( 'lib/functions-edit.php' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'excerpt' );

add_image_size( 'mb', 380, 240, true );
add_image_size( 'mb-2x', 760, 480, true );

if( !function_exists( 'cb_is_mobile' ) ) {
  function cb_is_mobile() {
    $useragents = array(
      'iPhone',          // iPhone
      'iPod',            // iPod touch
      '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
      'dream',           // Pre 1.5 Android
      'CUPCAKE',         // 1.5+ Android
      'blackberry9500',  // Storm
      'blackberry9530',  // Storm
      'blackberry9520',  // Storm v2
      'blackberry9550',  // Storm v2
      'blackberry9800',  // Torch
      'webOS',           // Palm Pre Experimental
      'incognito',       // Other iPhone browser
      'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
  }
}

// 画像を取得する関数
if( !function_exists( 'cb_get_thumbnail_by_id' ) ) {
  function cb_get_thumbnail_by_id($id) {

    $thumb_url_array = array();
    $has_thumb = has_post_thumbnail($id);

    if( cb_is_mobile() && $has_thumb ) {

      $post_thumb_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'mb');
      $post_thumb_retina_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'mb-2x');
      $post_thumb = $post_thumb_array[0];
      $post_thumb_retina = $post_thumb_retina_array[0];

    } elseif( $has_thumb ) {

      $post_thumb_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
      $post_thumb_retina_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
      $post_thumb = $post_thumb_array[0];
      $post_thumb_retina = $post_thumb_retina_array[0];

    } elseif( cb_is_mobile() ) {

      $post_thumb = get_template_directory_uri() . '/img/' . 'mb-no-image.jpg';
      $post_thumb_retina = get_template_directory_uri() . '/img/' . 'mb-no-image@x2.jpg';

    } else {

      $post_thumb = get_template_directory_uri() . '/img/' . 'no-image.jpg';
      $post_thumb_retina = get_template_directory_uri() . '/img/' . 'no-image@x2.jpg';

    }

    if( isset( $post_thumb ) && isset( $post_thumb_retina ) ) {
      $thumb_url_array[] = $post_thumb;
      $thumb_url_array[] = $post_thumb_retina;

      return $thumb_url_array;
    }
  }
}