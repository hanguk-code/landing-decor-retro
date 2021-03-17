<template>
    <n-link :to="{ name: 'checkout-cart' }" title="Корзина" v-if="totalPrice">
        <div class="mycart-container">
            <div class="mycart"></div>
            <div class="mycart-button"> {{ totalPrice }} руб.({{ basket.length }})</div>
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
    }
}

</script>
<style scoped>

</style>
