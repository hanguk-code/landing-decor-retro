<template>
    <section class="content" id="content">

        <n-link :to="{ name: 'checkout-cart' }" title="Корзина" v-if="cartData">
            <div class="mycart-container">
                <div class="mycart"></div>
                <div class="mycart-button"> {{ cartData.price }} руб.(1)</div>
            </div>
        </n-link>

        <div id="modal-1" class="modal-1" style="display: none;">
            <h3>
                Написать нам
            </h3>
            <form action="#">
                <label>Ваше имя:</label>
                <input type="text" name="name">
                <label>Ваш E-Mail:</label>
                <input type="email" name="email">
                <label>Ваш вопрос:</label>
                <textarea name="question" rows="10">

		</textarea>
                <button type="submit">
                    Отправить
                </button>
            </form>
        </div>

        <div class="container">
            <div class="img-vector">
                <img src="/img/vector-left.png" alt="">
                <img src="/img/vector-right.png" alt="">
                <img src="/img/vector-left-bot.png" alt="">
                <img src="/img/vector-bot-right.png" alt="">
            </div>

            <MenuMobile/>
            <div class="row">
                <Menu/>
                <div class="col-12">
                    <div class="bread">
                        <ul>
                            <li v-for="bc, i in product.breadcrumbs">
                                <n-link :to="bc.url" v-html="bc.name"></n-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-select">
                        <div class="slider">
                            <div class="slider__zoom">
                                <img id="img_01" :src="apiWebUrl + '/image'+product.image_url"/>

                            </div>
                            <div class="swiper-container gallery-thumbs">
                                <img v-for="image, i in product.gallery" style="width: 98px; margin-left: 3px;"
                                     :src="apiWebUrl + '/image'+image.image_url" :alt="image.name">
                            </div>
                        </div>
                        <div class="product-select__content">
                            <div class="article">
                                <p>
                                    Артикул: {{ product.article }}
                                </p>
                            </div>
                            <h2 v-html="product.name">

                            </h2>
                            <span class="product-select__price">
							{{ product.price }} руб.
						</span>
                            <a href="#" class="product-select__link" @click="addToCart">
                                Добавить в корзину
                            </a>
                            <table class="attribute">
                                <tbody>
                                <tr v-for="attribute, i in product.attributes">
                                    <td>{{ attribute.name }}</td>
                                    <td>{{ attribute.description }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div v-html="product.description" style="color: #000000;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex'

import MenuMobile from './Menu/MenuMobile'
import Menu from './Menu/Menu'

export default {
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
        }
    },
    components: {
        MenuMobile,
        Menu
    },
    props: ['product'],

    computed: {
        ...mapGetters({
            cartData: 'item/cartData'
        }),
    },
    mounted() {
        // console.log('wefwef')
        // console.log(this.cartData)
    },
    methods: {
        addToCart() {
            this.$store.dispatch('item/saveCartItem', {
                cartData: this.product
            })
        }
    }
}


</script>

<style scoped>

</style>
