<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="bread">
                    <ul>
                        <li v-for="bc in product.breadcrumbs">
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
                            <img :src="apiWebUrl + '/image/' + product.image_url" class="zoom_04"/>
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
                                            :src="apiWebUrl + '/image/'+image.image_url"
                                            :alt="image.name"
                                        />
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-button-prev"></div>
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
                        <div v-html="product.description"></div>
                    </div>
                </div>
            </div>

            <!--            <div class="col-12">-->
            <!--                <div class="slider-related">-->
            <!--                    <div id="gallery_02" class="swiper-container gallery-thumbs">-->
            <!--                        <div class="swiper-wrapper">-->
            <!--                            <div class="swiper-slide" v-for="item in relatedProducts">-->
            <!--                                <n-link :to="item.url">-->
            <!--                                    <div class="tovar-inner">-->
            <!--                                        <img-->
            <!--                                            :src="apiWebUrl + '/image/'+item.image_url"-->
            <!--                                            :title="item.name"-->
            <!--                                            :alt="item.name"-->
            <!--                                            @error="imageUrlAlt"-->
            <!--                                            class="zoom_01"-->
            <!--                                            width="200"-->
            <!--                                        >-->
            <!--                                    </div>-->
            <!--                                    <div v-html="item.name"></div>-->
            <!--                                </n-link>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="swiper-button-prev"></div>-->
            <!--                        <div class="swiper-button-next"></div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</template>

<script>
import {isMobileOnly} from 'mobile-device-detect';

export default {
    components: {},
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
            isMobile: isMobileOnly,
            relatedProducts: []
        }
    },
    props: ['product'],

    mounted() {
        this.swiper()
        this.getRelatedProducts()
    },

    methods: {
        imageUrlAlt(event) {
            event.target.src = this.apiWebUrl + "/image/no_image.jpg"
        },

        async getRelatedProducts() {
            const request = await this.$axios.$get(`/related/products`, {params: {product_id: this.product.id}})
            this.relatedProducts = request.data
            await this.swiper2()
        },

        swiper2() {
            if (!this.isMobile) {
                $('.zoomContainer').remove()
                $(".zoom_04").elevateZoom({
                    zoomWindowWidth: 300,
                    zoomWindowHeight: 300,
                    zoomWindowPosition: 1,
                    zoomWindowOffetx: 15,
                    cursor: 'pointer',
                });
            }

            new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 15,
                loop: false,
                freeMode: true,
                grabCursor: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                navigation: {
                    prevEl: '.swiper-button-prev',
                    nextEl: '.swiper-button-next',
                },
            });
        },


        swiper() {
            $('.zoomContainer').remove()
            if (!this.isMobile) {
                $(".zoom_04").elevateZoom({
                    zoomWindowWidth: 300,
                    zoomWindowHeight: 300,
                    zoomWindowPosition: 1,
                    zoomWindowOffetx: 15,
                    lensSize: 500,
                    gallery: 'gallery_01',
                    cursor: 'pointer',
                });
            } else {
                $(".zoom_04").elevateZoom({
                    // zoomType: "lens",
                    zoomWindowWidth: 0,
                    zoomWindowHeight: 0,
                    zoomWindowPosition: 1,
                    zoomWindowOffetx: 15,
                    gallery: 'gallery_01',
                    cursor: 'pointer',
                });
            }

            return new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 5,
                zoom: true,
                loop: false,
                freeMode: true,
                grabCursor: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                navigation: {
                    prevEl: '.swiper-button-prev',
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
