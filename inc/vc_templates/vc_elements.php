<?php
/*------------------------------------------------------*/
/* Call to Action Element
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => esc_html__("Prestige - Call To Action", "js_composer"),
	"base"                      => 'prestige_calltoaction',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("About Image","js_composer"),
			"param_name"  => "about_image",
			"value"       => get_template_directory_uri()."/images/about-img.jpg",
			"description" => ""
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Title","js_composer"),
			"param_name"	=> "about_title",
			"value"			=> "About Us"
		),
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Description", "js_composer" ),
			"param_name" => "about_text", 
			"value" => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', "js_composer" ),
			"description" => __( "", "js_composer" )
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Button Text","js_composer"),
			"param_name"	=> "btn_text",
			"value"			=> "Find out more"
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Button Link","js_composer"),
			"param_name"	=> "btn_link",
			"value"			=> ""
		),
	),
) );
function prestige_shortcode_calltoaction($atts, $content = null) {
	extract(shortcode_atts(array(
		'about_image'   => get_template_directory_uri()."/images/about-img.jpg",
		'about_title'   => "About Us",
		'about_text'    => __( "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", "js_composer" ),
		'btn_text'   => "Find out more",
		'btn_link'   => "",
	), $atts));

	$output = null;

	$aboutImg = '';
	if (!empty($about_image)) {
		$bgImage = wp_get_attachment_image_src( $about_image, 'about_img' );
		$aboutImg = '<img class="margin-top-minus" src="'.$bgImage[0].'" alt="">';
	}else{
		$aboutImg = '<img class="margin-top-minus" src="'.get_template_directory_uri().'/images/about-img.jpg" alt="">';
	}

	$output .='
	<div class="about-section relative">
		<div class="container">
			<div class="row about-row">
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="img-area">
						'. $aboutImg .'
					</div>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<div class="about-text">
						<h2>'. $about_title .'</h2>
						<p>'. $about_text .'</p>
						<a href="'. $btn_link .'" class="primary-btn"><i class="fa fa-arrow-right"></i> '. $btn_text .'</a>
					</div>
				</div>
			</div>
		</div>
	</div>';
	return $output;
}
add_shortcode('prestige_calltoaction', 'prestige_shortcode_calltoaction');

/*------------------------------------------------------*/
/* Review Element
/*------------------------------------------------------*/

vc_map( array(
    "name" 						=> esc_html__("Reviews", "my-text-domain"),
    "base" 						=> "reviews_container",
	"category"                  => esc_html__('Prestige', 'js_composer'),
    "as_parent" 				=> array('only' => 'reviews_element'),
    "content_element" 			=> true,
    "show_settings_on_create" 	=> false,
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
    "is_container" 				=> true,
    "params" 					=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Offer Title","js_composer"),
			"param_name"	=> "review_title",
			"value"			=> "Client Reviews"
		),
    ),
    "js_view" => 'VcColumnView'
) );
function majix_shortcode_reviews_container( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'review_title'    	=> 'Client Reviews',
	), $atts));

	$output = null;
	$output .= '
	<section class="clients relative">
		<div class="container">
			<div class="section-title">
				<h2>' . $review_title . '</h2>
			</div>
			<div class="client-slider">';
				$output .= do_shortcode($content);
				$output .= '
			</div>
		</div>
	</div>';
	return $output;
}
add_shortcode( 'reviews_container', 'majix_shortcode_reviews_container' );

vc_map( array(
	"name"                      => esc_html__("Review", "js_composer"),
	"base"                      => 'reviews_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"content_element"			=> true,
	"as_child"					=> array('only' => 'reviews_container'),
	"params"                    => array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Person Name","js_composer"),
			"param_name"	=> "review_person_name",
			"value"			=> "John Doe"
		),
		array(
			"type"			=> "textarea",
			"class"			=> "",
			"heading"		=> esc_html__("Review Text","js_composer"),
			"param_name"	=> "review_text",
			"value"			=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
		),
	),
) );
function prestige_reviews_element($atts, $content = null) {
	extract(shortcode_atts(array(
		'review_person_name'    => 'John Doe',
		'review_text'     		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
	), $atts));
 
	$output = null;
	$output .='
	<div class="slide">
		<p>'. $review_text .'</p>
		<span class="client_name">'. $review_person_name .'</span>
	</div>';
	return $output;
}
add_shortcode('reviews_element', 'prestige_reviews_element');

