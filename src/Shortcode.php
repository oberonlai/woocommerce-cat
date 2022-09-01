<?php

add_shortcode( 'woocommerce-cat', 'woocat_shortcode' );
function woocat_shortcode( $atts ) {
	ob_start();
	//$a = shortcode_atts( array(
	//		'引數 1'   =>  '引數預設值',
	//		'引數 2'   =>  '引數預設值',
	//	),
	//$atts );
	/* 定義回傳的初始值 */
	//$output = '<h1 class="f:60">Hello World aaa</h1>';
	require_once WOOCAT_PLUGIN_DIR . 'template/Checkout.php';

	/* 接下來可以用 $a 來組合要用的字串 */
	//$output .= '<a href="' . $a['引數 1'] . '">';
	//$output .= $a['引數 2'] . '</a>';

	/* 最後要將組合後的字串回傳 */
	return ob_get_clean();
}
