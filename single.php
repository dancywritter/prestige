<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header();

global $prestige_options;

$booking_background = $prestige_options['booking_background']['url'];
$booking_title = $prestige_options['booking_title'];
$booking_text = $prestige_options['booking_text'];
$booking_form = $prestige_options['booking_form'];

$bg = '';
if ( !empty($booking_background) ) {
	$bg = ' style="background-image: url( ' . $booking_background . ');"';
} else {
	$bg = '';
}
?>

<div class="element-spacing">
	<div class="container">
		<section class="single-blog-post section-padding content-center">
			<div class="section_content">
				<div class="row">
					<div class="col-md-8 col-sm-7 col-xs-12">
						<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
								$blogImg = '';
								if ( has_post_thumbnail()) {
									$bgImage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'img-size741x513' );
									$blogImg = '<img src="'.$bgImage[0].'" alt="">';
								} else{
									$blogImg = '<img src="'.get_template_directory_uri().'/images/blog-listing-img.jpg" alt="">';
								}
								$comments_count = wp_count_comments( get_the_ID() );
								//var_dump($comments_count);
								$comments = '';
								$count = $comments_count->total_comments;

								if ($count > 1) {
									$comments = $count . ' comments';
								} else {
									$comments = $count . ' comment';
								}
								if ($count < 1) {
									$comments = 'No Comments';
								} ?>
								<div class="single-post-thumbnail">
									<?php echo $blogImg; ?>
								</div>
								<div class="text-details">
									<h1><?php the_title(); ?></h1>
									<div class="blog-post-options">
										<ul>
											<li>
												<img src="<?php echo get_template_directory_uri(); ?>/images/admin-icon.png" alt="">
												By <a href="<?php echo get_the_author_link(); ?>"><?php echo get_author_name(); ?></a>
											</li>
											<li>
												<?php
													$categories = get_the_category();
													$separator = ', ';
													$cat = '';
													if ( ! empty( $categories ) ) {
														foreach( $categories as $category ) {
															$cat = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'prestigedentalspa' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
														}
														echo trim( $cat, $separator );
													}
												?>
											</li>
											<li>
												<a href="<?php echo get_comment_link(); ?>">
													<?php echo $comments; ?>
												</a>
											</li>
											<li>
												<?php echo get_the_date(); ?>
											</li>
										</ul>
									</div>
									<div class="post-content">
										<?php the_content(); ?>
									</div>
								</div>
								<div class="tags-list">
									<?php
										the_tags( '<div class="tags"><h4>Tags:</h4>', ', ', '</div>' );
										prestige_social_share();
									?>
									<div class="sharethis-inline-follow-buttons"></div>
									<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c693ef77056550011c4a4fb&product=inline-share-buttons' async='async'></script>
								</div>
								<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								/* the_post_navigation(
									array(
										'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
										'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
									)
								); */
							endwhile; // End of the loop.
						?>
					</div>
					<div class="col-md-4 col-sm-5 col-xs-12">
						<div class="wpb_widgetised_column wpb_content_element">
							<?php dynamic_sidebar( 'blog' ); ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<div class="appointment-form relative" <?php echo $bg; ?>>
		<div class="container">
			<div class="section-title">
				<h2><?php echo $booking_title; ?></h2>
			</div>
			<div class="form-appointment">
				<p><?php echo $booking_text; ?></p>
				<?php echo do_shortcode( $booking_form ); ?>
			</div>
			<div class="center-part">
				<img src="<?php echo get_template_directory_uri(); ?>/images/prestige-logo.png" alt="">
			</div>
		</div>
	</div>
</div>
<?php get_footer();