/*------------------------------------------------------*/
/* Insurance Logos Element
/*------------------------------------------------------*/

vc_map( array(
    "name" 						=> esc_html__("Insurance Logo Container", "my-text-domain"),
    "base" 						=> "insurance_logo_container",
	"category"                  => esc_html__('Prestige', 'js_composer'),
    "as_parent" 				=> array('only' => 'insurance_logo_element'),
    "content_element" 			=> true,
    "show_settings_on_create" 	=> false,
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
    "is_container" 				=> true,
    "params" 					=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Feature Title","js_composer"),
			"param_name"	=> "insurance_logo_title",
			"value"			=> "Insurances Accepted"
		),
    ),
    "js_view" => 'VcColumnView'
) );
function shortcode_insurance_logos_container( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'insurance_logo_title'    	=> 'Insurances Accepted',
	), $atts));

	$output = null;
	$output .= '
	<div class="insurance-section relative">
		<div class="container">
			<div class="section-title">
				<h2>' . $insurance_logo_title . '</h2>
			</div>
			<div class="insurance-logos">
				<ul>';
					$output .= do_shortcode($content);
					$output .= '
				</ul>
			</div>
		</div>
	</div>';
	return $output;
}
add_shortcode( 'insurance_logo_container', 'shortcode_insurance_logos_container' );

vc_map( array(
	"name"				=> esc_html__("Insurance Logo", "js_composer"),
	"base"				=> 'insurance_logo_element',
	"category"          => esc_html__('Prestige', 'js_composer'),
	"description"		=> '',
	"icon" 				=> get_template_directory_uri() . "/images/vc-icon.png",
	"content_element"	=> true,
	"as_child"			=> array('only' => 'insurance_logo_container'),
	"params"			=> array(
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("About Image","js_composer"),
			"param_name"  => "insurance_logo",
			"value"       => get_template_directory_uri()."/images/insurance-img.jpg",
			"description" => ""
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Logo Link","js_composer"),
			"param_name"	=> "logo_url",
			"value"			=> "#"
		),
	),
) );
function shortcode_insurance_logo($atts, $content = null) {
	extract(shortcode_atts(array(
		'insurance_logo'	=> get_template_directory_uri()."/images/insurance-img.jpg",
		'logo_url'    		=> '#',
	), $atts));
	
	$output = null;

	$aboutImg = '';
	if (!empty($insurance_logo)) {
		$bgImage = wp_get_attachment_image_src( $insurance_logo, 'full' );
		$aboutImg = '<img src="'.$bgImage[0].'" alt="">';
	}else{
		$aboutImg = '<img src="'.get_template_directory_uri().'/images/insurance-img.jpg" alt="">';
	}

	$output .='
	<li>
		<a href="'. $logo_url .'">
			'. $aboutImg .'
		</a>
	</li>';
	return $output;
}
add_shortcode('insurance_logo_element', 'shortcode_insurance_logo');

