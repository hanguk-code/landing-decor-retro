<template>
    <ul class="left-menu d-none d-lg-block">
        <li v-for="cat in categories">
            <n-link :to="cat.url" class="open-submenu menu__dropdown">
                {{ cat.name }}
                <img src="/img/plus.png" alt="" v-if="!showChild(cat.url)">
                <img src="/img/minus.png" alt="" v-if="showChild(cat.url)">
            </n-link>
            <ul class="sub-menu" v-if="showChild(cat.url)">
                <li v-for="catChild in cat.children">
                    <n-link :to="catChild.url">
                        {{ catChild.name }}
                    </n-link>
                    <ul class="sub-menu" v-if="showChild2(catChild.url)">
                        <li v-for="catChild2 in catChild.children">
                            <n-link :to="catChild2.url">
                                {{ catChild2.name }}
                            </n-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            queryUrl: '',
        };
    },

    async fetch() {
        await this.getCategories()
    },

    mounted: function () {
        this.queryUrl = window.location.pathname
    },

    methods: {
        async getCategories() {
            const request = await this.$axios.$get(`categories`)
            if (request) {
                this.categories = request.data
            }
        },

        showChild(url) {
            let urlSplit = url.split('/')
            return this.queryUrl.includes('/' + urlSplit[1]) || (this.queryUrl === '/' && urlSplit[1] === 'farfor-fayans-keramika')
        },

        showChild2(url) {
            let urlSplit = url.split('/')
            return this.queryUrl.includes('/' + urlSplit[2])
        },
    }

}
</script>

<style scoped>

</style>
