<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

if ( ! function_exists( 'twentyseventeen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function twentyseventeen_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'twentyseventeen' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . twentyseventeen_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;


if ( ! function_exists( 'twentyseventeen_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function twentyseventeen_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'twentyseventeen' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;


if ( ! function_exists( 'twentyseventeen_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function twentyseventeen_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'twentyseventeen' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( twentyseventeen_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && twentyseventeen_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && twentyseventeen_categorized_blog() ) {
							echo '<span class="cat-links">' . twentyseventeen_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 'twentyseventeen' ) . '</span>' . $categories_list . '</span>';
						}

						if ( $tags_list && ! is_wp_error( $tags_list ) ) {
							echo '<span class="tags-links">' . twentyseventeen_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'twentyseventeen' ) . '</span>' . $tags_list . '</span>';
						}

					echo '</span>';
				}
			}

			twentyseventeen_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'twentyseventeen_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function twentyseventeen_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Display a front page section.
 *
 * @param WP_Customize_Partial $partial Partial associated with a selective refresh request.
 * @param integer              $id Front page section to display.
 */
function twentyseventeen_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		// Find out the id and set it up during a selective refresh.
		global $twentyseventeencounter;
		$id = str_replace( 'panel_', '', $partial->id );
		$twentyseventeencounter = $id;
	}

	global $post; // Modify the global post object before setting up post data.
	if ( get_theme_mod( 'panel_' . $id ) ) {
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'template-parts/page/content', 'front-page-panels' );

		wp_reset_postdata();
	} elseif ( is_customize_preview() ) {
		// The output placeholder anchor.
		echo '<article class="panel-placeholder panel twentyseventeen-panel twentyseventeen-panel' . $id . '" id="panel' . $id . '"><span class="twentyseventeen-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'twentyseventeen' ), $id ) . '</span></article>';
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function twentyseventeen_categorized_blog() {
	$category_count = get_transient( 'twentyseventeen_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'twentyseventeen_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in twentyseventeen_categorized_blog.
 */
function twentyseventeen_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'twentyseventeen_categories' );
}
add_action( 'edit_category', 'twentyseventeen_category_transient_flusher' );
add_action( 'save_post',     'twentyseventeen_category_transient_flusher' );

function prestige_social_share() {
	?>
	<script>
		function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
	</script>
	<div class="social-network">
		<h4>Share: </h4>
        <ul>
        	<li>
				<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" class="post_share_facebook" onclick="return fbs_click()" target="_blank">
					<i class="fa fa-facebook"></i>
				</a>
            	<!-- <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="post_share_facebook" onclick="javascript:window.open(this.href,
			      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;">
                  <i class="fa fa-facebook"></i>
                </a> -->
             </li>
			<li>
            	<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,
			      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter">
                  <i class="fa fa-twitter"></i>
                </a>
			</li>
            <li>
            	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
			      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                  <i class="fa fa-google-plus"></i>
				 </a>
			</li>
			<!-- <li class="pinterest">
				<a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>" onclick="javascript:window.open(this.href,
				'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600');return false;"><i class="icon icon-pinterest"></i></a>
			</li>
			<li>
				<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo get_the_title(); ?>&summary=<?php echo strip_tags(substr(get_the_excerpt(),'25')); ?>" onclick="javascript:window.open(this.href,
										'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600');return false;">
					<i class="icon icon-linkedin2"></i>
				</a>
			</li> -->
        </ul>
    </div>
	<?php
}

function prestige_comments( $comment, $args, $depth ) {
	global $post;
	$author_id = $post->post_author;
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments. ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'twenties' ); ?></span> <?php comment_author_link(); ?></div>
	<?php
		break;
		default :
			// Proceed with normal comments. ?>
			<li id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
					<div class="comment-author vcard">
						<?php //echo get_avatar( $comment, 45 ); ?>
						<header class="comment-meta">
							<h5 class="fn"><?php comment_author_link(); ?></h5>
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								printf( _x( '%s ago', '%s = human-readable time difference', 'your-text-domain' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
								?>
							</time>
							<!-- <span class="comment-date">
								<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									sprintf( _x( '%1$s', '1: date', 'twenties' ), get_comment_date() )
								); ?> <?php esc_html_e( 'at', 'twenties' ); ?> <?php comment_time(); ?>
							</span> --><!-- .comment-date -->
						</header><!-- .comment-meta -->
					</div><!-- .comment-author -->
					<div class="comment-details clr">
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'twenties' ); ?></p>
						<?php endif; ?>
						<div class="comment-content entry clr">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->
						<div class="reply comment-reply-link">
							<?php comment_reply_link( array_merge( $args, array(
								'reply_text' => esc_html__( 'Reply to this message', 'twenties' ),
								'depth'      => $depth,
								'max_depth'	 => $args['max_depth'] )
							) ); ?>
						</div><!-- .reply -->
					</div><!-- .comment-details -->
				</article><!-- #comment-## -->
			<?php
		break;
	endswitch; // End comment_type check.
	// echo get_avatar( $comment, $size = '45', $default = get_bloginfo('stylesheet_directory').'/images/default-avatar.png' );
}