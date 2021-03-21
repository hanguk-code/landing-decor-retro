<template>
    <div class="row d-none d-lg-flex">
        <div class="col-12">
            <div class="bread">
                <ul>
                    <li>
                        <n-link to="/">Главная</n-link>
                    </li>
                    <li v-for="item in breadcrumbs">
                        <n-link :to="item.url">{{ item.title }}</n-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: ['breadcrumbs'],
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
        };
    },
    methods: {}
}
</script>

<style scoped>

</style>
