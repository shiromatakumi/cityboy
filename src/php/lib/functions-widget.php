<?php
/**
 * サイドバーの登録
 */
function theme_widget_settings() {
    register_sidebar( array(
        'name' => '記事上アドセンス',
        'id' => 'adsence-top',
        'description' => '記事上（シェアボタンの上）に表示させるアドセンス',
        'before_widget' => '<div class="adsence-widget adsence-widget--entry-top">',
        'after_widget'  => '</div>',
    ) );
    register_sidebar( array(
        'name' => '記事下アドセンス',
        'id' => 'adsence-bottom',
        'description' => '記事下（シェアボタンの上）に表示させるアドセンス',
        'before_widget' => '<div class="adsence-widget adsence-widget--entry-bottom">',
        'after_widget'  => '</div>',
    ) );
    register_sidebar( array(
        'name' => 'アドセンス関連コンテンツ',
        'id' => 'adsence-related',
        'description' => '記事下に表示させる関連コンテンツアドセンス',
        'before_widget' => '<div class="adsence-related">',
        'after_widget'  => '</div>',
    ) );
    register_sidebar( array(
        'name' => 'サイドバー',
        'id' => 'sidebar-top',
        'description' => 'サイドバーに表示されます',
        'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget__title widget__title--sidebar"><span class="widget__title-inner">',
        'after_title'   => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => 'サイドバー固定',
        'id' => 'sidebar-bottom',
        'description' => 'サイドバーの下に表示され、追尾します',
        'before_widget' => '<div id="%1$s" class="widget widget--sidebar %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget__title widget__title--sidebar"><span class="widget__title-inner">',
        'after_title'   => '</span></h3>',
    ) );
    register_sidebar( array(
        'name' => 'フッター',
        'id' => 'footer',
        'description' => 'フッターに表示されます。',
        'before_widget' => '<div id="%1$s" class="widget widget--footer %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget__title widget__title--footer"><span class="widget__title-inner widget__title-inner--footer">',
        'after_title'   => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'theme_widget_settings' );