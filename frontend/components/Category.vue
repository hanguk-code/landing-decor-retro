<template>
    <div class="row">
        <div class="row d-lg-flex" v-show="isMobile">
            <div class="col-12">
                <div class="bread">
                    <ul>
                        <li v-for="b in breadcrumbs" v-if="breadcrumbs">
                            <n-link :to="'/'+b.url">
                                {{ b.name }}
                            </n-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <LeftMenu/>
            </div>
            <div class="col-sm-8 col-md-9">
                <form action="" class="range" v-if="products.length > 0">
                    <h3>
                        Выбор по параметрам
                    </h3>
                    <div class="range__select">
                        <div class="range__top">
                            <div class="range__title">
                                Материал:
                            </div>
                            <select name="" id="">
                                <option value="">Выбрать</option>
                                <option value="">Майолика</option>
                                <option value="">Металл / Эмаль</option>
                                <option value="">Фарвор</option>
                                <option value="">Фарфар</option>
                                <option value="">Фарфор</option>
                                <option value="">фарфор / металл</option>
                                <option value="">Фаянс</option>
                            </select>
                        </div>
                        <div class="range__top">
                            <div class="range__title">
                                Страна:
                            </div>
                            <select name="" id="">
                                <option value="">Выбрать</option>
                                <option value="">Англия</option>
                                <option value="">Бельгия</option>
                                <option value="">Венгрия</option>
                                <option value="">Германия</option>
                                <option value="">Голландия</option>
                                <option value="">Дания</option>
                                <option value="">Италия</option>
                                <option value="">Китай</option>
                                <option value="">Португалия</option>
                                <option value="">СССР</option>
                                <option value="">Франция</option>
                                <option value="">Чехословакия</option>
                                <option value="">Япония</option>
                            </select>
                        </div>

                    </div>
                    <div class="range__slider">
                        <div class="range__top">
                            <div class="range__title">
                                Изготовитель:
                            </div>
                            <select name="" id="">
                                <option value="">Выбрать</option>
                                <option value="">Майолика</option>
                                <option value="">Металл / Эмаль</option>
                                <option value="">Фарвор</option>
                                <option value="">Фарфар</option>
                                <option value="">Фарфор</option>
                                <option value="">фарфор / металл</option>
                                <option value="">Фаянс</option>
                            </select>
                        </div>
                        <div class="range__price d-none d-lg-flex">
                            <div class="polzunok-container-6">
                                <div class="range__title">
                                    Цена:
                                </div>
                                <p>
                                    от
                                </p>
                                <input type="text" v-model="query.price_min" class="polzunok-input-6-left"/>
                                <p>
                                    до
                                </p>
                                <input type="text" v-model="query.price_max" class="polzunok-input-6-right "/>

                            </div>
                            <div class="polzunok-6"></div>
                        </div>
                        <div class="range__top d-flex d-lg-none">
                            <div class="polzunok-container-6">
                                <div>
                                    <div class="range__title">
                                        Цена:
                                    </div>
                                    <div class="polzunok-6"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <p>
                                        от
                                    </p>
                                    <input type="text" v-model="query.price_min" class="polzunok-input-6-left"/>
                                    <p>
                                        до
                                    </p>
                                    <input type="text" v-model="query.price_max" class="polzunok-input-6-right "/>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="range__btn">
                        <a href="#" @click="$emit('queryProducts', query)">
                            Отфильтровать
                        </a>
                        <a href="#" @click="clearQuery()">
                            Сбросить параметры
                        </a>
                    </div>
                </form>
                <h2 class="catalog-title">
                    {{ category.name }}
                </h2>
                <div class="catalog">

                    <div class="product" v-for="subCategory in subCategories">
                        <div class="product__content">
                            <n-link :to="subCategory.url">
                                <img :src="apiWebUrl+'/image/'+subCategory.image_url" alt=""
                                     @error="imageUrlAlt"
                                     :data-image="apiWebUrl+'/image/'+subCategory.image_url"
                                     :data-zoom-image="apiWebUrl+'/image/'+subCategory.image_url">
                            </n-link>
                        </div>
                        <div class="product__link">
                            <n-link :to="subCategory.url">
                                {{ subCategory.name }}
                            </n-link>
                        </div>
                    </div>

                    <div class="product" v-for="product in products">
                        <div class="product__content">
                            <n-link :to="product.url">
                                <img :src="apiWebUrl+'/image/'+product.image_url"
                                     :data-image="apiWebUrl+'/image/'+product.image_url"
                                     :data-zoom-image="apiWebUrl+'/image/'+product.image_url"
                                     @error="imageUrlAlt"
                                     class="zoom_01"
                                     alt=""
                                >
                            </n-link>
                        </div>
                        <div class="product__price">
							<span>
								{{ product.price }}Р
							</span>
                            <span>
								Арт: {{ product.article }}
							</span>
                        </div>
                        <div class="product__link">
                            <n-link :to="product.url" v-html="product.name">

                            </n-link>
                        </div>
                    </div>

                    <div v-observe-visibility="currentPage !== lastPage ? visibilityChanged : false"></div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {isMobileOnly} from 'mobile-device-detect';

export default {
    components: {},
    props: ['categories', 'subCategories', 'products', 'category', 'breadcrumbs', 'currentPage', 'lastPage'],

    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
            isMobile: isMobileOnly,
            query: {
                price_min: '',
                price_max: '',
            },
            mainCat: '',
            showChildren: 'display: block;'
        };
    },

    fetch() {
        let splitUrl = this.$route.params.pathMatch.split('/')

        if (splitUrl[0]) {
            this.mainCat = splitUrl[0]
        } else {
            this.mainCat = splitUrl[1]
        }
    },

    mounted() {
        this.zoom1()
    },

    methods: {
        imageUrlAlt(event) {
            event.target.src = this.apiWebUrl + "/image/no_image.jpg"
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

        clearQuery() {
            this.query = {
                price_min: '',
                price_max: '',
            }

            $emit('queryProducts', this.query)
        },

        visibilityChanged(currentPage) {
            this.currentPage = currentPage + 1
            let nextPage = currentPage + 1
            this.$emit('visibilityChanged', nextPage)
            this.zoom1()
        }
    }
}
</script>

<style scoped>

</style>