/*------------------------------------------------------*/
/* Contact Information Element
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => esc_html__("Contact Info Element", "js_composer"),
	"base"                      => 'contact_info_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Address', 'js_composer' ),
			'param_name'  => 'contact_map',
			'value'       => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.109003795233!2d-118.39347728433106!3d34.06671988060189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2b956745525d3%3A0xa2ab98254ca94ae1!2sPrestige+Dental+Spa+Of+Beverly+Hills!5e0!3m2!1sen!2s!4v1549130534959" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Feature URL', 'js_composer' ),
			'param_name'  => 'contact_address',
			'value'       => 'Dr. Daniel Omid Cohanim 9911 W Pico Blvd #1450 Los Angeles, CA 90035'
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Phone Number","js_composer"),
			"param_name"	=> "contact_number",
			"value"			=> "(310) 288-2121"
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Email Address","js_composer"),
			"param_name"	=> "contact_email",
			"value"			=> "info@PrestigeDentalSpa.com"
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Feature URL', 'js_composer' ),
			'param_name'  => 'contact_timings',
			'value'       => 'Mon-Fri 9am-5pm<br>Sat 11am-2pm<br>Sun By Appt Only'
		),
	),
) );
function prestige_shortcode_contact_info($atts, $content = null) {
	extract(shortcode_atts(array(
		'contact_map'		=> '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.109003795233!2d-118.39347728433106!3d34.06671988060189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2b956745525d3%3A0xa2ab98254ca94ae1!2sPrestige+Dental+Spa+Of+Beverly+Hills!5e0!3m2!1sen!2s!4v1549130534959" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
		'contact_address'   => 'Dr. Daniel Omid Cohanim 9911 W Pico Blvd #1450 Los Angeles, CA 90035',
		'contact_number'    => '(310) 288-2121',
		'contact_email'    	=> 'info@PrestigeDentalSpa.com',
		'contact_timings'   => 'Mon-Fri 9am-5pm<br>Sat 11am-2pm<br>Sun By Appt Only',
	), $atts));
 
	$output = null;

	$output .='
	<div class="contact-info-section relative">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">
					'.$contact_map.'
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 pull-right">
					<div class="contact-information">
						<div class="contact-info">
							<ul>
								<li><i class="fa fa-building-o"></i><span>'.$contact_address.'</span></li>
								<li><i class="fa fa-phone"></i><span>'.$contact_number.'</span></li>
								<li><i class="fa fa-send"></i><span><a href="mailto:'.$contact_email.'">'.$contact_email.'</a></span></li>
								<li><i class="fa fa-hourglass-2"></i><span>'.$contact_timings.'</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';
	return $output;
}
add_shortcode('contact_info_element', 'prestige_shortcode_contact_info');

/*------------------------------------------------------*/
/* Booking Element
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => esc_html__("Booking", "js_composer"),
	"base"                      => 'booking_form_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Booking Title', 'js_composer' ),
			'param_name'  => 'booking_title',
			'value'       => 'book your appointment'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Booking Text', 'js_composer' ),
			'param_name'  => 'booking_text',
			'value'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore'
		),
	),
) );
function prestige_shortcode_booking($atts, $content = null) {
	extract(shortcode_atts(array(
		'booking_title'   => 'book your appointment',
		'booking_text'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore',
	), $atts));
 
	$output = null;

	$output .='
	<div class="appointment-form relative">
		<div class="container">
			<div class="section-title">
				<h2>'.$booking_title.'</h2>
			</div>
			<div class="form-appointment">
				<p>'.$booking_text.'</p>
				' . do_shortcode( '[contact-form-7 id="12" title="Contact form 1"]' ) . '
			</div>
			<div class="center-part">
				<img src="'. get_template_directory_uri() .'/images/prestige-logo.png" alt="">
			</div>
		</div>
	</div>';
	return $output;
}
add_shortcode('booking_form_element', 'prestige_shortcode_booking');

/*------------------------------------------------------*/
/* Timeline Container Element
/*------------------------------------------------------*/
vc_map( array(
    "name" 						=> esc_html__("About Us Timeline Element", "my-text-domain"),
    "base" 						=> "timeline_container",
	"category"                  => esc_html__('Prestige', 'js_composer'),
    "as_parent" 				=> array('only' => 'prestige_timeline_element'),
    "content_element" 			=> true,
    "show_settings_on_create" 	=> false,
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
    "is_container" 				=> true,
    "params" 					=> array(
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("About Us Image","js_composer"),
			"param_name"  => "about_us_image",
			"value"       => get_template_directory_uri()."/images/about-us-img.jpg",
			"description" => ""
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("About Us Title","js_composer"),
			"param_name"	=> "about_us_title",
			"value"			=> "Welcome to prestige dental spa"
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("About Us Subtitle","js_composer"),
			"param_name"	=> "about_us_subtitle",
			"value"			=> "Prestige dental spa and staff introduction"
		),
		array(
			"type"			=> "textarea",
			"class"			=> "",
			"heading"		=> esc_html__("Services Text","js_composer"),
			"param_name"	=> "simple_services_text",
			"value"			=> "Duo ut laudem iriure qualisque, ei malorum democritum posidonium mel, sea in modus mundi. Ad vel quis dolorum praesent, consul admodum ullamcorper vis at. Equidem dissentiet sed te, per legimus deterruisset ne. In minimum corpora vel."
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Appointment Button Text","js_composer"),
			"param_name"	=> "appointment_btn_text",
			"value"			=> "Request an Appointment"
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Appointment Button Link","js_composer"),
			"param_name"	=> "appointment_btn_link",
			"value"			=> "#appointment_form"
		),
    ),
    "js_view" => 'VcColumnView'
) );
function prestige_shortcode_timeline_container( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'about_us_image'		=> get_template_directory_uri()."/images/about-us-img.jpg",
		'about_us_title'		=> 'Welcome to prestige dental spa',
		'about_us_subtitle'		=> 'Prestige dental spa and staff introduction',
		'simple_services_text'	=> 'Duo ut laudem iriure qualisque, ei malorum democritum posidonium mel, sea in modus mundi. Ad vel quis dolorum praesent, consul admodum ullamcorper vis at. Equidem dissentiet sed te, per legimus deterruisset ne. In minimum corpora vel.',
		'appointment_btn_text'	=> 'Request an Appointment',
		'appointment_btn_link'	=> '#appointment_form',
	), $atts));
	$output = null;

	$about_Img = '';
	if (!empty($about_us_image)) {
		$bgImage = wp_get_attachment_image_src( $about_us_image, 'img-size568x384' );
		$about_img = '<img src="'.$bgImage[0].'" alt="">';
	}else{
		$about_img = '<img src="'.get_template_directory_uri().'/images/about-us-img.jpg" alt="">';
	}

	$output .= '
	<section class="element-spacing padding-top-0 we_offer_best_area section-padding content-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="section_title about_title">
						<h2>'.$about_us_title.'</h2>
						<h3>'.$about_us_subtitle.'</h3>
						<p>'.$simple_services_text.'</p>
					</div>
					<div class="img-area">
						' . $about_img . '
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="timeline_section_content clearfix">';
						$output .= do_shortcode($content);
						$output .= '
						<div class="timeline-img"></div>
						<div class="timeline-text">
							<a href="'.$appointment_btn_link.'" class="primary-btn appointment-btn">
								<i class="fa fa-calendar-check-o"></i>
								'.$appointment_btn_text.'
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>';
	return $output;
}
add_shortcode( 'timeline_container', 'prestige_shortcode_timeline_container' );

