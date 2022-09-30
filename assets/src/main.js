import '@master/css';
import './main.scss';
//import Alpine from 'alpinejs';
import component from 'alpinejs-component'
import cart from './template/cart';

document.addEventListener('alpine:init',() => {
	Alpine.data('cart', cart);
})

window.addEventListener('DOMContentLoaded', () => {
	window.Alpine = Alpine;
	Alpine.start()
})

