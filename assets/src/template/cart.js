export default (homeUrl,nonce) => ({
	nonce,
	qty: 0,
	routeCart: homeUrl + '/wp-json/wc/store/v1/cart',
	routeChecout: homeUrl + '/wp-json/wc/store/v1/checkout',
	init() {
		this.getJSON(this.routeCart);
	},

	increaseQty() {
		this.qty++;
		// TODO:檢查商品庫存
		// TODO:各商品的購物車數量

	},

	decreaseQty() {
		this.qty--;
		// TODO:變零時跳轉
	},

	removeItem() {
		alert('ddd')
	},

	addToCart(productId) {
		this.reqJSON(`${this.routeCart}/add-item`,'POST',{
			'id': productId,
    		'quantity': 1
		})
	},

	getCart() {

	},

	getJSON(route) {
		fetch(route).then(resp => {
			return resp.json();
		}).then(data => {
			this.qty = data.items_count
			console.log(data)
		}).catch((error) => {
			console.log(`Error: ${error}`);
		})
	},

	reqJSON(route, method, body) {
		fetch(route, {
			method,
			headers: {
				"Content-Type": "application/json",
				"Accept": "application/json",
				'Nonce': this.nonce
			},
			body: JSON.stringify(body)
		}).then(resp => {
			return resp.json();
		}).then(data => {
			this.qty = data.items_count
		}).catch((error) => {
			console.log(`Error: ${error}`);
		})
	}

})