vc_map( array(
	"name"				=> esc_html__("Timeline", "js_composer"),
	"base"				=> 'prestige_timeline_element',
	"category"          => esc_html__('Majix', 'js_composer'),
	"description"		=> '',
	"icon" 				=> get_template_directory_uri() . "/images/vc-icon.png",
	"content_element"	=> true,
	"as_child"			=> array('only' => 'timeline_container'),
	"params"			=> array(
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("Timeline Image","js_composer"),
			"param_name"  => "timeline_image",
			"value"       => get_template_directory_uri()."/images/timline-img.jpg",
			"description" => ""
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Timeline Title","js_composer"),
			"param_name"	=> "timeline_title",
			"value"			=> "Relaxation and massage therapies"
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Timeline Text', 'js_composer' ),
			'param_name'  => 'timeline_desc',
			'value'       => 'Lorem ipsum dolor sit amet, no ius facete vivendum deterruisset. Aeterno incorrupte vix et, nec detracto voluptatum ea. An quo diam'
		),
	),
) );
function prestige_shortcode_timeline_element($atts, $content = null) {
	extract(shortcode_atts(array(
		'timeline_image'	=> get_template_directory_uri()."/images/timline-img.jpg",
		'timeline_title'    => 'Relaxation and massage therapies',
		'timeline_desc'		=> 'Lorem ipsum dolor sit amet, no ius facete vivendum deterruisset. Aeterno incorrupte vix et, nec detracto voluptatum ea. An quo diam',
	), $atts));
	
	$output = null;

	$timelineImg = '';
	if (!empty($timeline_image)) {
		$bgImage = wp_get_attachment_image_src( $timeline_image, 'thumbnail' );
		$timelineImg = '<img src="'.$bgImage[0].'" alt="">';
	}else{
		$timelineImg = '<img src="'.get_template_directory_uri().'/images/timline-img.png" alt="">';
	}

	$output .='
	<div class="timeline-item">
		<div class="timeline-img">' . $timelineImg . '</div>
		<div class="timeline-text">
			<h3>' . $timeline_title . '</h3>
			<p>' . $timeline_desc . '</p>
		</div>
	</div>';
	return $output;
}
add_shortcode('prestige_timeline_element', 'prestige_shortcode_timeline_element');

