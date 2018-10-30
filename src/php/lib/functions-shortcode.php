<?php 
/**
 * ショートコードの設定
 */
//ショートコード周りの自動整形を解除
function shortcode_p_fix($content) {
$array = array (
'<p>[' => '[',
']</p>' => ']',
']<br />' => ']',
'<br />[' => '['
);
$content = strtr($content, $array);
return $content;
}
add_filter('the_content', 'shortcode_p_fix');


if(!function_exists('adsence_shortcode')){
  function adsence_shortcode($atts, $content=""){
    $post_id = get_the_ID();
    $no_ad_value = get_post_meta( $post_id,'no_ad', true );
    if( $no_ad_value !== 'is-off' ) {
      return '<div class="adsence-wrap">' . $content . '</div>';
    } else {
      return '';
    }
  }
  add_shortcode('ads', 'adsence_shortcode');
}

if(!function_exists('recommend_entries_shortcode')){
  function recommend_entries_shortcode($atts, $content=""){
    return get_recommend_entries();
  }
  add_shortcode('recommend', 'recommend_entries_shortcode');
}

/**
 * テンプレート文章を引っ張てくるショートコード
 */
function get_text_from_template($atts) {
  $gym_slug = $atts['slug'];

  if( isset( $gym_slug ) ) {
    $post_id = get_page_by_path($gym_slug, "OBJECT", "template");
    if( !$post_id ) return;
    $post_id = $post_id->ID;
    $content = get_post_field( 'post_content', $post_id );
    $content = do_shortcode($content);
    return apply_filters( 'the_content', $content );
  }
}
add_shortcode('temp', 'get_text_from_template');