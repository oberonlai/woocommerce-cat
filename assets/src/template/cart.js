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

	},

	decreaseQty() {
		this.qty--;
		// TODO:變零時跳轉
	},

	removeItem() {
		alert('ddd')
	},

	addToCart(producId) {
		this.reqJSON(`${this.routeCart}/add-item`,'POST',{
			'id': producId,
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

	reqJSON(route, reqMethod, reqBody) {
		fetch(route, {
			method: reqMethod,
			headers: {
				"Content-Type": "application/json",
				"Accept": "application/json",
				'Nonce': this.nonce
			},
			body: JSON.stringify(reqBody)
		}).then(resp => {
			return resp.json();
		}).then(data => {
			this.qty = data.items_count
		}).catch((error) => {
			console.log(`Error: ${error}`);
		})
	}

})