/*------------------------------------------------------*/
/* About Me Element
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => esc_html__("About Me", "js_composer"),
	"base"                      => 'about_me_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("About Me Title","js_composer"),
			"param_name"	=> "about_me_title",
			"value"			=> "About Daniel omid cohanim"
		),
		array(
			"type"			=> "textarea_html",
			"class"			=> "",
			"heading"		=> esc_html__("About Me Text","js_composer"),
			"param_name"	=> "about_me_text",
			"value"			=> "<p>Sit ad habeo iusto tamquam. Et est perfecto facilisis. Pri ei nemore graecis dissentias, nam ei solum molestiae, agam antiopam sit eu. Pro dico inani dolores ea. Fuisset dolores constituam at nam. Est semper explicari cu, probo nihil id qui, eos et oblique meliore.</p>
			<p>No consul deserunt vim. Pri an epicurei inciderint. Ne vel idque dolorum denique. Te soluta luptatum delicata ius, id discere apeirian vis. Ut eam doctus habemus, et sit utamur aliquam nusquam. At suscipit definiebas mea.</p>"
		),
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("About Me Image","js_composer"),
			"param_name"  => "about_me_image",
			"value"       => get_template_directory_uri()."/images/about-us-img1.jpg",
			"description" => ""
		),
    ),
) );
function prestige_shortcode_about_me($atts, $content = null) {
	extract(shortcode_atts(array(
		'about_me_title'		=> 'About Daniel omid cohanim',
		'about_me_text'		=> '<p>Sit ad habeo iusto tamquam. Et est perfecto facilisis. Pri ei nemore graecis dissentias, nam ei solum molestiae, agam antiopam sit eu. Pro dico inani dolores ea. Fuisset dolores constituam at nam. Est semper explicari cu, probo nihil id qui, eos et oblique meliore.</p>
		<p>No consul deserunt vim. Pri an epicurei inciderint. Ne vel idque dolorum denique. Te soluta luptatum delicata ius, id discere apeirian vis. Ut eam doctus habemus, et sit utamur aliquam nusquam. At suscipit definiebas mea.</p>',
		'about_me_image'		=> get_template_directory_uri()."/images/about-us-img1.jpg",
	), $atts));
	$output = null;

	$aboutMeImg = '';
	if (!empty($about_me_image)) {
		$bgImage = wp_get_attachment_image_src( $about_me_image, 'img-size562x654' );
		$aboutMeImg = '<img src="'.$bgImage[0].'" alt="">';
	}else{
		$aboutMeImg = '<img src="'.get_template_directory_uri().'/images/about-us-img1.jpg" alt="">';
	}

	$output .= '
	<section class="element-spacing about-us-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="section_title about_title">
						<h2>'.$about_me_title.'</h2>
						<p>'.$about_me_text.'</p>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					'.$aboutMeImg.'
				</div>
			</div>
		</div>
	</section>';
	return $output;
}
add_shortcode('about_me_element', 'prestige_shortcode_about_me');

/*------------------------------------------------------*/
/* Prestige Team Member
/*------------------------------------------------------*/
vc_map( array(
    "name" 						=> esc_html__("Team Members Container", "my-text-domain"),
    "base" 						=> "team_members_container",
	"category"                  => esc_html__('Prestige', 'js_composer'),
    "as_parent" 				=> array('only' => 'team_member_element'),
    "content_element" 			=> true,
    "show_settings_on_create" 	=> false,
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
    "is_container" 				=> true,
    "params" 					=> array(
    ),
    "js_view" => 'VcColumnView'
) );
function prestige_shortcode_team_members_container( $atts, $content = null ) {
	$output = null;

	$output .= '
	<section class="team_members_section element-spacing">
		<div class="container">
			<div class="row">';
				$output .= do_shortcode($content);
				$output .= '
			</div>
		</div>
	</section>';

	return $output;
}
add_shortcode( 'team_members_container', 'prestige_shortcode_team_members_container' );

vc_map( array(
	"name"				=> esc_html__("Team Member", "js_composer"),
	"base"				=> 'team_member_element',
	"category"          => esc_html__('Prestige', 'js_composer'),
	"description"		=> '',
	"icon"				=> get_template_directory_uri() . "/images/vc-icon.png",
	"content_element"	=> true,
	"as_child"			=> array('only' => 'solution_container'),
	"params"			=> array(
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("Member Image","js_composer"),
			"param_name"  => "member_image",
			"value"       => get_template_directory_uri()."/images/team_member.jpg",
			"description" => ""
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Member title', 'js_composer' ),
			'param_name'  => 'member_title',
			'value'       => 'Staff name'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Member designation', 'js_composer' ),
			'param_name'  => 'member_designation',
			'value'       => 'secretary'
		),
	),
) );
function prestige_shortcode_detail_services_element($atts, $content = null) {
	extract(shortcode_atts(array(
		'member_image'			=> get_template_directory_uri()."/images/team_member.jpg",
		'member_title'			=> 'Staff name',
		'member_designation'	=> 'secretary',	), $atts));
	$output = null;

	$memberImg = '';
	if (!empty($member_image)) {
		$bgImage1 = wp_get_attachment_image_src( $member_image, 'img-size360x318' );
		$memberImg = '<img src="'.$bgImage1[0].'" alt="">';
	}else{
		$memberImg = '<img src="'. get_template_directory_uri() .'/images/team_member.jpg" alt="">';
	}

	if (!empty($member_image)) {
		$output .='
		<article class="col-md-4 col-sm-4 col-xs-12 team-member">
			<figure>' . $memberImg . '</figure>
			<div class="text-details">
				<h3><i class="fa fa-user"></i>' . $member_title . '</h3>
				<h4>' . $member_designation . '</h4>
			</div>
		</article>';
	}
	return $output;
}
add_shortcode('team_member_element', 'prestige_shortcode_detail_services_element');

