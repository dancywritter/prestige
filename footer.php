<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

global $prestige_options;

$footerLogo = $prestige_options['footer_logo']['url'];
$copyrightTxt = $prestige_options['copyright_text'];
$facebook = $prestige_options['facebook'];
$twitter = $prestige_options['twitter'];
$instagram = $prestige_options['instagram'];

?>
		</section>
        <!-- Footer content -->
        <footer id="footer" class="relative">
            <div class="footer-bottom">
                <div class="container">
                    <nav id="footer-navbar">
                        <div class="footer-logo pull-left">
                            <img src="<?php echo $footerLogo; ?>" width="46" alt="">
                        </div>
                        <?php
							if ( has_nav_menu( 'footer' ) ) {
								wp_nav_menu( 
									array(
										'theme_location' 	=> 'footer',
										'menu_class'     	=> 'main-menu',
										'menu_id'        	=> 'footer-menu',
									)
								);
							} else {
								wp_nav_menu(
									array(
										'menu_class'     	=> 'main-menu',
										'menu_id'        	=> 'footer-menu'
									)
								);
							}
						?>
                    </nav>
                    <div class="bottom-footer">
                        <div class="social-information pull-left">
                            <ul>
                                <li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="copyrights pull-right">
                            <p><?php echo $copyrightTxt; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>