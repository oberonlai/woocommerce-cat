export default () => ({
	qty:1,
	init(){
		// TODO:API 取得 cart item qty
	},

	increaseQty(){
		this.qty++;
		// TODO:檢查商品庫存
	},

	decreaseQty(){
		this.qty--;
		// TODO:變零時跳轉
	},
	
	removeItem(){
		alert('ddd')
	},
})