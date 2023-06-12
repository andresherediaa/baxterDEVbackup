<?php
/**
 * The header for our theme.
 *
 * @package baxter
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<title><?php the_title(); ?> | <?php echo get_bloginfo( 'name' ); ?></title>
<link rel="canonical" href="<?php echo get_site_url(); ?>" />
<meta name="keywords" content="" >
<meta name="description" content="" >
<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="https://fast.fonts.net/jsapi/1504234f-c647-4850-97c8-bb98b8733769.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


  <div class="top-bar-outer">
		<div class="top-bar">
			<div class="top-bar-left font-medium desktop">
				<ul>
					<li class="top-bar-search"><?php get_search_form(array('echo' => true, 'aria_label' => 'topsearch')); ?></li>
				</ul>
			</div><!-- .top-bar-left -->
			<div class="top-bar-right font-medium desktop">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'global_nav',
					'container_class' => 'menu-global-container'
				) );
				?>
			</div><!-- .top-bar-right -->
		</div><!-- .top-bar -->
	</div><!-- .top-bar-outer -->


	<div class="bottom-bar-outer desktop">
		<div class="bottom-bar">
			<div class="bottom-bar-left">
				<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="" /></a>
			</div><!-- .bottom-bar-left -->
			<nav class="bottom-bar-right font-bold">
				<?php wp_nav_menu(array('theme_location' => 'primary_nav')); ?>
			</nav><!-- .primary-navigation -->
		</div><!-- .bottom-bar -->
	</div><!-- .bottom-bar-outer -->


  <div class="header mobile">
    <header class="site-header">

      <div class="site-header-top font-medium">
        <a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt=""></a>
        <div class="hamburger">
          <input id="burger" type="checkbox" style="display:none;">
          <label for="burger">
            <span></span>
            <span></span>
            <span></span>
          </label>
          <!-- Mobile Nav -->
          <nav class="mobile-nav">
		  		<ul class="mobile-search">
				  <li class="top-bar-search"><?php get_search_form(array('echo' => true, 'aria_label' => 'mobilesearch')); ?></li>
				</ul>

		  		<?php
					wp_nav_menu( array(
						'theme_location' => 'global_nav',
						'container_class' => 'menu-global-container'
					) );
				?>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary_nav',
						'container_class' => 'menu-primary-container'
					) );
				?>
          </nav>
        </div><!-- .hamburger -->
      </div><!-- .site-header-top -->

      <div class="site-header-menus">
        <!-- Primary Nav -->
        <?php
          wp_nav_menu( array(
            'theme_location' => 'primary_nav',
            'container_class' => 'menu-primary-container'
          ) );
        ?>
      </div><!-- .site-header-menus -->

    </header><!-- .site-header -->
  </div><!-- .header -->

<div class="main">
