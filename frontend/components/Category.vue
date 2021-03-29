<template>
    <div>
        <div class="row d-lg-flex">
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
                <h2 class="catalog-title">
                    {{ category.name }}
                </h2>

                <div class="range" v-if="subCategories.length < 1">
                    <form action="">
                        <h3 class="text-left">
                            Выбор по параметрам
                        </h3>
                        <div class="range__select">

                            <div class="range__top">
                                <div class="range__title">
                                    Страна:
                                </div>
                                <select @change="setCountry">
                                    <option>Выбрать</option>
                                    <option
                                        v-for="item in countries"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </option>
                                </select>
                            </div>

                            <div class="range__top">
                                <div class="range__title">
                                    Материал:
                                </div>
                                <select @change="setMaterial">
                                    <option value="">Выбрать</option>
                                    <option
                                        v-for="item in materials"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </option>
                                </select>
                            </div>

                            <!--                            <div class="range__top">-->
                            <!--                                <div class="range__title">-->
                            <!--                                    Изготовитель:-->
                            <!--                                </div>-->
                            <!--                                <select>-->
                            <!--                                    <option value="">Выбрать</option>-->
                            <!--                                    <option value="">Майолика</option>-->
                            <!--                                    <option value="">Металл / Эмаль</option>-->
                            <!--                                    <option value="">Фарвор</option>-->
                            <!--                                    <option value="">Фарфар</option>-->
                            <!--                                    <option value="">Фарфор</option>-->
                            <!--                                    <option value="">фарфор / металл</option>-->
                            <!--                                    <option value="">Фаянс</option>-->
                            <!--                                </select>-->
                            <!--                            </div>-->

                            <div class="range-price">
                                <div class="range__top">
                                    <div class="range__title">
                                        Цена:
                                    </div>
                                    <div class="text-center">
                                        <b-form-slider ref="range"
                                                       v-model="rangeValue"
                                                       range
                                                       :min="0"
                                                       :max="1000"
                                                       @slide-stop="slideStop"></b-form-slider>
                                    </div>
                                    <div class="text-center">
                                        <span>от</span>
                                        <input type="text" v-model="this.rangeValue[0]"/>
                                        <span>до</span>
                                        <input type="text" v-model="this.rangeValue[1]"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="range__btn">
                            <a href="#" type="button" @click="setQuery">
                                Применить
                            </a>
                            <a href="#" type="button" @click="clearQuery">
                                Сбросить
                            </a>
                        </div>
                    </form>
                </div>

                <div class="catalog">
                    <div class="product" v-for="subCategory in subCategories">
                        <div class="product__content">
                            <n-link :to="subCategory.url">
                                <img :src="apiWebUrl+'/image/'+subCategory.image_url"
                                     @error="imageUrlAlt"
                                     alt=""
                                >
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
import 'bootstrap-slider/dist/css/bootstrap-slider.css'

export default {
    components: {},
    props: ['categories', 'subCategories', 'products', 'category', 'breadcrumbs', 'currentPage', 'lastPage'],

    data() {
        return {
            rangeValue: [0, 1000],
            apiWebUrl: process.env.apiWebUrl,
            isMobile: this.$parent.isMobile,
            query: {
                price_min: '',
                price_max: '',
                country: '',
                material: '',
            },
            mainCat: '',
            showChildren: 'display: block;',

            materials: [
                {
                    value: 'Майолика',
                    label: 'Майолика',
                },
                {
                    value: 'Металл / Эмаль',
                    label: 'Металл / Эмаль',
                },
                {
                    value: 'Фарвор',
                    label: 'Фарвор',
                },
                {
                    value: 'фарфор / металл',
                    label: 'фарфор / металл',
                },
                {
                    value: 'Фаянс',
                    label: 'Фаянс',
                },
                {
                    value: 'Фарфар',
                    label: 'Фарфар',
                },
            ],

            countries: [
                {
                    value: 'Англия',
                    label: 'Англия'
                },
                {
                    value: 'Бельгия',
                    label: 'Бельгия'
                },
                {
                    value: 'Венгрия',
                    label: 'Венгрия'
                },
                {
                    value: 'Германия',
                    label: 'Германия'
                },
                {
                    value: 'Голландия',
                    label: 'Голландия'
                },
                {
                    value: 'Дания',
                    label: 'Дания'
                },
                {
                    value: 'Италия',
                    label: 'Италия'
                },
                {
                    value: 'Китай',
                    label: 'Китай'
                },
                {
                    value: 'Португалия',
                    label: 'Португалия'
                },
                {
                    value: 'СССР',
                    label: 'СССР'
                },
                {
                    value: 'Франция',
                    label: 'Франция'
                },
                {
                    value: 'Чехословакия',
                    label: 'Чехословакия'
                },
                {
                    value: 'Япония',
                    label: 'Япония'
                },
            ],
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
            if (!this.isMobile) {
                $('.zoomContainer').remove()
                $(".zoom_01").elevateZoom({
                    zoomWindowWidth: 300,
                    zoomWindowHeight: 300,
                    zoomWindowPosition: 1,
                    zoomWindowOffetx: -515,
                    lensSize: 500,
                    cursor: 'pointer',
                });
            }
        },

        slideStop() {
            this.query = {
                price_min: this.rangeValue[0],
                price_max: this.rangeValue[1],
            }
        },

        setQuery(event) {
            event.preventDefault()
            this.$emit('queryProducts', this.query)
        },

        clearQuery(event) {
            event.preventDefault()
            this.query = {
                price_min: '',
                price_max: '',
                country: '',
                material: '',
            }
            this.$emit('queryProducts', this.query)
        },

        setCountry() {
            this.query = {
                country: '',
            }
        },
        setMaterial() {
            this.query = {
                material: '',
            }
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