/*------------------------------------------------------*/
/* Blog Element
/*------------------------------------------------------*/

vc_map( array(
	"name"                      => esc_html__("Blog", "js_composer"),
	"base"                      => 'blog_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Blog Title', 'js_composer' ),
			'param_name'  => 'show_blog_posts',
			'value'       => '3',
		),
		array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__("Select Pagination","js_composer"),
			"param_name"  => "activate_pagination",
			'value' => array(
				esc_html__( 'Yes', 'js_composer' ) => 'yes',
				esc_html__( 'No', 'js_composer' ) => 'no',
			),
			'save_always' => true,
			"description" => "Select notice that you want to show"
		),
		array(
			"type"        => "dropdown",
			"class"       => "",
			"heading"     => esc_html__("Select Post Order","js_composer"),
			"param_name"  => "activate_order",
			'value' => array(
				esc_html__( 'Ascending', 'js_composer' ) => 'ASC',
				esc_html__( 'Descending', 'js_composer' ) => 'DESC',
			),
			'save_always' => true,
			"description" => "Select notice that you want to show"
		),
	),
) );
function prestige_shortcode_blog($atts, $content = null) {
	extract(shortcode_atts(array(
		'show_blog_posts'		=> "3",
		'activate_pagination'	=> "yes",
		'activate_order'		=> "ASC",
	), $atts));

	$output = null;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$query = new WP_Query(
		array(
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> $show_blog_posts,
			'paged' 			=> $paged,
			'order'				=> $activate_order
		)
	);

	if ($query->have_posts()) {
		$output .='
		<section class="from_our_blog_area section-padding content-center">
			<div class="container">
				<div class="row">
					<div class="section_content">';
						while ($query->have_posts()) :	$query->the_post();

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
							}
							$output .='
							<article>
								<figure>
									'. $blogImg .'
									<figcaption>'. get_the_date( 'M j' ) .'</figcaption>
								</figure>
								<div class="text-details">
									<h6><a href="'. esc_url( get_the_permalink( get_the_ID() ) ) .'">' . get_the_title() . '</a></h6>
									<div class="blog-post-options">
										<ul>
											<li>
												<img src="'. get_template_directory_uri() .'/images/admin-icon.png" alt="">
												By <a href="'.get_the_author_link().'">'. get_author_name() .'</a>
											</li>
											<li>';
												$categories = get_the_category();
												$separator = ', ';
												$cat = '';
												if ( ! empty( $categories ) ) {
													foreach( $categories as $category ) {
														$cat = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'prestigedentalspa' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
													}
													$output .= trim( $cat, $separator );
												}
												$output .='
											</li>
											<li>
												<a href="'. get_comment_link() .'">
													'. $comments .'
												</a>
											</li>
										</ul>
									</div>
									<p>'. substr( get_the_content(), 0, 339 ) .'</p>
									<a href="'. esc_url( get_the_permalink( get_the_ID() ) ) .'" class="readmore-btn">Read More</a>
								</div>
							</article>';
						endwhile;

						$total_pages = $query->max_num_pages;

						if ($total_pages > 1){
							$output .='
							<div class="pagination">';
								$current_page = max(1, get_query_var('paged'));

								$output .= paginate_links(array(
									'base' => get_pagenum_link(1) . '%_%',
									'format' => '/page/%#%',
									'current' => $current_page,
									'total' => $total_pages,
									'prev_text'    => __('Prev'),
									'next_text'    => __('Next'),
								));
								$output .='
							</div>';
						}
						wp_reset_postdata();
						$output .='
					</div>
				</div>
			</div>
		</section>';
	}
	return $output;
}
add_shortcode('blog_element', 'prestige_shortcode_blog');

