<?php
	class recentpost_wgt extends WP_Widget{
	    function recentpost_wgt() {
			$widget_ops = array( 'classname' => 'widget-recent-posts', 'description' => __('A widget that displays the recent post ', 'prestige') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-recent-posts' );
			$this->__construct( 'widget-recent-posts', __('Recent Post Widget', 'prestige'), $widget_ops, $control_ops );
    	}
		function widget( $args, $instance ){
			extract( $args );
			$title = apply_filters('widget_title', $instance['title'] );
			$postcount 	= $instance['postcount'];
			$show_image = isset( $instance['show_image'] ) ? $instance['show_image'] : 'off';
			echo $before_widget;
 
			// Display the widget title 
			if ( $title )
				echo $before_title . $title . $after_title;
				wp_reset_postdata();
				$query = array( 'post_type' => 'post','posts_per_page' => $postcount);
				$prestige_query = new WP_Query( $query );
				if ( $prestige_query->have_posts() ) : 
				// Start the loop.
					echo '<div class="recent_posts">';
					while (  $prestige_query->have_posts() ) :  $prestige_query->the_post();
						?>
						<article>
							<?php 
								if(has_post_thumbnail() and $show_image == 'on' ):
									echo '<figure><a href="'.get_permalink().'">';
										echo the_post_thumbnail('size-200x150');
									echo '</a></figure>';
								endif;
							?>
							<div class="blog-post-details <?php if(!has_post_thumbnail() and $show_image == 'on' ) { echo 'no-img'; } ?>">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="post-options">
									<ul>
										<li>
											By <a href="<?php echo get_the_author_link(); ?>"><?php echo get_author_name(); ?></a>
										</li>
										<li>
											<?php echo get_the_date( 'F j, Y' ); ?>
										</li>
									</ul>
								</div>
								<!-- <a class="readmore_btn" href="<?php the_permalink(); ?>">
									Read more <i class="lnr lnr-chevron-right"></i><i class="lnr lnr-chevron-right"></i>
								</a> -->
							</div>
						</article>
						<?php 
					// End the loop.
					endwhile;
					wp_reset_postdata();
					echo '</div>';
		  		else :
			 		 get_template_part( 'content', 'none' );
		 		endif;			
			echo $after_widget;
		} 
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
		 
			//Strip tags from title and name to remove HTML
			$instance['title'] 	= strip_tags( $new_instance['title'] );
			$instance['postcount'] = strip_tags( $new_instance['postcount'] );
			$instance['email'] = strip_tags( $new_instance['email'] );
			$instance['time'] = strip_tags( $new_instance['time'] );
			$instance['show_image'] = $new_instance['show_image'];
		 
			return $instance;
		}
		
		/* Widget settings */
		function form( $instance ) {
			//Set up some default widget settings.
			$defaults = array( 'title' => '','postcount' => '3', 'email' => '', 'time' => '', 'show_image' => true );
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
            <p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'prestige'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" style="width:100%;" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Show Posts:', 'prestige'); ?></label>
				<input id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" type="text"style="width:100%;" />
			</p> 
  			<p>
				<input class="checkbox" type="checkbox" <?php echo checked( $instance['show_image'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" /> 
				<label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e('Show Thumbnail', 'prestige'); ?></label>
			</p>
            <?php
		}
	} 
	// Register and load the widget
	function prestige_load_widget() {
		register_widget( 'recentpost_wgt' );
	}
	add_action( 'widgets_init', 'prestige_load_widget' );
?>