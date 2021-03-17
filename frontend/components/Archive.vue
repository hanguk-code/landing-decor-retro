<template>
    <div>
        <div class="row d-none d-lg-flex">
            <div class="col-12">
                <div class="bread">
                    <ul>
                        <li>
                            <n-link to="/">
                                Главная
                            </n-link>
                        </li>

                        <li>
                            <n-link to="/products/all">
                                Весь ассортимент товара
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
                    Архив
                </h2>
                <div class="catalog">
                    <div class="product" v-for="product in products">
                        <div class="product__content">
                            <n-link :to="product.url">
                                <i class="prod"></i>
                                <img :src="apiWebUrl+'/image/'+product.image_url" alt="" class="zoom_03"
                                     :data-image="apiWebUrl+'/image/'+product.image_url"
                                     :data-zoom-image="apiWebUrl+'/image/'+product.image_url">
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
                            <n-link :to="product.url" v-html="product.name"></n-link>
                        </div>
                    </div>

                    <div
                        v-observe-visibility="pagination.currentPage !== pagination.lastPage ? visibilityChanged : false"
                    ></div>
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
            products: [],

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
    async fetch() {
        await this.getProducts()
        await this.zoom3()
    },

    methods: {
        async getProducts() {
            const request = await this.$axios.$get(`/archive`)
            this.products = request.data.products
            this.configPagination(request.data.pagination);
        },

        zoom3() {
            $('.zoomContainer').remove()
            $(".zoom_03").elevateZoom({
                zoomWindowWidth: 300,
                zoomWindowHeight: 300,
                zoomWindowPosition: 1,
                zoomWindowOffetx: -515,
                lensSize: 500,
            });
        },

        visibilityChanged(e) {
            let vm = this
            vm.query.page = vm.query.page + 1
            if (vm.pagination.currentPage < vm.pagination.lastPage) {
                setTimeout(function () {
                    vm.getProducts()
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
    }
}
</script>

<style scoped>

</style>
