<?php

namespace WOOCAT\StoreApi;

defined( 'ABSPATH' ) || exit;

/**
 * Checkout for Store Api
 */
class Checkout {
	/**
	 * Initialize class and add hooks
	 *
	 * @return void
	 */
	public static function init() {
		$class = new self();
		add_filter( 'woocommerce_store_api_checkout_update_order_from_request', array( $class, 'set_customer_data' ), 10, 2 );
	}
	/**
	 * Set customer data from request
	 *
	 * @param \WC_Order $order WC_Order class.
	 * @param object    $request Http request.
	 *
	 * @return void
	 */
	public function set_customer_data( $order, $request ) {
		if ( $request['customer_id'] ) {
			$order->set_customer_id( $request['customer_id'] );
		}
	}
}

Checkout::init();
