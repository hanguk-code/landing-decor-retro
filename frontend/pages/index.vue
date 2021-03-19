<template>
    <section class="content" id="content">
        <div class="container" v-if="!$fetchState.pending">
            <Vector/>
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
                            обычно надеваем на работе и дома, и даже в гостях и на праздники. Брюки, джинсы, рубашки
                            и
                            футболки – это стало не только мужским, но и женским стандартом. А ведь существует
                            одежда,
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
import MenuMobile from '~/components/Menu/MenuMobile'
import Menu from '~/components/Menu/Menu'
import LeftMenu from "~/components/Menu/LeftMenu";
import Vector from "~/components/Partials/Vector";

export default {
    components: {
        LeftMenu,
        MenuMobile,
        Menu,
        Vector,
    },
    head: {
        bodyAttrs: {
            class: 'main-page'
        },
        title: 'Главная Декор Ретро',
        meta: [
        ],
    },
    data() {
        return {
            categories: [],
            newProducts: [],

            apiWebUrl: process.env.apiWebUrl
        };
    },

    async fetch() {
        await this.getCategories()
        await this.getNewProducts()
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
    }
}
</script>

<style scoped>

</style>
