<?php

add_shortcode( 'woocat_one_page_cart', 'woocat_one_page_cart_shortcode' );
function woocat_one_page_cart_shortcode() {
	ob_start();
	require_once WOOCAT_PLUGIN_DIR . 'template/Checkout.php';
	return ob_get_clean();
}
