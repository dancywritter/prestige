<?php get_header(); ?>
<?php
global $post;

$content = $post->post_content;
//echo $content;
$container = '';
if( has_shortcode( $content, 'vc_row' ) ) {
	$container = 'container';
} else {
	$container = 'container';
} ?>
<div class="element-spacing">
	<div class="container<?php //echo $container; ?>">
		<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		?>
	</div>
</div>
<?php get_footer();