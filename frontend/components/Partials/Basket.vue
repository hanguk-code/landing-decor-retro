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
        if(window.localStorage.getItem('basket')){
            this.$store.dispatch('item/restoreBasket', {
                basket: JSON.parse(window.localStorage.getItem('basket')),
                totalPrice: parseFloat(window.localStorage.totalPrice)
            })
        }
    }
}

</script>
<style scoped>

</style>
