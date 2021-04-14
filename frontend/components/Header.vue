<template>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 align-items-center">
                    <n-link :to="{name: 'index'}">
                        <img src="/img/logo.png" alt="" class="header-logo">
                    </n-link>
                </div>
                <div class="col-lg-6">
                    <n-link :to="{name: 'index'}" class="logo-main">
                        <img src="/img/logo2.png" alt="">
                    </n-link>
                </div>
                <div class="col-lg-3 d-flex flex-column justify-content-center align-items-end p-0">
                    <div class="header-phone">
                        +7(985)<span>272-77-80</span>
                        <br>
                        +7(966) 381-59-39
                    </div>

                    <Basket/>

                    <div class="search">
                        <el-select
                            value=""
                            filterable
                            remote
                            reserve-keyword
                            placeholder="Поиск"
                            :remote-method="remoteMethod"
                            no-data-text="Товар не найден"
                            loading-text="..."
                            :loading="loading"
                            v-on:focus="clearProducts"
                        >
                            <el-option
                                v-for="product in searchProduct"
                                :key="product.id"
                                :label="product.name"
                                :value="product.name"
                            >
                                <n-link :to="product.url">
                                    <img :src="apiWebUrl + '/image/' + product.image_url" width="40px">
                                    <span v-html="product.name"></span>
                                    <span class="float-right">{{ product.price }}</span>
                                    <div v-html="product.description.substring(0, 100) + '...'"></div>
                                </n-link>
                            </el-option>
                        </el-select>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {isMobileOnly} from 'mobile-device-detect';
import Basket from "~/components/Partials/Basket";

export default {
    components: {
        Basket,
    },
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
            isMobile: isMobileOnly,
            searchProduct: [],
            loading: false,
        }
    },

    methods: {
        async remoteMethod(query) {
            this.loading = true
            const products = await this.$axios.$get('/search/products', {params: {search: query}})
            this.searchProduct = products.data
            this.loading = false
        },
        clearProducts(){
            this.searchProduct = []
        }
    }

}
</script>

<style scoped>

</style>
