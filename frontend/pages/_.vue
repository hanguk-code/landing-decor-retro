<template>
    <section class="content" id="content">
        <div class="container">
            <Vector/>
            <MenuMobile/>
            <div class="row d-none d-lg-flex">
                <Menu/>
            </div>
            <div v-if="!$fetchState.pending">
                <template v-if="linkType === 'about'">
                    <About/>
                </template>
                <template v-if="linkType === 'products/all'">
                    <ProductAll/>
                </template>
                <template v-if="linkType === 'products/new'">
                    <ProductNew/>
                </template>
                <template v-if="linkType === 'archive'">
                    <Archive/>
                </template>
                <template v-if="linkType === 'delivery'">
                    <Delivery/>
                </template>
                <template v-if="linkType === 'contacts'">
                    <Contacts/>
                </template>
                <template v-if="type === 'category'">
                    <Category
                        :categories="categories"
                        :subCategories="subCategories"
                        :products="products"
                        :countries="countries"
                        :materials="materials"
                        :min_price="parseInt(price_limit.min_price)"
                        :max_price="parseInt(price_limit.max_price)"
                        :category="typeData"
                        :breadcrumbs="breadcrumbs"
                        :lastPage="pagination.lastPage"
                        :totalProducts="pagination.total"
                        :currentPage="pagination.currentPage"
                        @queryProducts="queryProducts($event)"
                        @visibilityChanged="visibilityChanged($event)"
                    />
                </template>

                <template v-if="type === 'product'">
                    <Product :product="product"
                             :relatedProducts="relatedProducts"/>
                </template>
            </div>
        </div>
        <notifications position="top center" group="basket" />
    </section>
</template>

<script>
import {isMobileOnly} from 'mobile-device-detect';
import MenuMobile from "~/components/Menu/MenuMobile";
import Menu from "~/components/Menu/Menu";
import LeftMenu from "~/components/Menu/LeftMenu";
import Vector from "~/components/Partials/Vector";
import {mapGetters} from "vuex";

export default {
    components: {
        MenuMobile,
        Menu,
        LeftMenu,
        Vector,
    },
    head: {
        bodyAttrs: {
            class: 'catalog-page'
        },
        meta: [],
    },
    computed: {
        ...mapGetters({
            categories: 'item/categories',
        }),
    },
    data() {
        return {
            isMobile: isMobileOnly,
            product: {},
            relatedProducts: [],

            // categories: [],
            subCategories: [],
            products: [],
            breadcrumbs: [],
            type: '',
            typeData: '',

            query: {
                page: 1,
                price_min: '',
                price_max: '',
                country: '',
                material: '',
            },
            countries: [],
            materials: [],
            price_limit: [],
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                from: '',
                to: ''
            },

            linkType: '',
        };
    },
    async fetch() {
        let linkType = this.$route.params.pathMatch

        if (linkType === 'archive') {
            this.linkType = 'archive'
        } else if (linkType === 'delivery') {
            this.linkType = 'delivery'
        } else if (linkType === 'contacts') {
            this.linkType = 'contacts'
        } else if (linkType === 'products/new') {
            this.linkType = 'products/new'
        } else if (linkType === 'products/all') {
            this.linkType = 'products/all'
        } else if (linkType === 'about') {
            this.linkType = 'about'
        } else {
            await this.checkType()
            if (this.type === 'category') {
                // await this.getCategories()
            }
            if (this.type === 'product') {
                await this.getRelatedProducts()
                //await this.getProduct()
            }
        }
    },

    methods: {
        async getRelatedProducts() {
            const request = await this.$axios.$get(`/related/products`, {params: {product_id: this.product.id}})
            this.relatedProducts = request.data
        },

        async checkType() {
            const {data} = await this.$axios.get(
                `/type/${this.$route.params.pathMatch}`, {params: this.query}
            ).catch(() => {
                // this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
            });

            if(data.data.length < 1){
                window.location.href = '/';
            }

            this.type = data.data.type
            this.product = data.data.product
            if (data.data.type === 'category') {
                this.typeData = data.data.category
                this.subCategories = data.data.sub_categories

                if (this.products.length > 0) {
                    this.products = this.products.concat(data.data.products)
                } else {
                    this.products = data.data.products
                }

                this.breadcrumbs = data.data.breadcrumbs
                if (data.data.pagination.current_page === 1) {
                    this.countries = data.data.countries
                    this.materials = data.data.materials
                    this.price_limit = data.data.price_limit
                }

                this.configPagination(data.data.pagination);
            }
            $('.ajaxblock').remove()
        },
        async getCategories() {
            const {data} = await this.$axios.get(
                `/categories`
            ).catch(() => {
                //this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
            });
            this.categories = data.data
        },

        queryProducts(e) {
            this.query.page = 1
            this.query.price_min = e.price_min
            this.query.price_max = e.price_max
            this.query.country = e.country
            this.query.material = e.material

            this.products = []
            this.checkType()
        },

        visibilityChanged(e) {
            let vm = this
            vm.query.page = vm.query.page + 1
            if (vm.pagination.currentPage < vm.pagination.lastPage) {
                setTimeout(function () {
                    vm.checkType()
                }, 50);
            }
        },

        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },

        // async getNewProducts() {
        //     const {data} = await this.$axios.get(
        //         `/products`
        //     ).catch(() => {
        //         //this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
        //     }); //
        //     this.products = data.data
        // }
    }
}
</script>

<style scoped>

</style>
