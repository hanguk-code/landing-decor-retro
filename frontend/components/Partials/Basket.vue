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
    // data() {
    //     return {
    //         basket: [],
    //         cartData: '',
    //         totalPrice: '',
    //     }
    // },
    computed: {
        ...mapGetters({
            cartData: 'item/cartData',
            basket: 'item/basket',
            totalPrice: 'item/totalPrice'
        }),
    },
    mounted() {
        // if(window.localStorage.getItem('basket')){
        //     this.basket = JSON.parse(window.localStorage.getItem('basket'))
        //     this.cartData = JSON.parse(window.localStorage.getItem('cartData'))
        //     this.totalPrice = JSON.parse(window.localStorage.getItem('totalPrice'))
        // }
    }
}

</script>
<style scoped>

</style>
