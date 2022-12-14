<div class="w:100% max-w:890 bg:white">
<!--<Cart>-->
	<div x-data="cart(
		'<?php echo esc_attr( home_url() ); ?>',
		'<?php echo esc_attr( wp_create_nonce( 'wc_store_api' ) ) ?>')
		">
		<h2 class="f:16 color:fade-40 p:5 flex ai:center">
			<svg class="w:18 mr:5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M5.79166 2H1V4H4.2184L6.9872 16.6776H7V17H20V16.7519L22.1932 7.09095L22.5308 6H6.6552L6.08485 3.38852L5.79166 2ZM19.9869 8H7.092L8.62081 15H18.3978L19.9869 8Z"
					fill="currentColor" />
				<path
					d="M10 22C11.1046 22 12 21.1046 12 20C12 18.8954 11.1046 18 10 18C8.89543 18 8 18.8954 8 20C8 21.1046 8.89543 22 10 22Z"
					fill="currentColor" />
				<path
					d="M19 20C19 21.1046 18.1046 22 17 22C15.8954 22 15 21.1046 15 20C15 18.8954 15.8954 18 17 18C18.1046 18 19 18.8954 19 20Z"
					fill="currentColor" />
			</svg>
			<span>購物車明細</span>
		</h2>

		<div class="w:100% border:1px|solid|#ddd box-shadow:0|0|10px|#efefef r:5" x-show="cart.items_count>0">
			<div class="rel
			{grid;grid-template-columns:2fr|1fr|160|1fr|50;p:0}>div@sm
			{p:20;f:16;color:#666;as:center}>div>div@sm
			{p:10|20;bg:#f0f1f3;f:14;f:gray-60}>div:first-child>div@sm
			{p:20;rel;bb:1px|solid|fade-88}>div">
				<div class="d:block@sm d:none">
					<div>商品明細</div>
					<div>單價</div>
					<div>數量</div>
					<div>小計</div>
					<div>&nbsp;</div>
				</div>
				<template x-for="item in cart.items" :key="item.id">
					<div :id="`item-${item.key}`">
						<div class="flex jc:space-between ai:center">
							<div class="w:38% aspect:4/3 r:4) bg:cover" :style="`background-image:url(${item.images[0].src})`">
							</div>
							<div class="w:58%">
								<h3 class="m:0 mb:5 f:16 f:18@sm" x-text="item.name"></h3>
								<p class="m:0 f:14@sm f:12"></p>
								<p class="m:10|0|0|0 f:16 d:block d:none@sm" x-text="item.prices.currency_symbol+new Intl.NumberFormat().format(item.prices.price)"></p>
							</div>
						</div>
						<div class="d:none d:block@sm" x-text="item.prices.currency_symbol+new Intl.NumberFormat().format(item.prices.price)"></div>
						<div class="mt:10 mt:0@sm float:left rel">
							<div class="
							d:flex flex-wrap:wrap ai:center rel
							{w:32;h:32;f:20;b:1px|solid|fade-80;bg:none;cursor:pointer;r:4;t:center}>div">
								<div type="button" class="bg:fade-90:hover" :class="item.quantity === 1 ? 'pointer-events:none opacity:.5':''" @click.prevent="updateQty('decre',item.key,item.quantity,'',$el)">-</div>
								<input class="bg:fade-90! f:14 w:40 b:1px|solid|fade-80 h:36 t:center mx:7 r:4" type="text" x-model="item.quantity" @keyup="updateQty('change',item.key,$el.value,item.quantity_limits.maximum,$el);" x-mask="999" />
								<div type="button" class="bg:fade-90:hover" :class="item.quantity >= item.quantity_limits.maximum ? 'pointer-events:none opacity:.5':''" @click.prevent="updateQty('incre',item.key,item.quantity,item.quantity_limits.maximum,$el)">+</div>
								<template x-if="item.quantity_limits.maximum!==9999">
									<p x-show="item.quantity>=item.quantity_limits.maximum" class="abs bottom:-38 f:12 f:red t:center w:100%">庫存上限 <span x-text="item.quantity_limits.maximum"></span></p>	
								</template>
							</div>
						</div>
						<div class="float:right f:24 f:red-50 float:none@sm mt:10 mt:0@sm" x-text="item.prices.currency_symbol+new Intl.NumberFormat().format((item.prices.price*item.quantity))"></div>
						<div class="clear:both d:block d:none@sm"></div>
						<div class="cursor:pointer p:0! abs top:0 right:5 rel@sm" @click.prevent="removeItem(item.key)">
							<span class="f:red-60">
								<svg class="w:22 mt:10" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z"
										fill="currentColor" />
									<path d="M9 9H11V17H9V9Z" fill="currentColor" />
									<path d="M13 9H15V17H13V9Z" fill="currentColor" />
								</svg>
							</span>
						</div>
					</div>
				</template>
			</div>
			<div class="bg:#f0f1f3">
				<div class="p:10 t:right f:14">購物車內合計有 <span x-text="cart.items_count"></span> 項商品</div>
			</div>
			<div x-show="isCartLoading">載入中</div>
		</div>
		<div x-show="cart.items_count===0">購物車內沒有商品</div>
	</div>
<!--</Cart>-->

<!--<AddOn>-->
<!--</AddOn>-->

<!--<Member>-->
<!--</Member>-->

<!--<PaymentShipping>-->
<!--</PaymentShipping>-->
</div>