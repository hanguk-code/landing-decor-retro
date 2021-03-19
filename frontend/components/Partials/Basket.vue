<template>
    <n-link :to="{ name: 'checkout-cart' }" title="Корзина" class="basket-header">
        <div class="basket-header-icon"></div>
        <div class="basket-header-bar">
            Корзина ({{ basket.length }})
        </div>
    </n-link>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
    computed: {
        ...mapGetters({
            cartData: 'item/cartData',
            basket: 'item/basket',
            totalPrice: 'item/totalPrice'
        }),
    },
    mounted() {
        this.basket = JSON.parse(window.localStorage.getItem('basket'))
    }
}

</script>
<style scoped>

</style>
