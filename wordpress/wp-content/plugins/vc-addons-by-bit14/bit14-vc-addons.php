<?php

/*
Plugin Name: Page Builder Addons for WPBakery
Description: Page Builder Addons for WPBakery are a pack of premium quality addons
Version: 1.4.4
Author: Page Builder Addons
Author URI: https://www.pagebuilderaddons.com
Text Domain: bit14
*/

define( 'PLUGIN_DIR', 'vc-addons-by-bit14/' );
define('assets_url', plugin_dir_url(__FILE__) . 'assets/');

// Side Menu
require_once(plugin_dir_path( __FILE__ ) . '/includes/admin-notice.php');
require_once(plugin_dir_path( __FILE__ ) . '/menus/web-addons.php');
require_once(plugin_dir_path( __FILE__ ) . '/menus/woo-addons.php');
require_once(plugin_dir_path( __FILE__ ) . '/menus/about-us.php');
require_once(plugin_dir_path( __FILE__ ) . '/menus/settings.php');
add_option( 'pb_activated_time', time(), '', false );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('page-builder-addons-premium/bit14-addons.php') ) {
    deactivate_plugins('page-builder-addons-premium/bit14-addons.php');
}

//Call Before VC Init
add_action( 'vc_before_init', 'bit14_free_load_templates' , 5);
add_action('vc_before_init','bit14_before_vc_init');


is_admin() && add_filter( 'gettext', 
    function( $translated_text, $untranslated_text, $domain )
    {
        $old = array(
            "Plugin <strong>activated</strong>.",
            "Selected plugins <strong>activated</strong>." 
        );

        $new = "<strong>Thanks for installing PB Addons!</strong>
<p>We hope you like the plugin. Check plugin Pro Elements from <a href='https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc'>here</a>.</p>
<p>PB Addons offers perpetual licensing - purchase once and use for a lifetime, no hassle or recurring periodic payments. <a href='https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc' target='_blank'>View Pricing</a></p>";

        if ( in_array( $untranslated_text, $old, true ) )
            $translated_text = $new;

        return $translated_text;
     }
, 99, 3 );

function bit14_before_vc_init(){

	$classes = array (
		'bit-counter-lists',
        'bit-iconic-list',
        'bit-headings',
        'bit-progress-bar',
		'bit-testimonial-lists',
        'bit-info-banner',
        'bit-pricing-table',
        'bit-pricing-table-child',
        'bit-helper',
        'bit-tabs',
        'bit-tabs-child',
        'bit-social-icons',
        'bit-audio-player',
        'bit-ribbon',
        'bit-dividers',
        'bit-pie-forms',    
        'bit-pie-register',
        'bit-recent-posts',
        'bit-theme-font',
    );

	$folder = plugin_dir_path( __FILE__ ) . "classes/";

	foreach ( $classes as $class ) {

		$file = 'class-'.$class.'.php';
		include_once $folder.$file;
	}

}

function bit14_free_load_templates() {


    // ============= TEMPLATES
	$templates = array(
        'bit-recent-posts'
    );

	$folder = plugin_dir_path( __FILE__ ) . "templates/";

	foreach ( $templates as $template ) {
		$file = 'template-'.$template.'.php';
        include_once $folder.$file;
	}
}

function rtl_check(){    
    $toggle  = $_POST['rtl_check'];
    update_option( 'bit14_rtl_language', $toggle);
}
add_action( 'wp_ajax_rtl_check', 'rtl_check' );
add_action( 'wp_ajax_nopriv_rtl_check', 'rtl_check' );

function enable_fontawesone_check_pro(){    
    $toggle  = $_POST['enable_fontawesone'];
    update_option( 'bit14_enable_fontawesone', $toggle);
}
add_action( 'wp_ajax_enable_fontawesone', 'enable_fontawesone_check_pro' );
add_action( 'wp_ajax_nopriv_enable_fontawesone', 'enable_fontawesone_check_pro' );

function enable_googlefonts_check_pro(){    
    $toggle  = $_POST['enable_googlefonts'];
    update_option( 'bit14_enable_googlefonts', $toggle);
}
add_action( 'wp_ajax_enable_googlefonts', 'enable_googlefonts_check_pro' );
add_action( 'wp_ajax_nopriv_enable_googlefonts', 'enable_googlefonts_check_pro' );

