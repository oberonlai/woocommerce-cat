<?php

namespace WOOCAT\StoreApi;

defined( 'ABSPATH' ) || exit;


class Shipping {

	public static function register() {
		$class = new self();
		add_action( 'woocommerce_shipping_method_add_rate', array( $class, 'add_meta' ), 10, 3 );
	}

	/**
	 * Add shipping meta
	 */
	public function add_meta( $rate, $args, $shipping ) {
		if ( $shipping->cost_requires && $shipping->min_amount ) {
			if ( $shipping->cost_requires === 'min_amount' || $shipping->cost_requires === 'min_amount_or_coupon' ) {
				$rate->add_meta_data( 'free_min_amount', $shipping->min_amount );
			}
		}
		return $rate;
	}
}

Shipping::register();
