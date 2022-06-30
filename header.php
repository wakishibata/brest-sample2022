<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="generator" content="WordPress <?php bloginfo('version') ?>">
<meta name="viewport" content="width=device-width,minimal-ui">
<meta name="keywords" content="<?php bloginfo('description') ?>">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/common/img/favicon.ico">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/common/img/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() ?>/common/img/apple-touch-icon.png">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> - RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<?php wp_head(); ?>
</head>

<body>

<div class="l-wrapper">

	<header class="l-header js-header">

	    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="l-header__logo"><?php bloginfo('name'); ?></a>
	    <div class="l-header__nav">
	      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="l-header__nav__item">Back to top page</a>
	      <a href="https://www.instagram.com/" target="_blank" class="l-header__nav__sns"><img src="<?php echo get_stylesheet_directory_uri() ?>/common/img/ico-instagram.svg" alt="Instagram" /></a>
	      <!--<a href="#" class="l-header__nav__sns"><img src="<?php echo get_stylesheet_directory_uri() ?>/common/img/ico-facebook-wh.svg" alt="facebook" />-->
	    </div>

	    <div class="l-header__hamburger">
	        <button class="c-btn__hamburger js-trigger hamburger hamburger--squeeze" type="button">
	            <span class="hamburger-box">
	                <span class="hamburger-inner"></span>
	            </span>
	        </button>
	    </div>
	</header>

    <!--main start-->
    <main class="js-mt">