// Admin Side Menu 
add_action( 'admin_menu', 'admin_menu');
function admin_menu() {
    $count = has_notifications();
    add_menu_page(
        'Page Builder Addons',
        'Page Builder Addons',
        'manage_options',
        'page_builder_addons_main_menu',
        'addons_list_page' ,
        plugins_url(PLUGIN_DIR.'assets/images/pb_icon.png'),
        60
    );
    add_submenu_page(
        'page_builder_addons_main_menu',
        'Addons ',
        'Web Addons (Pro)',
        'manage_options',
        'page_builder_addons_main_menu',
        'addons_list_page'
    );
    add_submenu_page(
        'page_builder_addons_main_menu',
        'Custom Post Type',
        'Custom Post Type (Pro)',
        'manage_options',
        'page_builder_addons_main_menu/#custom-post-type',
        'addons_list_page_cpt'
    );
    add_submenu_page(
        'page_builder_addons_main_menu',
        'Woo Addons (Pro)',
        'Woo Addons (Pro)',
        'manage_options',
        'page_builder_addons_wooaddons',
        'woo_addons_list_page'
    );
    add_submenu_page(
        'page_builder_addons_main_menu',
        'Settings',
        'Settings',
        'manage_options',
        'page_builder_addons_settings',
        'addons_settings_page'
    );
    add_submenu_page(
        'page_builder_addons_main_menu',
        'About Us',
        'About Us',
        'manage_options',
        'page_builder_addons_about_us',
        'about_us_page'
    );
}

//enqueue styles and scripts
add_action('wp_enqueue_scripts','bit14_vc_enqueue_scripts');


function bit14_vc_enqueue_scripts(){

	// assets_url = plugin_dir_url(__FILE__) . 'assets/';

	wp_enqueue_style( 'bit14-vc-addons-free', assets_url.'css/style.css', false );

    $is_fontawesome = get_option( 'bit14_enable_fontawesone');
    
    if($is_fontawesome == "1" && !empty($is_fontawesome)) {
        wp_enqueue_style( 'pro-bit14-fontawesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css' );

        wp_enqueue_script( 'pro-fontawesome', 'https://use.fontawesome.com/b844aaf4ff.js');
    } 
 
    if(get_option('bit14_rtl_language') === '1'){
        wp_enqueue_style( 'rtl', assets_url.'css/rtl.css');
        wp_enqueue_script( 'rtl', assets_url.'js/rtl.js');
    }
}

