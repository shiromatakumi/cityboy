<?php
/**
 * 投稿画面関連
 */
// 見出しの設定
if(!function_exists('heading_setting')) {
  function heading_setting($init) {
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre';
    return $init;
  }
  add_filter('tiny_mce_before_init', 'heading_setting');
}

/**
 * 投稿画面の右サイドに枠(メタボックス)を追加します。
 */
function add_custom_boxes() {
  // add_meta_box( $id, $title, $callback, $post_type, $context, $priority, $callback_args );
  add_meta_box( 'no_ad', 'アドセンス非表示', 'meta_box_hide_ad_cb', 'post', 'side' );
}
add_action( 'add_meta_boxes', 'add_custom_boxes' );

/**
 * 枠の内容を出力します。
 */
function meta_box_hide_ad_cb() {
  global $post;
  $id = $post->ID;
  $hide_ad_value = get_post_meta( $id,'no_ad', true );
?>
  <label><input type="checkbox" id="no_ad" name="no_ad" value="is-off" <?php if($hide_ad_value==='is-off') echo 'checked'; ?>/>非表示</label>
<?php
}


function save_my_custom_data($post_id) {
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

  $post_meta_value = null;

  $post_keys = array('no_ad');
  foreach($post_keys as $post_key){
    if( !empty( $_POST[$post_key] ) ){
      $value = $_POST[$post_key];
    } else {
      $value = '';
    }
    update_post_meta($post_id, $post_key, $value);
  } 
}
add_action('save_post', 'save_my_custom_data');

function add_inline_code_field() {
  add_meta_box( 'inline_code', 'インラインでコードを出力', 'insert_inline_code_fields', 'post', 'normal');
}
add_action('admin_menu', 'add_inline_code_field');


// カスタムフィールドの入力エリア
function insert_inline_code_fields() {
  global $post;
  $css_code = esc_html(get_post_meta($post->ID, 'inline_css', true));
  $js_code = esc_html(get_post_meta($post->ID, 'inline_javascript', true));

  echo '<p>インラインCSS： </p><textarea name="inline_css" value="'.$css_code.'" style="display: block; height:180px;width: 100%;margin-bottom: 50px;" />'.$css_code.'</textarea>';
  echo '<p>インラインJavaScript： </p><textarea name="inline_javascript" value="'.$js_code.'" style="display: block; height:180px;width: 100%;" />'.$js_code.'</textarea>';
}
 
// カスタムフィールドの値を保存
function save_inline_code_fields( $post_id ) {
  
  if(!empty($_POST['inline_css'])){
      update_post_meta($post_id, 'inline_css', $_POST['inline_css'] );
  }else{
      delete_post_meta($post_id, 'inline_css');
  }
  
  if(!empty($_POST['inline_javascript'])){
      update_post_meta($post_id, 'inline_javascript', $_POST['inline_javascript'] );
  }else{
      delete_post_meta($post_id, 'inline_javascript');
  }
}
add_action('save_post', 'save_inline_code_fields');

