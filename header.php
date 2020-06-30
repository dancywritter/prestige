<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage prestigedentalspa
 * @since 1.0
 * @version 1.0
 */

global $prestige_options;

$logo = $prestige_options['primary_logo']['url'];
$favicon = $prestige_options['theme_favicon']['url'];

$headerTxtTop = get_field('header_small_text_top');
$headerTxtBig = get_field('header_big_text');
$headerTxtBottom = get_field('header_small_text_bottom');
$breadcrumbsOnOff = get_field('breadcrumbs_onoff');
$headerBannerImg = get_field('header_banner_image');
$breadcrumbs_onoff = get_field('breadcrumbs_onoff');

$imgUrl = wp_get_attachment_image_src( $headerBannerImg['ID'], 'featured_image' );
$bgImg = '';
if ( !empty($imgUrl) ) {
	$bgImg = '<img src="'.$imgUrl[0].'" alt="">';
} else {
	$bgImg = '<img src="'.get_template_directory_uri().'/images/banner-img1.jpg" alt="">';
}

?><!DOCTYPE html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Favicon Icon -->
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon">

	<?php wp_head(); ?>

</head>
<!-- Body Starts -->
<body <?php body_class(); ?>>
    <div id="wrapper">
        <!-- Header -->
        <header id="header" class="bgcolr">
            <div class="relative">
                <div id="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo $logo; ?>" alt="Prestige Dental Spa Logo">
                    </a>
                </div>
                <nav id="navbar" class="relative container-custom">
					<a href="#" class="menu-toggle"><span></span></a>
					<?php
						if ( has_nav_menu( 'top' ) ) {
							wp_nav_menu( 
								array(
									'theme_location' 	=> 'top',
									'menu_class'     	=> '',
									'menu_id'        	=> 'top-menu',
									'menu'            	=> '',
									'container'       	=> 'div',
									'container_class' 	=> 'menu-items',
									'container_id'    	=> '',
									'echo'            	=> true,
									'fallback_cb'     	=> 'wp_page_menu',
									'before'          	=> '',
									'after'           	=> '',
									'link_before'     	=> '',
									'link_after'      	=> '',
									'items_wrap'      	=> '<a href="#" id="close-menu"><span></span></a><ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           	=> 0,
									'walker'          	=> ''
								)
							);
						} else {
							wp_nav_menu(
								array(
									'menu_class'     	=> '',
									'menu_id'        	=> 'top-menu',
			    					'container'   		=> 'div',
									'echo'            	=> true,
									'fallback_cb'     	=> 'wp_page_menu',
									'before'          	=> '',
									'after'           	=> '',
									'link_before'     	=> '',
									'link_after'      	=> '',
									'items_wrap'      	=> '<a href="#" id="close-menu"><span></span></a><ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           	=> 0,
									'walker'          	=> ''
								)
							);
						}
					?>
                </nav>
            </div>
        </header>
        <!-- Banner -->
        <section id="banner" class="relative">
            <?php echo $bgImg; ?>
            <div class="absolute">
                <div class="container">
                    <div class="caption <?php if( !is_front_page() ) { echo 'text-center'; } ?>">
						<h1>
							<?php
								if( !empty( $headerTxtTop ) || !empty( $headerTxtBig ) || !empty( $headerTxtBottom ) ) {
									echo $headerTxtTop . '<span>' . $headerTxtBig . '</span>' . $headerTxtBottom;
								} else {
									echo '<span>' . get_the_title() . '</span>';
								}
							?>
						</h1>
						<?php
						if( $breadcrumbs_onoff == true ) {
							if( !is_front_page() ) { ?>
								<div class="breadcrumbs">
									<ul>
										<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
										<li><?php echo get_the_title(); ?></li>
									</ul>
								</div>
								<?php
							}
						} ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content -->
        <section id="content">