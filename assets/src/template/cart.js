export default (homeUrl, nonce) => ({
	nonce,
	isCartLoading: false,
	cart: [],
	routeCart: homeUrl + '/wp-json/wc/store/v1/cart',
	routeChecout: homeUrl + '/wp-json/wc/store/v1/checkout',
	init() {
		this.getJSON(this.routeCart).then(data => this.cart = data)
	},

	updateQty(type, itemKey, quantity, quantity_limits = null, el = null) {
		let qty;	
		
		quantity = parseInt(quantity)
		quantity_limits = parseInt(quantity_limits)
		
		switch (type) {
			case 'decre':
				qty = (quantity === 1) ? 1 : quantity - 1
				el.parentElement.querySelector('input')._x_model.set(qty)
				break;
			case 'incre':
				qty = (quantity >= quantity_limits) ? quantity_limits : quantity + 1
				el.parentElement.querySelector('input')._x_model.set(qty)
				break;
			case 'change':
				qty = (quantity >= quantity_limits) ? quantity_limits : quantity;
				(qty) ? el._x_model.set(qty) : el._x_model.set(1)
				break;
			default:
				break;
		}

		if (qty) {
			this.reqJSON(`${this.routeCart}/update-item`, 'POST', {
				'key': itemKey,
				'quantity': qty,
			}).then(data => { this.cart = data })
		}


	},

	removeItem(itemKey) {
		this.reqJSON(`${this.routeCart}/remove-item`, 'POST', {
			'key': itemKey,
		}).then(data => this.cart = data)
	},

	async getJSON(route) {
		try {
			let response = await fetch(route);
			return await response.json();
		}
		catch (err) {
			return err
		}
	},

	async reqJSON(route, method, body) {
		try {
			let response = await fetch(route, {
				method,
				headers: {
					"Content-Type": "application/json",
					"Accept": "application/json",
					'Nonce': this.nonce
				},
				body: JSON.stringify(body)
			});
			return await response.json();
		}
		catch (err) {
			return err
		}
	},

	validateInt(evt) {

		var theEvent = evt || window.event;
		if (theEvent.type === 'paste') {
			key = event.clipboardData.getData('text/plain');
		} else {
			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode(key);
		}
		var regex = /[0-9]|\./;
		if (!regex.test(key)) {
			theEvent.returnValue = false;
			if (theEvent.preventDefault) theEvent.preventDefault();
		}
	}

})