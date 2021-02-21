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
                                <img :src="apiWebUrl + '/image/'+product.image_url"
                                     class="zoom_02"/>
                            </div>
                            <div id="gallery_01" class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" v-for="image in product.gallery">
                                        <a
                                            href="#"
                                            class="elevatezoom-gallery"
                                            data-update=""
                                            :data-image="apiWebUrl + '/image/'+image.image_url"
                                            :data-zoom-image="apiWebUrl + '/image/'+image.image_url">
                                            <img
                                                style="width: 98px; margin-left: 3px;"
                                                :src="apiWebUrl + '/image/'+image.image_url"
                                                :alt="image.name"
                                            />
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                        <div class="product-select__content">
                            <div class="article">
                                <p>
                                    Артикул: {{ product.article }}
                                </p>
                            </div>
                            <h2 v-html="product.name"></h2>
                            <span class="product-select__price">
							{{ product.price }} руб.
						</span>
                            <a href="#" class="product-select__link" @click="addToCart">
                                Добавить в корзину
                            </a>
                            <table class="attribute">
                                <tbody>
                                <tr v-for="attribute in product.attributes">
                                    <td>{{ attribute.name }}</td>
                                    <td>{{ attribute.description }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div v-html="product.description">
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
        this.swiper()
    },
    methods: {
        swiper() {
            $(".zoom_02").elevateZoom({
                zoomWindowWidth: 300,
                zoomWindowHeight: 300,
                zoomWindowPosition: 1,
                zoomWindowOffetx: 15,
                gallery: 'gallery_01',
                cursor: 'pointer',
            })
                .bind("click", function (e) {
                    var ez = $('.zoom_02').data('elevateZoom');
                    $.fancybox(ez.getGalleryList());
                    return false;
                });

            return new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 5,
                loop: true,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                },
            });
        },

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
