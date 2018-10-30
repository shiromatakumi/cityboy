<?php
$post_cat = get_the_category(); // 投稿のカテゴリーを全部取得
$cat_id = $post_cat[0]->cat_ID; // カテゴリーの取得

$args = array(
  'child_of' => $cat_id
);
$cat_children = get_categories($args); // カテゴリーの子を全部取得

if( !empty( $cat_children ) ) {
  //最初のカテゴリーに子があった場合
  $parent_id = $cat_id;
  foreach( $cat_children as $key ){
    $key_id = $key->term_id;
    if( in_category( $key_id ) ) {
      //この投稿が子カテゴリーを設定している場合
      $child_id = $key_id;
      break;
    }
  }
} else {
  //最初のカテゴリーに子がなかった場合=>親がいるかもしれない
  $cat_info = get_category($cat_id);
  if($cat_info->parent) {
    $parent_id = $cat_info->parent;
    $child_id = $cat_id;
  } else {
    // 親子関係なし
    $parent_id = $cat_id;
  }
}
?>
<!-- パンくずリスト -->
<div class="breadcrumb">
  <ol class="breadcrumb__list" itemscope itemtype="http://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a href="<?php echo home_url(); ?>" itemprop="item"><span itemprop="name">HOME</span></a><meta itemprop="position" content="1" /></li>
    <?php if( isset($parent_id) ): ?>
    <li class="greater-than">&gt;</li>
    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a href="<?php echo get_category_link( $parent_id ); ?>" itemprop="item"><span itemprop="name"><?php echo esc_html( get_cat_name( $parent_id ) ); ?></span></a><meta itemprop="position" content="2" /></li>
    <?php endif; ?>
    <?php if( isset($child_id) ): ?>
    <li class="greater-than">&gt;</li>
    <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem"><a href="<?php echo get_category_link( $child_id ); ?>" itemprop="item"><span itemprop="name"><?php echo esc_html( get_cat_name( $child_id ) ); ?></span></a> <meta itemprop="position" content="3" /></li>
    <?php endif; ?>
  </ol>
</div>
<!-- パンくずリスト -->