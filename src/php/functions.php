<?php
/**
 * prefix "cb_"
 */
require_once( 'lib/functions-widget.php' );
require_once( 'lib/functions-editor.php' );
require_once( 'lib/functions-shortcode.php' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'excerpt' );
add_theme_support( 'custom-header', array(
  'width' => 1200,
  'height' => 480
) );

add_image_size( 'mb', 380, 240, true );
add_image_size( 'mb-2x', 760, 480, true );

/**
 * メニューの設定
 */
if ( ! function_exists( 'sg_setup_nav' ) ) {
  function sg_setup_nav() {
    register_nav_menus( array(
      'global'  => 'グローバルナビ',
      'footer'  => 'フッターナビ'
    ) );
  }
}
add_action( 'after_setup_theme', 'sg_setup_nav' );

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
  function cb_get_thumbnail_by_id($id, $bool=true) {
    /**
     * $boolがtrueの場合、「no image」画像を表示
     */
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

    } elseif( cb_is_mobile() && $bool ) {

      $post_thumb = get_template_directory_uri() . '/img/' . 'mb-no-image.jpg';
      $post_thumb_retina = get_template_directory_uri() . '/img/' . 'mb-no-image@2x.jpg';

    } elseif( $bool ) {

      $post_thumb = get_template_directory_uri() . '/img/' . 'no-image.jpg';
      $post_thumb_retina = get_template_directory_uri() . '/img/' . 'no-image@2x.jpg';

    }

    if( isset( $post_thumb ) && isset( $post_thumb_retina ) ) {
      $thumb_url_array[] = $post_thumb;
      $thumb_url_array[] = $post_thumb_retina;

      return $thumb_url_array;
    }
  }
}

/**
 * タイトル周りのカスタマイズ
 */
add_theme_support( 'title-tag' );

function wp_document_title_separator( $separator ) {
  $separator = '|';
  return $separator;
}
add_filter( 'document_title_separator', 'wp_document_title_separator' );

function wp_document_title_parts( $title ) {
  if ( is_category() ) {
    $title['title'] = '「' . $title['title'] . '」カテゴリーの記事一覧';
  } else if ( is_tag() ) {
    $title['title'] = '「' . $title['title'] . '」タグの記事一覧';
  } else if ( is_archive() ) {
    $title['title'] = $title['title'] . 'の記事一覧';
  }
  return $title;
}
add_filter( 'document_title_parts', 'wp_document_title_parts', 10, 1 );

/**
 * head内の整理
 */
//絵文字の非表示
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
//ブログ投稿ツールのためのタグ非表示
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
//rel="prev"とrel="next"の非表示
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
//WordPressのバージョンの非表示
remove_action('wp_head', 'wp_generator');

if( !function_exists( 'get_recommend_entries' ) ) {
  function get_recommend_entries() {

    $all_post_num = 5;

    if( is_single() ) {

      global $post;
      $current_post_id = $post->ID;
      $categories = get_the_category($current_post_id);
      $category_ID = array();
      foreach($categories as $category):
        array_push($category_ID, $category->cat_ID);
      endforeach;
      $args = array(
        'post__not_in' => array($current_post_id),
        'posts_per_page' => $all_post_num,
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
          if (has_post_thumbnail()) {
            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
          } else {
            $post_thumbnail_url = get_template_directory_uri() . '/img/no-image-thumbnail.jpg';
          }
          
          $title = $my_query->posts[$count]->post_title;

          $content .= '<div class="related-entries__item">';
          $content .= '<div class="related-entries__thumb">';
          $content .= '<a href="' . get_the_permalink() . '"><img src="' . $post_thumbnail_url . '" alt="' . $title . '" width="100" height="100"></a>';
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

      if( $count === 5) {
        return $content;
      } else {
        $args = array(
          'category__not_in' => $category_ID,
          'post__not_in' => array($current_post_id),
          'posts_per_page' => ($all_post_num - $count),
          'tag'     => 'recommend',
          'orderby' => 'rand'
        );

        $my_query = new WP_Query($args);
        $count = 0;

        if( $my_query->have_posts() ) {
          while ( $my_query->have_posts() ) {
            $my_query->the_post();

            $post_id = $my_query->posts[$count]->ID;
            if (has_post_thumbnail()) {
              $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
            } else {
              $post_thumbnail_url = get_template_directory_uri() . '/img/no-image-thumbnail.jpg';
            }
            
            $title = $my_query->posts[$count]->post_title;

            $content .= '<div class="related-entries__item">';
            $content .= '<div class="related-entries__thumb">';
            $content .= '<a href="' . get_the_permalink() . '"><img src="' . $post_thumbnail_url . '" alt="' . $title . '" width="100" height="100"></a>';
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
    } else {
      $args = array(
        'posts_per_page' => $all_post_num,
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
          if (has_post_thumbnail()) {
            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
          } else {
            $post_thumbnail_url = get_template_directory_uri() . '/img/no-image-thumbnail.jpg';
          }
          
          $title = $my_query->posts[$count]->post_title;

          $content .= '<div class="related-entries__item">';
          $content .= '<div class="related-entries__thumb">';
          $content .= '<a href="' . get_the_permalink() . '"><img src="' . $post_thumbnail_url . '" alt="' . $title . '" width="100" height="100"></a>';
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
  }
}

// カスタム投稿タイプの追加
function create_post_type() {

  register_post_type( "template", // 投稿タイプ名の定義
    array(
      "labels" => array(
          "name" => __( "テンプレート用" ), // 表示する投稿タイプ名
          "singular_name" => __( "テンプレート用" )
        ),
      "public" => true,
      "menu_position" =>8,
      'supports' => array(
        'title',
        'editor',
        'excerpt',
        'custom-fields',
        'post-formats'
      ), //編集画面で使用するフィールド
    )
  );
}
add_action( "init", "create_post_type" );

// 検索でカスタム投稿タイプの投稿を検索対象から除きます。
function search_exclude_custom_post_type( $query ) {
  if ( $query->is_search() && $query->is_main_query() && ! is_admin() ) {
    $query->set( 'post_type', array( 'post', 'page' ) );
  }
}
add_filter( 'pre_get_posts', 'search_exclude_custom_post_type' );