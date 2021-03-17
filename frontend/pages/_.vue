<template>
    <section class="content" id="content">
        <div class="container">
            <Vector/>
            <MenuMobile/>
            <Basket/>
            <Menu/>
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
                    <Category :categories="categories"
                              :subCategories="subCategories"
                              :products="products"
                              :category="typeData"
                              :breadcrumbs="breadcrumbs"
                              :lastPage="pagination.lastPage"
                              :currentPage="pagination.currentPage"
                              @queryProducts="queryProducts($event)"
                              @visibilityChanged="visibilityChanged($event)"
                    />
                </template>

                <template v-if="type === 'product'">
                    <Product :product="product"/>
                </template>
            </div>
        </div>
    </section>
</template>

<script>
import MenuMobile from "~/components/Menu/MenuMobile";
import Menu from "~/components/Menu/Menu";
import LeftMenu from "~/components/Menu/LeftMenu";
import Vector from "~/components/Partials/Vector";
import Basket from "~/components/Partials/Basket";

export default {
    components: {
        MenuMobile,
        Menu,
        LeftMenu,
        Vector,
        Basket,
    },
    head: {
        bodyAttrs: {
            class: 'catalog-page'
        },
        meta: [],
    },
    data() {
        return {
            product: {},

            categories: [],
            products: [],
            breadcrumbs: [],
            type: '',
            typeData: '',

            query: {
                page: 1,
                price_min: '',
                price_max: '',
            },

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
                await this.getCategories()
            }
            if (this.type === 'product') {
                //await this.getProduct()
            }
        }
    },

    methods: {
        async checkType() {
            const {data} = await this.$axios.get(
                `/type/${this.$route.params.pathMatch}`, {params: this.query}
            ).catch(() => {
                //this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
            });
            this.type = data.data.type
            this.product = data.data.product
            console.log(this.product)
            if (data.data.type === 'category') {
                this.typeData = data.data.category
                this.subCategories = data.data.sub_categories
                if (this.products.length > 0) {
                    this.products = this.products.concat(data.data.products)
                } else {
                    this.products = data.data.products
                }

                this.breadcrumbs = data.data.breadcrumbs

                this.configPagination(data.data.pagination);
            }

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
