<?php
extract(shortcode_atts(array(
	'row_id'                => '',
	'class'                 => '',
	'row_title'             => '',
	'row_desc'              => '',
	'row_type'              => 'row_center_content',
	'row_padding'			=> 'no_padding',
	'bg_color'              => '',
	'bg_image'              => '',
	'bg_overlay'            => 'no_overlay',
	'bg_repeat'             => '',
	'bg_size'             	=> '',
	'bg_attatch'            => '',
	'disable_element'       => 'no',
	
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

// Row ID
$custom_row_id    = (!empty($row_id)) ? $row_id : uniqid("sym_");
$custom_row_class = (!empty($class)) ? $class : '';

// Row Type

$row_center_content = null;

if ( !empty($row_type) && $row_type == 'row_center_content' ) {
	$row_center_content = 'container';
} else {
	$row_center_content = '';
}


$row_css = array();
 
if ( $bg_color ) {
	$row_css[] = 'background-color: '. $bg_color .';';
}

$bgClass = '';
if ( $bg_image ) {
	$img_url = wp_get_attachment_url($bg_image);
	$row_css[] = 'background-image: url('. $img_url .');';
	$bgClass = 'background-image';
}

$ovrlyClass = '';
if ( $bg_overlay == 'dark_overlay' ) {
	$ovrlyClass = 'dark-overlay';

}elseif ( $bg_overlay == 'light_overlay' ) {
	$ovrlyClass = 'light-overlay';

}else {
	$ovrlyClass = 'no_overlay';
}

if ( $bg_repeat ) {
	$row_css[] = 'background-repeat: '. $bg_repeat .';';
}

if ( $bg_attatch ) {
	$row_css[] = 'background-attachment: '. $bg_attatch .';';
}


$bgSize = '';
if($bg_size == 'head2head'){
	$bgSize = '100% auto';

}elseif($bg_size == 'contain') {
	$bgSize = 'contain';
	
}elseif($bg_size == 'cover') {
	$bgSize = 'cover';

}

if ( $bg_size ) {
	$row_css[] = 'background-size: '. $bg_size .';';
}

$row_css = implode('', $row_css);

if ( $row_css ) {
	$row_css = wp_kses( $row_css, array() );
	$row_css = ' style="' . esc_attr($row_css) . '"';
}


$rowHeading = '';

$DisplayRow = '';
if($disable_element == 'yes'){
	$DisplayRow = 'style="display:none"';
}

$paddClass = '';
if($row_padding == 'no_padding'){
	$paddClass = 'no_padding';

}elseif($row_padding == 'padding_top') {
	$paddClass = 'padding-top-80';
	
}elseif($row_padding == 'padding_both') {
	$paddClass = 'padding-top-80 padding-bottom-80';

}elseif($row_padding == 'padding_bottom') {
	$paddClass = 'padding-bottom-80';

}

$DisplayRow = '';
if($disable_element == 'yes'){
	$DisplayRow = 'style="display:none"';
}

// Start VC Row
echo '
<div '.$DisplayRow.' id="'.$custom_row_id.'" class="sym-section-row '. $class .'">';	

	if( $row_type == 'row_center_content' ){
		echo '<div class="container">';
	}
		// Row Wrapper
		echo '
		<div class="'. $paddClass .' sym_section_inner '. $row_type .' clearfix '. $ovrlyClass .' '. $bgClass .'" '. $row_css.'>';
		
			if( $row_type == 'row_full_center_content' ){
				echo '<div class="container">';
			}
				// Row Inner
				echo '<div class="row sym-section-content clearfix">';
					if(!empty($row_title) || !empty($row_desc)){
						echo '<div class="sym-section-title-container text-center ">';
						
						if(!empty($row_title)){
							echo '<h1>'.$row_title.'</h1>';
						}
						if(!empty($row_desc)){
							echo '<div class="sym-sub-title"><p>'.$row_desc.'</p></div>';
						}
								
						echo '</div>';
					}
					echo do_shortcode($content);
				echo '</div>';
			if( $row_type == 'row_full_center_content' ){
				echo '</div>';
			}
			echo '
		</div>';

	if( $row_type == 'row_center_content' ){
		echo '</div>';
	}
echo '
</div>';
