<template>
    <section class="content" id="content">
        <div class="container">
            <Vector/>
            <MenuMobile/>
            <div class="row d-none d-lg-flex">
                <Menu/>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <LeftMenu/>
                </div>
                <div class="col-md-9">
                    <div class="bread bread-buy">
                        <ul>
                            <li>
                                <n-link to="/">
                                    Главная
                                </n-link>
                            </li>
                            <li>
                                <n-link to="/checkout/cart">
                                    Корзина покупок
                                </n-link>
                            </li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        <table class="tableheader tableheader500 table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-center">Изображение</td>
                                <td class="text-left">Название товара</td>
                                <td class="text-left">Цена</td>
                                <td style="width: 50px;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in basket">
                                <td class="image">
                                    <n-link :to="item.url">
                                        <img :src="apiWebUrl + '/image/' + item.image_url" alt="" width="100">
                                    </n-link>
                                </td>
                                <td class="name">
                                    <n-link :to="item.url">
                                        {{ item.name }}
                                    </n-link>
                                    <br><span>Артикул: {{ item.article }}</span>
                                </td>
                                <td class="price">
                                    {{ item.price }} руб.
                                </td>
                                <td>
                                    <a href="#" @click="removeFromCart(index)"><img src="/img/remove.png" alt="Удалить"
                                                                                    title="Удалить"></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-show="tPrice">
                        <table class="tableheader table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>Итого:</strong></td>
                                <td class="text-right">{{ tPrice }} руб.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <form role="form" @submit.prevent="order" class="basket">
                        <div class="basket__input">
                            <label>
                                Имя
                                <span> *</span>
                            </label>
                            <input v-model="userForm.name" type="text" placeholder="Введите имя" required>
                        </div>
                        <div class="basket__input">
                            <label>
                                Телефон
                                <span> *</span>
                            </label>
                            <input v-model="userForm.phone" type="phone" placeholder="Введите телефон" required>
                        </div>
                        <div class="basket__input">
                            <label>
                                Email
                                <span> *</span>
                            </label>
                            <input v-model="userForm.email" type="email" name="email" placeholder="Введите почту"
                                   required>
                        </div>
                        <div class="basket__input">
                            <label>
                                Комментарии
                            </label>
                            <textarea v-model="userForm.comment" name="comment" cols="20" rows="5"
                                      placeholder="Комментарий" required></textarea>
                        </div>
                        <button type="submit" class="basket__btn">
                            Отправить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex'

import MenuMobile from '~/components/Menu/MenuMobile'
import Menu from '~/components/Menu/Menu'
import Vector from '~/components/Partials/Vector'
import LeftMenu from '~/components/Menu/LeftMenu'

export default {
    components: {
        MenuMobile,
        Menu,
        Vector,
        LeftMenu
    },
    head: {
        bodyAttrs: {
            class: 'main-page'
        },
        title: 'Главная Декор Ретро',
        meta: [],
    },
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
            categories: [],
            userForm: {},
            tPrice: 0
        };
    },
    computed: {
        ...mapGetters({
            cartData: 'item/cartData',
            basket: 'item/basket',
            totalPrice: 'item/totalPrice'
        }),
    },

    mounted() {
        if (window.localStorage.getItem('basket')) {
            this.tPrice = parseFloat(window.localStorage.totalPrice)
        }
    },

    methods: {
        order() {
            this.loading = true;

            this.$axios.$post(`/order`, {
                cartData: this.basket,
                userForm: this.userForm
            })
                .then(response => {
                    let data = response.data;
                    if (data.status === 'success') {
                        alert('Вы успешно оформили заказ!')

                        this.userForm = {}
                        this.$store.dispatch('item/saveCartItem', {
                            cartData: null,
                            basket: null,
                            totalPrice: 0,
                        })
                    }
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        removeFromCart(index) {
            if (index === this.basket.length) {
                this.$store.dispatch('item/saveCartItem', {
                    cartData: null,
                    basket: null,
                    totalPrice: 0,
                })
                return true
            }
            this.$store.dispatch('item/removeFromBasket', {
                index: index
            })
            if (window.localStorage.getItem('basket')) {
                this.tPrice = parseFloat(window.localStorage.totalPrice)
            }
        }
    }
}
</script>

<style scoped>

</style>
