<?php

namespace WOOCAT\StoreApi;

use Automattic\WooCommerce\StoreApi\Schemas\ExtendSchema;

defined( 'ABSPATH' ) || exit;

class Gateway {
	/**
	 * Stores Rest Extending instance.
	 *
	 * @var ExtendSchema
	 */
	private static $extend;

	/**
	 * Plugin Identifier, unique to each plugin.
	 *
	 * @var string
	 */
	const IDENTIFIER = 'gateway';

	/**
	 * Bootstraps the class and hooks required data.
	 *
	 * @param ExtendSchema $extend_rest_api An instance of the ExtendSchema class.
	 *
	 * @since 3.1.0
	 */
	public static function init( ExtendSchema $extend_rest_api ) {
		self::$extend = $extend_rest_api;
		self::extend_store();
	}

	/**
	 * Registers the actual data into each endpoint.
	 */
	public static function extend_store() {

		// Register into `cart`
		self::$extend->register_endpoint_data(
			array(
				'endpoint'        => 'cart',
				'namespace'       => self::IDENTIFIER,
				'data_callback'   => __CLASS__ . '::extend_cart_data',
				'schema_callback' => __CLASS__ . '::extend_cart_schema',
				'schema_type'     => ARRAY_A,
			)
		);
	}

	/**
	 * Get payment gateway data
	 *
	 * @return $gateways All avaiable payment gateways
	 */
	public static function get_payment_gateway_data() {
		$gateways = WC()->payment_gateways()->get_available_payment_gateways();

		if ( ! $gateways ) {
			return;
		}

		foreach ( $gateways as $gateway ) {
			unset( $gateway->settings );
			unset( $gateway->form_fields );
			unset( $gateway->plugin_id );
			unset( $gateway->id );
			unset( $gateway->errors );
			unset( $gateway->method_title );
			unset( $gateway->method_description );
			unset( $gateway->has_fields );
			unset( $gateway->countries );
			unset( $gateway->availability );
			unset( $gateway->supports );
			unset( $gateway->view_transaction_url );
			unset( $gateway->new_method_label );
			unset( $gateway->pay_button_id );
			unset( $gateway->order_button_text );
			unset( $gateway->enabled );
			unset( $gateway->locale );
			unset( $gateway->chosen );
		}

		return $gateways;
	}


	/**
	 * Register payment gateway data into cart endpoint.
	 *
	 * @return array $enabled Payment gateway data or empty array if no gateways be enabled.
	 */
	public static function extend_cart_data() {
		return self::get_payment_gateway_data();
	}

	/**
	 * Register payment gateway schema into cart endpoint.
	 *
	 * @return array Registered schema.
	 */
	public static function extend_cart_schema() {

		$schema   = array();
		$gateways = WC()->payment_gateways()->get_available_payment_gateways();

		if ( ! $gateways ) {
			return;
		}

		foreach ( $gateways as $gateway ) {
			switch ( $gateway->id ) {
				case 'bacs':
					$schema['bacs'] = array(
						'type'       => 'object',
						'properties' => array(
							'title'           => array(
								'type'        => 'string',
								'description' => __( 'Bacs name', 'woocat' ),
								'readonly'    => true,
							),
							'description'     => array(
								'type'        => 'string',
								'description' => __( 'Bacs description', 'woocat' ),
								'readonly'    => true,
							),
							'icon'            => array(
								'type'        => 'string',
								'description' => __( 'Bacs icon', 'woocat' ),
								'readonly'    => true,
							),
							'max_amount'      => array(
								'type'        => 'string',
								'description' => __( 'Bacs max amount price', 'woocat' ),
								'readonly'    => true,
							),
							'instructions'    => array(
								'type'        => 'string',
								'description' => __( 'Bacs instructions', 'woocat' ),
								'readonly'    => true,
							),
							'account_details' => array(
								'description' => __( 'Bacs account_details', 'woocommerce' ),
								'type'        => 'object',
								'properties'  => array(
									'account_name'   => array(
										'description' => __( 'Bank account name', 'woocommerce' ),
										'type'        => 'string',
										'context'     => array( 'view', 'edit' ),
										'readonly'    => true,
									),
									'account_number' => array(
										'description' => __( 'Bank account number', 'woocommerce' ),
										'type'        => 'integer',
										'context'     => array( 'view', 'edit' ),
										'readonly'    => true,
									),
									'bank_name'      => array(
										'description' => __( 'Bank name', 'woocommerce' ),
										'type'        => 'string',
										'context'     => array( 'view', 'edit' ),
										'readonly'    => true,
									),
									'sort_code'      => array(
										'description' => __( 'Bank code', 'woocommerce' ),
										'type'        => 'integer',
										'context'     => array( 'view', 'edit' ),
										'readonly'    => true,
									),
									'iban'           => array(
										'description' => __( 'IBAN', 'woocommerce' ),
										'type'        => 'integer',
										'context'     => array( 'view', 'edit' ),
										'readonly'    => true,
									),
									'bic'            => array(
										'description' => __( 'BIC', 'woocommerce' ),
										'type'        => 'integer',
										'context'     => array( 'view', 'edit' ),
										'readonly'    => true,
									),
								),
							),
						),
					);
					break;
				case 'cheque':
					$schema['bacs'] = array(
						'type'       => 'object',
						'properties' => array(
							'title'        => array(
								'type'        => 'string',
								'description' => __( 'Cheque name', 'woocat' ),
								'readonly'    => true,
							),
							'description'  => array(
								'type'        => 'string',
								'description' => __( 'Cheque description', 'woocat' ),
								'readonly'    => true,
							),
							'icon'         => array(
								'type'        => 'string',
								'description' => __( 'Cheque icon', 'woocat' ),
								'readonly'    => true,
							),
							'max_amount'   => array(
								'type'        => 'string',
								'description' => __( 'Cheque max amount price', 'woocat' ),
								'readonly'    => true,
							),
							'instructions' => array(
								'type'        => 'string',
								'description' => __( 'Cheque instructions', 'woocat' ),
								'readonly'    => true,
							),
						),
					);
				default:
					// code...
					break;
			}
		}

		return $schema;

	}
}
