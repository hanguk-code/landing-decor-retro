<template>
    <div>
        <div class="row d-none d-lg-flex">
            <div class="col-12">
                <div class="bread">
                    <ul>
                        <li v-for="b, i in breadcrumbs" v-if="breadcrumbs">
                            <n-link :to="'/'+b.url">
                                {{ b.name }}
                            </n-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-md-9">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            wChildren: 'display: block;'

        };
    },
    methods: {}
}
</script>

<style scoped>

</style>
