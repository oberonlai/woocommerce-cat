import '@master/css';
import './main.scss';
import Cart from './template/cart';

document.addEventListener('alpine:init',() => {
	Alpine.data('cart', Cart);
})

