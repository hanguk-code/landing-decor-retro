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

        <div class="container" v-if="!$fetchState.pending">
            <div class="img-vector">
                <img src="/img/vector-left.png" alt="">
                <img src="/img/vector-right.png" alt="">
                <img src="/img/vector-left-bot.png" alt="">
                <img src="/img/vector-bot-right.png" alt="">
            </div>
            <MenuMobile/>
            <div class="row d-none d-lg-flex">
                <Menu/>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <LeftMenu/>
                    <div class="left-news">
                        <h2>
                            Новинки
                        </h2>
                        <div class="product" v-for="product in newProducts">
                            <div class="product__content">
                                <i class="pos-3"></i>
                                <img
                                    :src="apiWebUrl + '/image/' + product.image_url" alt=""
                                    @error="imageUrlAlt"
                                    :data-image="apiWebUrl + '/image/' + product.image_url"
                                    :data-zoom-image="apiWebUrl + '/image/' + product.image_url"
                                    :alt="product.name"
                                    class="zoom_01"
                                >
                            </div>
                            <div class="product__price">
                                <span>{{ product.price }}</span>
                                <span>Арт: {{ product.article }}</span>
                            </div>
                            <div class="product__link">
                                <n-link :to="product.url" v-html="product.name">
                                    {{ product.name }}
                                </n-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9">
                    <n-link to="/products/all" class="all-catalog">
                        Показать весь ассортимент товара
                    </n-link>
                    <div class="catalog">
                        <n-link :to="cat.url" class="catalog__card" v-for="cat in categories">
                            <div class="catalog__image">
                                <img :src="apiWebUrl + '/image/' + cat.image_url" :alt="cat.name">
                            </div>
                            <div class="catalog__text">
                                {{ cat.name }}
                            </div>
                        </n-link>
                    </div>
                    <div class="content-info">
                        <h2>
                            Заголовок для текст
                        </h2>
                        <p>
                            Как жаль, что современный мир с его прогрессами, социальными нормами и темпами жизни
                            заставляет нас забыть о самом главном – о нашей личности. Так сегодня женщина просто
                            вынуждена порой утрачивать свою природную женственность. Речь идет об одежде, которою мы
                            обычно надеваем на работе и дома, и даже в гостях и на праздники. Брюки, джинсы, рубашки и
                            футболки – это стало не только мужским, но и женским стандартом. А ведь существует одежда,
                            которая предназначена именно для прекрасного пола. Она подчеркивает
                        </p>
                        <a href="#">
                            Читать далее
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex'

import MenuMobile from '~/components/Menu/MenuMobile'
import Menu from '~/components/Menu/Menu'
import LeftMenu from "~/components/Menu/LeftMenu";

export default {
    components: {
        LeftMenu,
        MenuMobile,
        Menu
    },
    head: {
        bodyAttrs: {
            class: 'main-page'
        },
        title: 'Главная Декор Ретро',
        meta: [

            // {
            //     //hid: 'description',
            //     name: 'description',
            //     content: this.productData.product.seo.seo_description,
            // },
            // {
            //     //hid: 'keywords',
            //     name: 'keywords',
            //     content: this.productData.product.seo.seo_keywords,
            // },

        ],
    },
    data() {
        return {
            categories: [],
            newProducts: [],

            loading: false,
            apiWebUrl: process.env.apiWebUrl
        };
    },
    computed: {
        ...mapGetters({
            cartData: 'item/cartData'
        }),
    },

    async fetch() {
        await this.getCategories()
        await this.getNewProducts()
        await this.zoom1()
    },

    methods: {
        async getCategories() {
            const request = await this.$axios.$get(`categories`)
            if (request) {
                this.categories = request.data
            }
        },

        imageUrlAlt(event) {
            event.target.src = this.apiWebUrl + "/image/no_image.jpg"
        },

        async getNewProducts() {
            const request = await this.$axios.$get(`last/products`)
            if (request) {
                this.newProducts = request.data
            }
        },

        zoom1() {
            $(".zoom_01").elevateZoom({
                zoomWindowWidth: 300,
                zoomWindowHeight: 300,
                zoomWindowPosition: 1,
                zoomWindowOffetx: -515,
                lensSize: 500,
            });
        },
    }
}
</script>

<style scoped>

</style>