/*------------------------------------------------------*/
/* Contact Element
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => esc_html__("Contact Element", "js_composer"),
	"base"                      => 'contact_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Contact Title","js_composer"),
			"param_name"	=> "contact_title",
			"value"			=> "No Problem"
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Contact Subtitle', 'js_composer' ),
			'param_name'  => 'contact_subtitle',
			'value'       => 'we offer around the clock 24 hour customer service.'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Contact Call Title', 'js_composer' ),
			'param_name'  => 'contact_call_title',
			'value'       => 'Give us a call'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Contact Call Text', 'js_composer' ),
			'param_name'  => 'contact_call_text',
			'value'       => 'We are always here to answer your questions, all you have to do is give us a call on:<br>(310) 288-2121'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Contact Appointment Title', 'js_composer' ),
			'param_name'  => 'contact_appointment_title',
			'value'       => 'Request an appointment'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Contact Appointment Text', 'js_composer' ),
			'param_name'  => 'contact_appointment_text',
			'value'       => 'At Prestige Dental Spa We are really interested to see you ,so you can schedule an appointment online'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Appointment Button Text', 'js_composer' ),
			'param_name'  => 'appointment_btn_text',
			'value'       => 'Request an Appointment'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Appointment Button Link', 'js_composer' ),
			'param_name'  => 'appointment_btn_link',
			'value'       => '#appointment_form'
		),
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("Contact Image","js_composer"),
			"param_name"  => "contact_image",
			"value"       => get_template_directory_uri()."/images/contact-img.jpg",
			"description" => ""
		),
		array(
			"type"        => "attach_image",
			"class"       => "",
			"heading"     => esc_html__("Contact Logo","js_composer"),
			"param_name"  => "contact_logo",
			"value"       => get_template_directory_uri()."/images/prestige-logo.png",
			"description" => ""
		),
	),
) );
function prestige_shortcode_video($atts, $content = null) {
	extract(shortcode_atts(array(
		'contact_title'    			=> 'No Problem',
		'contact_subtitle'			=> 'we offer around the clock 24 hour customer service.',
		'contact_call_title'		=> 'Give us a call',
		'contact_call_text'			=> 'We are always here to answer your questions, all you have to do is give us a call on:<br>(310) 288-2121',
		'contact_appointment_title'	=> 'Request an appointment',
		'appointment_btn_text'		=> 'Request an Appointment',
		'appointment_btn_link'		=> '#appointment_form',
		'contact_appointment_text'	=> 'At Prestige Dental Spa We are really interested to see you ,so you can schedule an appointment online',
		'contact_image'				=> get_template_directory_uri()."/images/contact-img.jpg",
		'contact_logo'				=> get_template_directory_uri()."/images/prestige-logo.png",
	), $atts));
 
	$output = null;
	
	$contactImg = '';
	if (!empty($contact_image)) {
		$bgImage1 = wp_get_attachment_image_src( $contact_image, 'img-size499x364' );
		$contactImg = '<img src="'.$bgImage1[0].'" alt="">';
	}else{
		$contactImg = '<img src="'. get_template_directory_uri() .'/images/contact-img.jpg" alt="">';
	}
	
	$contactLogo = '';
	if (!empty($contact_logo)) {
		$bgImage1 = wp_get_attachment_image_src( $contact_logo, 'thumbnail' );
		$contactLogo = '<img class="contact-logo" src="'.$bgImage1[0].'" alt="">';
	}else{
		$contactLogo = '<img class="contact-logo" src="'. get_template_directory_uri() .'/images/prestige-logo.png" alt="">';
	}

	$output .='
	<section class="contact_information_section">
		<div class="container">
			<div class="section_title about_title">
				<h2>'.$contact_title.'</h2>
				<h3>'.$contact_subtitle.'</h3>
			</div>
			<div class="element-spacing">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="contact-info">
							<div class="contact-title section_title about_title">
								<h3>'.$contact_call_title.'</h3>
							</div>
							<div class="contact-text">
								<p>'.$contact_call_text.'</p>
							</div>
						</div>
						<div class="contact-info">
							<div class="contact-title section_title about_title">
								<h3>'.$contact_appointment_title.'</h3>
							</div>
							<div class="contact-text">
								<p>'.$contact_appointment_text.'</p>
							</div>
						</div>
						<a href="'.$appointment_btn_link.'" class="primary-btn appointment-btn">
							<i class="fa fa-calendar-check-o"></i>
							'.$appointment_btn_text.'
						</a>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="contact_image_area">
							'.$contactImg.'
							<div class="centeralized absolute">'.$contactLogo.'</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>';
	return $output;
}
add_shortcode('contact_element', 'prestige_shortcode_video');

/*------------------------------------------------------*/
/* Services Element
/*------------------------------------------------------*/
vc_map( array(
	"name"                      => esc_html__("Procedures", "js_composer"),
	"base"                      => 'procedures_element',
	"category"                  => esc_html__('Prestige', 'js_composer'),
	"description"               => '',
	"icon" 						=> get_template_directory_uri() . "/images/vc-icon.png",
	"params"                    => array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Procedure Title","js_composer"),
			"param_name"	=> "procedure_title",
			"value"			=> "Feel Relax"
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> esc_html__("Procedure Subtitle","js_composer"),
			"param_name"	=> "procedure_subtitle",
			"value"			=> "we are doing so fast and easy in order too keep you calm"
		),
	),
) );
function prestige_shortcode_procedures($atts, $content = null) {
	extract(shortcode_atts(array(
		'procedure_title'    	=> 'Feel Relax',
		'procedure_subtitle'	=> 'We are doing so fast and easy in order too keep you calm',
	), $atts));

	$output = null;

	$query = new WP_Query(
		array(
			'post_type' => 'dental_procedures',
			'post_status' => 'publish',
			'posts_per_page' => -1
		)
	);

	if ($query->have_posts()) {
		$output .='
		<section class="procedure-posts section-padding text-center">
			<div class="container">
				<div class="section_title about_title">
					<h2>'.$procedure_title.'</h2>
					<h3>'.$procedure_subtitle.'</h3>
				</div>
				<div class="section_content clearfix">
					<div class="row">';
						while ($query->have_posts()) :	$query->the_post();
							$price = get_field('procedure_price');
							$procedureImg = '';
							if ( has_post_thumbnail()) {
								$bgImage = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'img-size371x249' );
								$procedureImg = '<img src="'.$bgImage[0].'" alt="">';
							} else{
								$procedureImg = '<img src="'.get_template_directory_uri().'/images/procedure-img.jpg" alt="">';
							}
							$output .='
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="procedure_post">
									<div class="procedure_img">
										<a href="#">'. $procedureImg .'</a>
										<div class="hover-effect">
											<a href="#">
												<i class="fa fa-search-plus"></i>
												<span class="details">more details</span>
											</a>
										</div>
									</div>
									<h5><a href="#">'. get_the_title() .'</a> <span class="price"><strong>$</strong>'. $price .'</span></h5>
									<p>'. get_the_excerpt() .'</p>
								</div>
							</div>';
						endwhile;
						wp_reset_postdata();
						$output .='
					</div>
				</div>
			</div>
		</section>';
	}
	return $output;
}
add_shortcode('procedures_element', 'prestige_shortcode_procedures');



