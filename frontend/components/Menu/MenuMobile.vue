<template>
    <div class="row d-flex d-lg-none">
        <div class="col-12">
            <div class="menu-mobile">
                <div class="menu-mobile__top">
                    <p>Меню</p>
                    <a href="#" class="gamburger-link" v-on:click="toggelMenu">
                        <img src="/img/hamburgermenu.svg" alt="Gamb" class="gumb">
                        <img src="/img/Exit.png" alt="Exit" class="exit">
                    </a>
                </div>
                <nav class="menu-collapse" v-show="show">
                    <ul class="">
                        <li>
                            <n-link :to="{name: 'index'}">
                                Главная
                            </n-link>
                        </li>
                        <LeftMenuMobile/>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import LeftMenuMobile from "~/components/Menu/LeftMenuMobile";

export default {
    components: {
        LeftMenuMobile,
    },
    data() {
        return {
            show: false,
        };
    },
    methods: {
        toggelMenu(event) {
            event.preventDefault()
            this.show = !this.show
        }
    }
}
</script>

<style scoped>

</style>
