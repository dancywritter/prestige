<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
	
	$allowed_html_array = array(
		'i' => array(
			'class' => array()
		),
		'span' => array(
			'class' => array()
		),
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array()
		)
	);


    // This is your option name where all the Redux data is stored.
    $opt_name = "prestige_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';


    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();



    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'max_logistics' ),
        'page_title'           => __( 'Theme Options', 'max_logistics' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => true,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.


    );




    
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */




    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
	// -> START General Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Settings', 'max_logistics' ),
        'id'               => 'general-settings',
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
        'fields'     => array(
			array(
                'id'       => 'primary_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo ', 'max_logistics' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload your logo here', 'max_logistics' ),
                'default'  => array( 'url' => get_template_directory_uri().'/images/logo.png' ),
            ),
			array(
                'id'       => 'theme_favicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Favicon ', 'max_logistics' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload your Favicon here', 'max_logistics' ),
                'default'  => array( 'url' => get_template_directory_uri().'/images/favicon.ico' ),
            ),
        )
    ) );

	// -> START Basic Fields
    /* Redux::setSection( $opt_name, array(
        'title'            => __( 'Header', 'max_logistics' ),
        'id'               => 'Header',
        'customizer_width' => '400px',
        'icon'             => 'el el-eject',
		'fields'     => array(
			array(
                'id'       => 'header_address',
                'type'     => 'text',
                'title'    => __( 'Address', 'max_logistics' ),
                'subtitle' => __( '', 'max_logistics' ),
                'default'  => 'Dubai - UAE',
            ),
			array(
                'id'       => 'header_phone',
                'type'     => 'text',
                'title'    => __( 'Phone', 'max_logistics' ),
                'subtitle' => __( '', 'max_logistics' ),
                'default'  => '800 - Boating',
            ),
			array(
                'id'       => 'header_timing',
                'type'     => 'text',
                'title'    => __( 'Timings', 'max_logistics' ),
                'subtitle' => __( '', 'max_logistics' ),
                'default'  => '9.00 AM - 6.00 Pm',
            ),
        )
    ) ); */

	// -> START Footer Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer', 'max_logistics' ),
        'desc'            => __( 'Add or edit Footer information', 'max_logistics' ),
        'id'               => 'footer_section_information',
        'customizer_width' => '400px',
        'icon'             => 'el el-align-center',
        //'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'footer_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Favicon ', 'max_logistics' ),
                'compiler' => 'true',
                'desc'     => __( 'Upload Footer Logo here', 'max_logistics' ),
                'default'  => array( 'url' => get_template_directory_uri().'/images/logo.png' ),
            ),
            array(
                'id'=>'copyright_text',
                'type' => 'textarea',
                'title' => __("Copyright information", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'Copyright &copy; 2016 Prestige Dental Spa - All Rights Reserved'
            ),
        )
    ) );

	// -> START Basic Fields
    /* Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Page', 'max_logistics' ),
        'desc'            => __( 'Translate all text strings into your own language', 'max_logistics' ),
        'id'               => 'contact_page',
        'customizer_width' => '400px',
        'icon'             => 'el el-phone'
    ) ); */	

	// -> START Basic Fields
    /* Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Information', 'max_logistics' ),
        'desc'            => __( 'Add or edit Content Contact information', 'max_logistics' ),
        'id'               => 'contact_page_information',
        'customizer_width' => '400px',
        'icon'             => 'el el-address-book',
        //'subsection' => true,
        'fields'     => array(
            array(
                'id'=>'contact_map',
                'type' => 'textarea',
                'title' => __("Contact Map", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3608.8740742709206!2d55.277752047010566!3d25.24116600000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a1512311313bade!2sMajix+Consultants!5e0!3m2!1sen!2sin!4v1451632953371" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'
            ),
            array(
                'id'=>'contact_head_office_address',
                'type' => 'textarea',
                'title' => __("Head Office Address", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => '<ul>
                <li><i class="fa fa-angle-double-right"></i>Majix Group</li>
                <li><i class="fa fa-angle-double-right"></i>Office 102 , Block B</li>
                <li><i class="fa fa-angle-double-right"></i>Hudaiba Bldg</li>
                <li><i class="fa fa-angle-double-right"></i>Diyafa Road Jumeirah 1</li>
                <li><i class="fa fa-angle-double-right"></i>Dubai , UAE</li>
                <li><i class="fa fa-angle-double-right"></i>Phone : 009714-3887887</li>                             
            </ul>'
            ),
            array(
                'id'=>'contact_workshop_address',
                'type' => 'textarea',
                'title' => __("Workshop Address", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => '<ul>
                <li><i class="fa fa-angle-double-right"></i>Werehouse #2</li>
                <li><i class="fa fa-angle-double-right"></i>Plot No 298</li>
                <li><i class="fa fa-angle-double-right"></i>Al Jurf Industrial</li>
                <li><i class="fa fa-angle-double-right"></i>Area 1 , Ajman</li>
                <li><i class="fa fa-angle-double-right"></i>P.O.Box 6607</li>
                <li><i class="fa fa-angle-double-right"></i>Ajman , UAE</li>
            </ul>'
            ),
            array(
                'id'=>'contact_address',
                'type' => 'text',
                'title' => __("CONTACT DETAILS", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => '<ul>
                <li><i class="fa fa-angle-double-right"></i>800- BOATING</li>
                <li><i class="fa fa-angle-double-right"></i>Phone    : 412222222</li>
                <li><i class="fa fa-angle-double-right"></i>Fax          : 412222222</li>
                <li><i class="fa fa-angle-double-right"></i>E-mail    : service@Majix.com</li>
                <li><i class="fa fa-angle-double-right"></i>Website : majixmarine.com</li>
            </ul>'
            ),
            array(
                'id'=>'contact_phone_number',
                'type' => 'text',
                'title' => __("Phone", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => '07/7487163'
            ),
            array(
                'id'=>'contact_fax_number',
                'type' => 'text',
                'title' => __("Fax Number", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => '04/3887886'
            ),
            array(
                'id'=>'contact_email',
                'type' => 'text',
                'title' => __("Your Email", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'service@Majix.com'
            ),
            array(
                'id'=>'contact_website',
                'type' => 'text',
                'title' => __("Website URL", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'www.majixmarine.com'
            ),
        )
    )); */

    // -> START Basic Fields
    /* Redux::setSection( $opt_name, array(
        'title'            => __( 'Form Settings', 'max_logistics' ),
        'desc'            => __( 'Add or edit Form settings', 'max_logistics' ),
        'id'               => 'contact_page_form',
        'customizer_width' => '400px',
        'icon'             => 'el el-caret-up',
        'subsection' => true,
        'fields'     => array(
        
            array(
                'id'=>'form-title',
                'type' => 'text',
                'title' => __("Title for From", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'Contact us'
            ),
            array(
                'id'=>'form-title',
                'type' => 'text',
                'title' => __("Title for From", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'Contact us'
            ),
            array(
                'id'=>'cp-success-message',
                'type' => 'textArea',
                'title' => __("Success message for contact form", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'Your message was sent successfully! I will be in touch as soon as I can.'
            ),
            array(
                'id'=>'cp-failed-message',
                'type' => 'textArea',
                'title' => __("failed or error message for contact form", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'Something went wrong, try refreshing and submitting the form again.'
            ),
            

        )
    ) ); */

    // -> START Social Profile Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Booking Section Settings', 'max_logistics' ),
        'desc'            => __( '', 'max_logistics' ),
        'id'               => 'booking_area',
        'customizer_width' => '400px',
        'icon'             => 'el el-bookmark',
        //'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'booking_background',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Booking Background Image ', 'max_logistics' ),
                'compiler' => 'true',
                'desc'     => __( '', 'max_logistics' ),
                'default'  => array( 'url' => get_template_directory_uri().'/images/booking-bg.jpg' ),
            ),
            array(
                'id'        =>'booking_title',
                'type'      => 'text',
                'title'     => __("Booking Title", 'max_logistics'),
                'subtitle'  => __('', 'max_logistics'),
                'default'   => 'book your appointment'
            ),
            array(
                'id'        =>'booking_text',
                'type'      => 'text',
                'title'     => __("Booking Text", 'max_logistics'),
                'subtitle'  => __('', 'max_logistics'),
                'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore'
            ),
            array(
                'id'        =>'booking_form',
                'type'      => 'text',
                'title'     => __("Booking Form Shortcode", 'max_logistics'),
                'subtitle'  => __('', 'max_logistics'),
                'default'   => '[contact-form-7 id="12" title="Contact form 1"]'
            ),
        )
    ) );

    // -> START Social Profile Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social Profile Settings', 'max_logistics' ),
        'desc'            => __( 'Set Social Profile links', 'max_logistics' ),
        'id'               => 'social_network',
        'customizer_width' => '400px',
        'icon'             => 'el el-share',
        //'subsection' => true,
        'fields'     => array(
            array(
                'id'=>'facebook',
                'type' => 'text',
                'title' => __("Facebook URL", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'https://facebook.com/'
            ),
            array(
                'id'=>'twitter',
                'type' => 'text',
                'title' => __("Twitter URL", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'https://twitter.com/'
            ),
            array(
                'id'=>'instagram',
                'type' => 'text',
                'title' => __("Instagram URL", 'max_logistics'),
                'subtitle' => __('', 'max_logistics'),
                'default' => 'https://instagram.com/'
            ),
        )
    ) );

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'max_logistics' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
    * <--- END SECTIONS
    */
    /*
    *
    * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
    *
    */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'max_logistics' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'max_logistics' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