//enqueue styles and scripts admin
add_action('admin_enqueue_scripts','bit14_vc_admin_enqueue_scripts');
function bit14_vc_admin_enqueue_scripts(){

    wp_enqueue_style('Select2CSS', assets_url . 'css/select2.min.css' );
    wp_enqueue_style( 'pro-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'slickcss', assets_url.'css/slick.min.css', false );
    
	wp_enqueue_style( 'bit14-vc-addons-free', assets_url.'css/admin.css');		
    wp_enqueue_script( 'slickjs', assets_url.'js/slick.js', array('jquery'), false );
    wp_enqueue_script( 'Select2JS',assets_url . 'js/select2.min.js' , array('jquery'), false);
    wp_enqueue_script( 'jquery-ui',assets_url . 'js/jquery-tabs.js' , array('jquery'), false);
	wp_enqueue_script( 'bit14-vc-addons-free', assets_url.'js/admin.js', array('jquery'), false );
	wp_localize_script('bit14-vc-addons-free' , 'pb_data' , array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    wp_enqueue_style( 'notification', assets_url.'css/notification.css', true );
}

add_action( 'admin_footer', 'footer_files_free' );
function footer_files_free(){
    // assets_url = plugin_dir_url(__FILE__) . 'assets/';
    wp_enqueue_script( 'notificationjs', assets_url.'js/notification.js', array('jquery'), true );
    wp_localize_script( 'notificationjs', 'pb_notice', array(
        'nonce'                   => wp_create_nonce( 'pb-admin' ),
        'ajax_url'                => admin_url( 'admin-ajax.php' )
    ) );
}
//Plugin Menu Link
function add_action_links_free( $links, $file ) 
{
    if ( $file != plugin_basename( __FILE__ )){
        return $links;
    }
    
    $links[] = '<a style="color:#13ad11;font-weight:bold" target="_blank" href="https://pagebuilderaddons.com/plan-and-pricing/">'.__("Go Pro","page-builder").'</a>';
    return $links;
}

add_filter( 'plugin_action_links', 'add_action_links_free',10,2 );

// add body class if before-header-widget is active
add_filter( 'body_class', 'body_class_before_header_rtl' );
function body_class_before_header_rtl( $classes ) {
    if(get_option( 'bit14_rtl_language') === '1'){
        $classes[] = 'bit14-rtl-content';
    }
    return $classes;
}

function pb_leave_a_review_request_unpaid()
{
    $show_review_notice   = get_option( 'pb_review_request_delete' );
    if ( empty( $show_review_notice ) ) {				
        
        add_option('pb_install_date', current_time('mysql'));
        $install_date = get_option('pb_install_date');
        if (empty($install_date)) return;
        $diff = round((time() - strtotime($install_date)) / 24 / 60 / 60);
        
        if ($diff < 3) return;

        $review_url = 'https://wordpress.org/support/plugin/vc-addons-by-bit14/reviews/?filter=5';
        ?>
            <div class="notice notice-info pb-admin-notice is-dismissible">
                <p><?php echo  sprintf(
                        __( 'Hi there, we see you have been using Page Builder for a few days now, that is awesome! We hope you like it. We have a favor to ask, could you please %1$sreview us on WordPress?%2$s We like reading your feedback, and it helps us spread the word. Thank you.','page-builder'),
                        '<a href="' . $review_url . '" target="_blank">',
                        '</a>'
                    ); ?></p>
                <p>
                    <a href="<?php echo $review_url; ?>" target="_blank" id="pb_review_in_start" class="button button-primary">
                        <?php _e( 'Sure! I\'d love to give a review.', 'page-builder' ) ?>
                    </a>	&nbsp;
                    <a href="javascript:void(0);" class="button-secondary pb_review_in_link">
                        <?php _e( 'No thanks', 'page-builder' ) ?>
                    </a>
                </p>
            </div>
            <script type="text/javascript">
                jQuery(document).on('click', '#pb_review_in_start', function (e) {
                    jQuery(this).parents('.pb-admin-notice').find( '.notice-dismiss' ).trigger('click');
                });
                
                jQuery(document).on('click', '.pb_review_in_link', function (e) {
                    jQuery(this).parents('.pb-admin-notice').find( '.notice-dismiss' ).trigger('click');
                });
                
                jQuery( '.pb-admin-notice' ).on( 'click', '.notice-dismiss', function() {		
                    var data = {
                        action: 'dismiss_pb_leave_a_review_request_unpaid'
                    };
                    jQuery.post( ajaxurl, data );
                });
            </script>		
        <?php
    }	
}
        
function dismiss_pb_leave_a_review_request_unpaid()
{
    update_option( 'pb_review_request_delete', true );
}
add_action( 'admin_notices',  'pb_leave_a_review_request_unpaid', 1 );
add_action( 'wp_ajax_dismiss_pb_leave_a_review_request_unpaid', 'dismiss_pb_leave_a_review_request_unpaid' );

function pb_woocommerce_marketing_free(){
    $show_review_notice   = get_option( 'pb_woocommerce_marketing_delete' );
    if ( empty( $show_review_notice ) ) {				
    ?>
       <div class="notice notice-info pb-admin-notice-woo is-dismissible ">
            <div class="">
                <img src=<?php echo assets_url."images/pb-logo.png" ?>  alt="pagebuilderaddons">
            </div>
            <div class="">
               <h2>PB Woocommerce Addons for WPBakery Page Builder</h2>
               <p><?php echo  sprintf(__( 'Build your online store with premium quality WooCommerce elements for WPBakery Page Builder.')); ?></p>
               <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=admindashboard&utm_medium=notification-paid&utm_campaign=wooaddons#woocommerce-addons" target="_blank" class="button-secondary"><?php _e( 'Get Addons', 'page-builder' ) ?></a>
           </div>
        </div>
        <script type="text/javascript">
            jQuery( '.pb-admin-notice-woo' ).on( 'click', '.notice-dismiss', function() {		
                var data = {
                    action: 'dismiss_pb_woocommerce_marketing_free'
                };
                jQuery.post( ajaxurl, data );
            });
        </script>	
    <?php
    }
}
function dismiss_pb_woocommerce_marketing_free()
{
    update_option( 'pb_woocommerce_marketing_delete', 'true' );
}
add_action( 'admin_notices',  'pb_woocommerce_marketing_free', 1 );
add_action( 'wp_ajax_dismiss_pb_woocommerce_marketing_free', 'dismiss_pb_woocommerce_marketing_free' );
// remove admin bar
// add_filter('show_admin_bar', '__return_false');

function update_adminbar_free($wp_adminbar) {
    $wp_adminbar->remove_node('wp-logo');
    $wp_adminbar->remove_node('customize');
    $wp_adminbar->remove_node('comments');

    $count = has_notifications();

    $wp_adminbar->add_node([
    'id' => 'pagebuilderaddons',
    'title' => $count ? sprintf( 'Page Builder Addons <span class="pb-admin-bar-menu-notification-counter">%d</span>', $count ) : 'Page Builder Addons',
    'href' => admin_url( 'admin.php?page=page_builder_addons_main_menu' ),
    'meta' => [
        'target' => 'pagebuilderaddons'
    ]
    ]);

    $wp_adminbar->add_node([
    'id' => 'notification',       
    'title' =>  'Notification',
    'parent' => 'pagebuilderaddons',
    'href' => admin_url( 'admin.php?page=page_builder_addons_about_us' ),
    'meta' => [
        'target' => 'pagebuilderaddons'
    ]
    ]);
    $wp_adminbar->add_node([
        'id' => 'settings',       
        'title' =>  'Settings',
        'parent' => 'pagebuilderaddons',
        'href' => admin_url( 'admin.php?page=page_builder_addons_settings' ),
        'meta' => [
        'target' => 'pagebuilderaddons'
        ]
    ]);         
    $wp_adminbar->add_node([
        'id' => 'about_us',       
        'title' => $count ?  'About Us <div class="pb-menu-notification-indicator"></div>' :  'About Us',
        // $indicator     = $count  !== 0  ? '<div class="pb-menu-notification-indicator"></div>' : ''; 
        'parent' => 'pagebuilderaddons',
        'href' => admin_url( 'admin.php?page=page_builder_addons_about_us' ),
        'meta' => [
            'target' => 'pagebuilderaddons'
        ] 
    ]);  
}

add_action('admin_bar_menu', 'update_adminbar_free', 999);
/**
 * Load the plugin admin notifications functionality and initializes it.
 *
 * @return Notifications
 */
function get_notifications() {

    static $notifications;

    if ( ! isset( $notifications ) ) {
        $notifications = apply_filters(
            'pb_get_notifications',
            new PB_Admin_Notices()
        );

        if ( method_exists( $notifications, 'init' ) ) {
            $notifications->init();
        }
    }

    return $notifications;
}
add_action( 'init',  'get_notifications' );


/**
 * Check if new notifications are available.
 *
 *
 * @return bool
 */
function has_notifications() {
    
    return get_notifications()->get_count();
}

// add body class if before-header-widget is active
add_filter( 'body_class', 'body_class_before_header' );
function body_class_before_header( $classes ) {
    if(get_option( 'bit14_rtl_language') === '1'){
        $classes[] = 'bit14-rtl-content';
    }
    return $classes;
}
function web_addons_banner(){
?>
     <div class="woo_addons">
        <div class="container">
            <div class="woo_banner_1">
                <div class="woo_section">
                    <div class="woo_card_addons">
                        <img src="https://pagebuilderaddons.com/wp-content/themes/satisfy-child/images/web_addons.png" alt="web_addons">
                    </div>
                    <div class="woo_card_content">
                        <div class="woo_text">
                            <h2 class="woo_heading">Get PB All-in-One Web Addons For $29.99</h2>
                            <p class="woo_para">Build your website with premium quality All-in-One Web elements for WPBakery Page Builder.</p>
                            <div class="woo_btn">
                                <a href="https://pagebuilderaddons.com/plan-and-pricing/#web-addons">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="woo_card_moneyback">
                        <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/images/badge.png'); ?>" alt="web_addons">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
add_shortcode('web_addons_banner', 'web_addons_banner');
function woo_addons_banner(){
?>
    <div class="woo_addons">
		<div class="container">
			<div class="woo_banner_2">
				<div class="woo_section">
					<div class="woo_card_woocommerce">
						<img src="https://pagebuilderaddons.com/wp-content/themes/satisfy-child/images/woocommerce.png" alt="woocommerce">
					</div>
					<div class="woo_card_content">
						<div class="woo_text">
							<h2 class="woo_heading">Get PB WooCommerce Addons For $14.99</h2>
							<p class="woo_para">Build your online store with premium quality WooCommerce elements for WPBakery Page Builder.</p>
							<div class="woo_btn">
								<a href="https://pagebuilderaddons.com/plan-and-pricing/#woocommerce-addons">Buy Now</a>
							</div>
						</div>
					</div>
                    <div class="woo_card_moneyback">
                        <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/images/badge.png'); ?>" alt="web_addons">
                    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
add_shortcode('woo_addons_banner', 'woo_addons_banner');
function send_in_blue(){
?>
    <div class="sendin-blue">
        <iframe width="360" height="700" src="https://66ac0bda.sibforms.com/serve/MUIEAFspdQFEHvhp9ApZ7LxrsNwIYPio9BkokJ4JOUnxo7zNwi-0Wk3Ya7buEraCpkU9IVk2O9ghe7EZNYN0eecaHxmmihNmU09wrT-TdX5EAesubJFFkvXQ_3zQawWKPE-xzbYDfNcpyabHsvRHqFPzY8l2opR-1iKIS-qv-84MGFahj34sTo-Bomz-vf7hNKyzbXcHdeCpBZmi" frameborder="0" scrolling="auto" allowfullscreen style="display: block;margin-left: auto;margin-right: auto;max-width: 100%;"></iframe>
    </div>
<?php
}
add_shortcode('send_in_blue', 'send_in_blue');