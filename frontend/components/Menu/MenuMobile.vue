<template>
    <div class="row d-flex d-lg-none">
        <div class="col-12">
            <div class="menu-mobile">
                <div class="menu-mobile__top">
                    <p>Меню</p>
                    <a href="#" class="gamburger-link" v-on:click="show = !show">
                        <img src="/img/hamburgermenu.svg" alt="Gamb" class="gumb">
                        <img src="/img/Exit.png" alt="Exit" class="exit">
                    </a>
                </div>
                <nav class="menu-collapse" v-show="show">
                    <ul class="menu">
                        <li>
                            <n-link :to="{name: 'index'}">
                                Главная
                            </n-link>
                        </li>
                        <li>
                            <n-link to="/about">
                                О нас
                            </n-link>
                        </li>
                        <li>
                            <a href="#" class="menu__dropdown">
                                Категории
                                <img src="/img/minus.png" alt="">
                            </a>
                            <LeftMenu/>
                        </li>
                        <li>
                            <n-link to="/products/new">
                                Новинки
                            </n-link>
                        </li>
                        <li>
                            <n-link to="/archive">
                                Архив
                            </n-link>
                        </li>
                        <li>
                            <n-link to="/delivery">
                                Доставка
                            </n-link>
                        </li>
                        <li>
                            <n-link to="/contacts">
                                Контакты
                            </n-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import LeftMenu from "~/components/Menu/LeftMenu";

export default {
    components: {
        LeftMenu,
    },
    data() {
        return {
            show: false,
        };
    },
}
</script>

<style scoped>

</style>