if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_reviews_container extends WPBakeryShortCodesContainer {
    }
    class WPBakeryShortCode_insurance_logo_container extends WPBakeryShortCodesContainer {
    }
    class WPBakeryShortCode_timeline_container extends WPBakeryShortCodesContainer {
    }
    class WPBakeryShortCode_team_members_container extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_prestige_reviews_element extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_prestige_timeline_element extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_team_member_element extends WPBakeryShortCode {
    }
}

/*array(
	"type"        => "dropdown",
	"class"       => "",
	"heading"     => esc_html__("Select Notice","js_composer"),
	"param_name"  => "listingpro_notice",
	'value' => array(
		esc_html__( 'Success', 'js_composer' ) => 'success',
		esc_html__( 'Failed', 'js_composer' ) => 'failed',
	),
	'save_always' => true,
	"description" => "Select notice that you want to show"
),
array(
	'type' 			=> 'checkbox',
	'heading' 		=> __( 'Select location', 'js_composer' ),
	'param_name' 	=> 'location_ids',
	'description' 	=> __( 'Check the checkbox' ),
	'dependency' => array(
		'element' => 'listingpro_notice',
		'value' => 'success'
	),
	'value' 		=> array(
		esc_html__( 'Success', 'js_composer' ) => 'success',
		esc_html__( 'Failed', 'js_composer' ) => 'failed',
	),
),*/