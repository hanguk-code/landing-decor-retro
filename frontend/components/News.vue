<template>
    <section class="content" id="content">

        <n-link :to="{ name: 'checkout-cart' }" title="Корзина" v-if="cartData">
            <div class="mycart-container">
                <div class="mycart"></div>
                <div class="mycart-button"> {{ cartData.price }} руб.(1)</div>
            </div>
        </n-link>

        <div id="modal-1" class="modal-1" style="display: none;">
            <h3>
                Написать нам
            </h3>
            <form action="#">
                <label>Ваше имя:</label>
                <input type="text" name="name">
                <label>Ваш E-Mail:</label>
                <input type="email" name="email">
                <label>Ваш вопрос:</label>
                <textarea name="question" rows="10">

		</textarea>
                <button type="submit">
                    Отправить
                </button>
            </form>
        </div>

        <div class="container">

            <div class="img-vector">
                <img src="/img/vector-left.png" alt="">
                <img src="/img/vector-right.png" alt="">
                <img src="/img/vector-left-bot.png" alt="">
                <img src="/img/vector-bot-right.png" alt="">
            </div>
            <MenuMobile/>
            <div class="row d-none d-lg-flex">
                <Menu/>
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
    </section>
</template>

<script>

import MenuMobile from './Menu/MenuMobile'
import Menu from './Menu/Menu'

export default {
    components: {
        MenuMobile,
        Menu
    },
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
