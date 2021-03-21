<template>
    <div>
        <Header/>
        <!--<nuxt keep-alive />-->
        <nuxt/>
        <Footer/>
    </div>
</template>

<script>
export default {
    data() {
        return {
            userMenu: [],
            categories: [],
        };
    },
    async fetch() {
        await this.getCategories()
    },
    methods: {
        async getCategories() {
            const request = await this.$axios.$get(`categories`)
            if (request) {
                this.categories = request.data
                this.storeCategories()
            }
        },
        storeCategories(){
            this.$store.dispatch('item/saveCategories', {
                categories: this.categories
            })
        }
    }
}
</script>

<style>
.page-enter-active,
.page-leave-active {
    transition: all 0.25s ease;
}

.page-enter,
.page-leave-active {
    opacity: 0;
    transform: translateZ(0);
    backface-visibility: hidden;
}
</style>
