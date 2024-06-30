<template>
    <div class="numbers-row">
        <input type="text" v-model="quantity" class="qty2" name="quantity_1" />
        <div class="inc button_inc" @click="increment">+</div>
        <div class="dec button_inc" @click="decrement">-</div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            quantity: 1, // Giá trị mặc định ban đầu là 1
        };
    },
    methods: {
        increment() {
            this.quantity += 1;
        },
        decrement() {
            if (this.quantity > 1) {
                this.quantity -= 1;
            }
        },
    },
};
</script>
