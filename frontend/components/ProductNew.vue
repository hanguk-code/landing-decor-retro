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
                <textarea name="question" rows="10"></textarea>
                <button type="submit">Отправить</button>
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
            <div class="row d-none d-lg-flex">
                <Menu/>
                <div class="col-12">
                    <div class="bread">
                        <ul>
                            <li>
                                <n-link to="/">
                                    Главная
                                </n-link>
                            </li>

                            <li>
                                <n-link to="/products/new">
                                    Новинки товара
                                </n-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <ul class="left-menu d-none d-lg-block">
                        <li v-for="cat in categories">
                            <n-link :to="cat.url" class="open-submenu menu__dropdown">
                                {{ cat.name }}
                                <img src="/img/minus.png" alt="">
                            </n-link>
                            <ul class="sub-menu" :style="showChild(cat.url)">
                                <li v-for="catChild, indexChild in cat.children">
                                    <n-link :to="catChild.url">
                                        {{ catChild.name }}
                                    </n-link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8 col-md-9">
                    <h2 class="catalog-title">
                        Новинки товара
                    </h2>
                    <div class="catalog">
                        <div class="product" v-for="product in products">
                            <div class="product__content">
                                <i class="pos-3"></i>
                                <img :src="apiWebUrl + '/image/'+product.image_url" alt=""
                                     :data-image="apiWebUrl + '/image/'+product.image_url"
                                     :data-zoom-image="apiWebUrl + '/image/'+product.image_url"
                                     class="zoom_01"/>
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

                        <!--                        <div-->
                        <!--                            v-observe-visibility="pagination.currentPage !== pagination.lastPage ? visibilityChanged : false"></div>-->
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
    components: {
        MenuMobile,
        Menu
    },
    data() {
        return {
            products: [],
            categories: [],
            apiWebUrl: process.env.apiWebUrl,

            query: {
                page: 1
            },

            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                from: '',
                to: ''
            },
        };
    },
    computed: {
        ...mapGetters({
            cartData: 'item/cartData'
        }),
    },
    async fetch() {
        await this.getCategories()
        await this.getProducts()
    },

    methods: {
        async getCategories() {
            const request = await this.$axios.$get(`categories`)
            this.categories = request.data
        },

        async getProducts() {
            const request = await this.$axios.$get(`new/products`)
            this.products = request.data.products
            this.configPagination(request.data.pagination);
        },

        showChild(url) {
            let urlSplit = url.split('/')
            if (urlSplit[1] === this.mainCat) {
                return 'display: block;'
            } else {
                //return 'display: none;'
            }

        },

        // visibilityChanged(e) {
        //     let vm = this
        //     vm.query.page = vm.query.page + 1
        //     if (vm.pagination.currentPage < vm.pagination.lastPage) {
        //         setTimeout(function () {
        //             vm.getProducts()
        //         }, 50);
        //     }
        // },

        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
    }
}
</script>

<style scoped>

</style>
