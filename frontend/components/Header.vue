<template>
    <header class="header">
        <div class="container">
            <div class="row d-flex d-lg-none">
                <div class="col-5 d-flex align-items-center">
                    <n-link :to="{name: 'index'}">
                        <img src="/img/logo.png" alt="" class="header-logo">
                    </n-link>
                </div>
                <div class="col-7 d-flex justify-content-center">
                    <n-link :to="{name: 'index'}" class="logo-main">
                        <img src="/img/logo2.png" alt="">
                    </n-link>
                </div>
                <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                    <a href="tel:89067894567" class="header-phone">
                        8 (906) <span>789 45 67</span>
                    </a>
                    <a href="#modal-1" class="btn-header">
                        Заказать звонок
                    </a>
                    <div id="search" class="search">
                        <input type="text" name="search" placeholder="Поиск" value=""/>
                        <a class="button-search">&nbsp;&nbsp;&nbsp;</a>
                    </div>
                </div>
            </div>
            <div class="row d-none d-lg-flex">
                <div class="col-lg-3 d-flex align-items-center">
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
                    <a href="tel:89067894567" class="header-phone">
                        8 (906) <span>789 45 67</span>
                    </a>
                    <a href="#modal-1" class="btn-header">
                        Заказать звонок
                    </a>
                    <div class="search">
                        <el-select
                            filterable
                            remote
                            reserve-keyword
                            placeholder="Поиск"
                            :remote-method="remoteMethod"
                        >
                            <el-option
                                v-for="product in searchProduct"
                                :key="product.id"
                                :label="product.name"
                            >
                                <!--                                :value="product"-->
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
export default {
    data() {
        return {
            queryProducts: '',
            searchProduct: [],
            apiWebUrl: process.env.apiWebUrl
        }
    },

    methods: {

        async remoteMethod(query) {
            const products = await this.$axios.$get('/search/products', {params: {search: query}})
            this.searchProduct = products.data
        }
    }

}
</script>

<style scoped>
</style>
