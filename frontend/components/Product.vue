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
                            <img :src="apiWebUrl + '/image/' + product.image_url"
                                 class="zoom_04"/>
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
</template>

<script>
export default {
    components: {},
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
        }
    },
    props: ['product'],

    mounted() {
        this.swiper()
    },
    methods: {
        swiper() {
            $('.zoomContainer').remove()
            $(".zoom_04").elevateZoom({
                zoomWindowWidth: 300,
                zoomWindowHeight: 300,
                zoomWindowPosition: 1,
                zoomWindowOffetx: 15,
                gallery: 'gallery_01',
                cursor: 'pointer',
            });

            return new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 5,
                loop: true,
                freeMode: true,
                grabCursor: true,
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
