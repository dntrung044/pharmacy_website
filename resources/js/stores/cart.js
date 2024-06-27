import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
    state: () => ({
        cart: JSON.parse(localStorage.getItem('cart')) || []
    }),
    actions: {
        addToCart(product) {
            const item = this.cart.find(item => item.productId === product.productId);
            if (item) {
                item.quantity += product.quantity;
            } else {
                this.cart.push({ ...product });
            }
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        removeFromCart(productId) {
            this.cart = this.cart.filter(item => item.productId !== productId);
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        updateQuantity(productId, quantity) {
            const item = this.cart.find(item => item.productId === productId);
            if (item) {
                item.quantity = quantity;
            }
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        clearCart() {
            this.cart = [];
            localStorage.setItem('cart', JSON.stringify(this.cart));
        }
    },
    getters: {
        cartItems: state => state.cart,
        cartTotal: state => state.cart.reduce((total, item) => total + item.price * item.quantity, 0)
    }
});
