<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<style>@@include('temp/css/theme.min.css')</style>
<?php get_template_part( 'header-seo' ); ?>
<?php get_template_part( 'ogp-facebook' ); ?>
<?php get_template_part( 'twitter-card' ); ?>
<?php wp_head(); ?>
<?php if ( $searchconsole_tag = get_option( 'search-console' ) ): ?>
<meta name="google-site-verification" content="<?php echo $searchconsole_tag; ?>" />
<?php endif; ?>
<?php if ( $analytics_tag = get_option( 'analytics' ) ): ?>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '<?php echo $analytics_tag; ?>', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
<?php endif ?>
</head>
<body <?php body_class(); ?>>
  <div class="container">
    <header class="header" id="header" >
      <div class="header-inner">
        <div class="site-title">
          <?php if( is_home() || is_front_page() ): ?>
          <h1 class="site-title__text"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
          <?php else: ?>
          <p class="site-title__text"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></p>
          <?php endif; ?>
        </div>
        <?php if( has_nav_menu('global') ) : ?>
        <div class="global-nav-wrap">
          <?php 
            wp_nav_menu( array(
              'theme_location' => 'global',
              'menu_class'      => 'global-nav__list',
              'container'      => 'nav',
              'container_class'=> 'global-nav',
              'depth'          => 2,
            ) );
          ?>
        </div>
        <div class="hamburger" id="js-toggle-button">
          <span class="hamburger__line hamburger__line--1"></span>
          <span class="hamburger__line hamburger__line--2"></span>
          <span class="hamburger__line hamburger__line--3"></span>
        </div>
        <div class="black-bg"></div>
        <?php endif; ?>
        <div class="header-search">
          <div class="header-search__icon">
            <i class="fa fa-search" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </header><!-- /header -->