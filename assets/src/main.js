import '@master/css';
import './main.scss';
import Alpine from 'alpinejs';
import Cart from './template/cart';
window.Alpine = Alpine;
Alpine.start()

document.addEventListener('alpine:init',() => {
	Alpine.data('cart', Cart);
})
