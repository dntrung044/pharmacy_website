import { defineStore } from 'pinia';
import { useToast } from "vue-toastification";
const toast = useToast()

export const useCartStore = defineStore('cart', {
    state: () => ({
        cart: JSON.parse(localStorage.getItem('cart') || '[]'),
        discount: null,
        discountCode: null,
        discountValue: 0
    }),
    actions: {
        addToCart(product) {
            const existingProduct = this.cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity++;
                toast.success("Đã thêm sản phẩm vào giỏ hàng!", {
                    timeout: 2000
                });
            } else {
                this.cart.push({ ...product, quantity: 1 });
                toast.success("Đã thêm sản phẩm vào giỏ hàng!", {
                    timeout: 2000
                });
            }
            this.saveCart();
        },
        addToCart_quantity(product, quantity) {
            const existingProduct = this.cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                state.cart.push({ ...product, quantity });
            }
            this.saveCart();
        },

        removeFromCart(productId) {
            this.cart = this.cart.filter(item => item.id !== productId);
            this.saveCart();
            toast.success("Đã loại sản phẩm ra giỏ hàng!", {
                timeout: 2000
            });
        },
        updateQuantity(productId, quantity) {
            const product = this.cart.find(item => item.id === productId);
            if (product) {
                product.quantity = quantity;
                if (product.quantity <= 0) {
                    this.removeFromCart(productId);
                    toast.success("Đã loại sản phẩm ra giỏ hàng!", {
                        timeout: 2000
                    });
                } else {
                    this.saveCart();
                    toast.success("Đã cập nhật sản phẩm ra giỏ hàng!", {
                        timeout: 2000
                    });
                }
            }
        },
        saveCart() {
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        loadCart() {
            this.cart = JSON.parse(localStorage.getItem('cart') || '[]');
        },
        async applyDiscount(code) {
            try {
                const response = await axios.post('/api/discounts/apply', { code });
                const discount = response.data.discount;

                this.discount = discount;
                this.discountCode = code;

                if (discount.condition === 1) {
                    this.discountValue = discount.amount;
                } else if (discount.condition === 2) {
                    this.discountValue = (this.cartTotal * discount.amount) / 100;
                }

                localStorage.setItem('discount', JSON.stringify({
                    code: this.discountCode,
                    discount: this.discount,
                    discountValue: this.discountValue
                }));
                toast.success("Áp dụng mã giảm giá thành công!", {
                    timeout: 2000
                });
            } catch (error) {
                throw error;
            }
        },
        loadDiscount() {
            const savedDiscount = JSON.parse(localStorage.getItem('discount'));
            if (savedDiscount) {
                this.discount = savedDiscount.discount;
                this.discountCode = savedDiscount.code;
                this.discountValue = savedDiscount.discountValue;
            }
        }
    },
    getters: {
        cartTotal: (state) => {
            return state.cart.reduce((total, item) => {
                return total + item.price * item.quantity;
            }, 0);
        },
        finalTotal: (state) => {
            return state.cartTotal - state.discountAmount;
        }
    }
});
