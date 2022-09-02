<?php

/**
 * WooCommerce Cat
 *
 * @link              https://oberonlai.blog
 * @since             1.0.0
 * @package           WOOCAT
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Cat
 * Plugin URI:        https://oberonlai.blog
 * Description:       WooCommerce checkout like a slim cat.
 * Version:           1.0.0
 * Author:            Oberon Lai
 * Author URI:        https://oberonlai.blog
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocat
 * Domain Path:       /languages
 *
 * WC requires at least: 5.0
 * WC tested up to: 6.7.0
 */

use Automattic\WooCommerce\StoreApi\StoreApi;
use Automattic\WooCommerce\StoreApi\Schemas\ExtendSchema;

use WOOCAT\StoreApi\Gateway;

defined( 'ABSPATH' ) || exit;

define( 'WOOCAT_VERSION', '1.0.0' );
define( 'WOOCAT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WOOCAT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WOOCAT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Autoload
 */
require_once WOOCAT_PLUGIN_DIR . 'vendor/autoload.php';
\A7\autoload( WOOCAT_PLUGIN_DIR . 'src' );

add_action(
	'template_redirect',
	function() {
		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'woocommerce-cat' ) ) {
			$enqueue = new \WPackio\Enqueue( 'woocommerceCat', 'assets/dist', '1.0.0', 'plugin', __FILE__ );
			$enqueue->enqueue( 'app', 'main', array() );
		}
	}
);

/**
 * Extend Store API
 */
add_action(
	'woocommerce_blocks_loaded',
	function() {
		$extend = StoreApi::container()->get( ExtendSchema::class );
		Gateway::init( $extend );
	}
);



// add_action(
// 'init',
// function() {
// echo wp_create_nonce( 'wc_store_api' );
// }
// );

// add_action(
// 'init',
// function() {
// $store_url    = 'https://wc.test';
// $endpoint     = '/wc-auth/v1/authorize';
// $params       = array(
// 'app_name'     => 'woocommerce-cat',
// 'scope'        => 'read_write',
// 'user_id'      => get_current_user_id(),
// 'return_url'   => 'https://wc.test/return_url',
// 'callback_url' => 'https://wc.test/callback_url',
// );
// $query_string = http_build_query( $params );
// echo $store_url . $endpoint . '?' . $query_string;
// }
// );


//$options = array(
//	'method'  => 'POST',
//	'timeout' => 60,
//	'headers' => array(
//		'Content-Type'  => 'application/json',
//		'Authorization' => 'Basic ' . base64_encode( CONSUMER_KEY . ':' . CONSUMER_SECRET ),
//	),
//);

//$response = wp_remote_request( 'https://wc.test/wp-json/wc/v3/customers', $options );
//print_r( $response );

//$data = array(
//	'email'      => 'm615926@gmail.com',
//	'first_name' => 'Oberon',
//	'last_name'  => 'Lai',
//	'username'   => 'm615926',
//	'billing'    => array(
//		'first_name' => 'Oberon',
//		'last_name'  => 'Lai',
//		'company'    => '',
//		'address_1'  => '中山路一段',
//		'address_2'  => '',
//		'city'       => '新北市',
//		'state'      => '',
//		'postcode'   => '123',
//		'country'    => 'TW',
//		'email'      => 'm615926@gmail.com',
//		'phone'      => '0912345678',
//	),
//);

//print_r( $woocommerce->post( 'customers', $data ) );

//$data = array(
//	'first_name' => 'Huang',
//	'billing'    => array(
//		'first_name' => 'Emma',
//	),
//);

//$response = $woocommerce->put( 'customers/25', $data );
//print_r( $response );
