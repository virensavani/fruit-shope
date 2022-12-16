<?php

/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme('storefront');
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if (class_exists('Jetpack')) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if (storefront_is_woocommerce_activated()) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if (is_admin()) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if (version_compare(get_bloginfo('version'), '4.7.3', '>=') && (is_admin() || is_customize_preview())) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

function fruit_files()
{
	wp_enqueue_script('bootstrap_min_js', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), '1.0', true);
	wp_enqueue_style('font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('kt-bootstrap-style', get_theme_file_uri('/assets/css/bootstrap.min.css'));
	wp_enqueue_style('footer_main_style', get_theme_file_uri('/assets/css/footer.css'));
	wp_enqueue_style('contact_main_style', get_theme_file_uri('/assets/css/contact.css'));
}
add_action('wp_enqueue_scripts', 'fruit_files');
function mailtrap($phpmailer)
{
	$phpmailer->isSMTP();     
    $phpmailer->Host = SMTP_server;  
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Port = SMTP_PORT;
    $phpmailer->Username = SMTP_username;
    $phpmailer->Password = SMTP_password;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From = SMTP_FROM;
    $phpmailer->FromName = SMTP_NAME;

	// $phpmailer->isSMTP();
	// $phpmailer->Host = 'smtp.mailtrap.io';
	// $phpmailer->SMTPAuth = true;
	// $phpmailer->Port = 2525;
	// $phpmailer->Username = '935df1d91e8c94';
	// $phpmailer->Password = '54584f7ac912f9';
}

add_action('phpmailer_init', 'mailtrap');

function fruit_shop_features()
{
	add_theme_support('menus');
	add_theme_support('header-footer-elementor');
	// Register custom menu positions
	register_nav_menus(array(
		'headerMenuLocation' => __('Header Menu Location'),
		'footerLocationOne' => __('Footer Location One'),
		'footerLocationTwo' => __('Footer Location Two')
	));
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_image_size('fruitLandscape', 400, 260, true);
	add_image_size('fruitPortrait', 400, 600, true);
	add_image_size('siteLogo', 150, 150, true);
	add_image_size('pageBanner', 1500, 350, true);
}

add_action("after_setup_theme", "fruit_shop_features");

// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
	$ourCurrentUser = wp_get_current_user();

	if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
	$ourCurrentUser = wp_get_current_user();

	if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}

function contact_us_table()
{

	global $wpdb;

	$table_name = $wpdb->prefix . "contact_us";

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      user_name varchar(60)  NOT NULL DEFAULT '',
      email varchar(60)  NOT NULL DEFAULT '',
      user_subject varchar(15)  NOT NULL DEFAULT '',
      user_message varchar(255)  NOT NULL DEFAULT '',
      PRIMARY KEY id (id)
    ) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

add_action('init', 'contact_us_table');

function createContact()
{
	if (current_user_can('administrator')) {
		global $wpdb;

		$table_name = $wpdb->prefix . "contact_us";

		$contact['user_name'] = sanitize_text_field($_POST['user_name']);
		$contact['email'] = sanitize_email($_POST['email']);
		$contact['user_subject'] = sanitize_text_field($_POST['user_subject']);
		$contact['user_message'] = sanitize_text_field($_POST['user_message']);

		$wpdb->insert($table_name, $contact);
		sendMail(sanitize_email($_POST['email']), sanitize_text_field($_POST['user_message']), sanitize_text_field($_POST['user_subject']));
		wp_safe_redirect(site_url('/contact'));
	} else {
		wp_safe_redirect(site_url());
	}
	exit;
}

function sendMail($email, $message, $subject = 'This Mail for post comment')
{
	//php mailer variables
	$to = get_option('admin_email');
	$subject = $subject;
	$headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";

	//Here put your Validation and send mail
	wp_mail($to, $subject, strip_tags($message), $headers);
}
add_action('admin_post_createcontact', 'createContact');
add_action('admin_post_nopriv_createcontact',  'createContact');

// If a cron job interval does not already exist, create one.
 
// add_filter('cron_schedules', 'cron_time_intervals');
// add_action( 'wp', 'cron_scheduler');
// add_action( 'cast_my_spell', 'auto_spell_cast' );

// function cron_time_intervals($schedules)
// {
// 	$schedules['minutes_10'] = array(
// 		'interval' => 1 * 60,
// 		'display' => 'Every 1 minutes'
// 	);
// 	return $schedules;
// }

// function cron_scheduler() {
// 	if ( ! wp_next_scheduled( 'cast_my_spell' ) ) {
// 		wp_schedule_event( time(), 'minutes_10', 'cast_my_spell');
// 	}
// }

// function auto_spell_cast(){
// 	$message= "Testing cron job";
// 	$subject = "Testing cron job";
// 	wp_mail('viren.karmaln@gmail.com', $message, $subject);
// }