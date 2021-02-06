<template>
<section class="content" id="content">

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
        <MenuMobile />   
        <div class="row d-flex d-lg-none">
            <Menu />   
        </div>      
        <div class="row">
            <div class="col-md-3">
                <ul class="left-menu d-none d-lg-block">
                    <li v-for="cat, index in categories">
                        <n-link :to="cat.url" class="open-submenu menu__dropdown">
                                {{cat.name}}
                            <img src="/img/minus.png" alt="">
                        </n-link>
                        <ul class="sub-menu">
                            <li v-for="catChild, indexChild in cat.children">
                                <n-link :to="catChild.url">
                                      {{catChild.name}}
                                </n-link>
                            </li>
                        </ul>
                    </li>
                </ul>
                
            </div>
            <div class="col-md-9">
                <div class="bread-buy">
                    <ul>
                        <li>
                            <a href="#">
                                Главная 
                                <span>
                                    »
                                </span> 
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Корзина покупок
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- <div class="cart-info">
                    <table class="tableheader">
                        <thead>
                            <tr>
                                <td class="image">
                                    Фото
                                </td>
                                <td class="name">
                                    Наименование товара
                                </td>
                                <td class="quantity">
                                    <span>
                                        Кол-во  
                                    </span>
                                </td>
                                <td>
                                    
                                </td>
                                <td class="price">
                                    Цена
                                </td>
                            </tr>
                        </thead>
                    </table> -->
                    <table class="tableheader">
                        <tbody>
                            <tr v-if="cartData">
                                <td class="image">
                                    <a href="#">
                                        <img :src="cartData.image_url" alt="">
                                    </a>
                                </td>
                                <td class="name">
                                    <n-link :to="cartData.url">
                                        {{cartData.name}}
                                    </n-link>
                                </td>
                                <td class="price">
                                    {{cartData.price }} руб.
                                    
                                </td>
                                <td style="vertical-align: middle !important;">
                                    <a href="#" @click="removeFromCart"><img src="/img/remove.png" alt="Удалить" title="Удалить"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="tablefooter">
                        <thead>
                          <tr  v-if="cartData">
                            <td style="padding-left: 5px;"><b>Итого:</b></td>
                            <td style="width: 104px; text-align: center;">{{cartData.price }} руб.</td>
                          </tr>
                        </thead>
                      </table>
                      <form role="form" @submit.prevent="order" class="basket">
                            <div class="basket__input">
                                <label for="">
                                    Имя
                                    <span>
                                        *
                                    </span>
                                </label>
                                <input v-model="userForm.name" type="text" placeholder="Введите имя" required>
                            </div>
                            <div class="basket__input">
                                <label for="">
                                    Телефон
                                    <span>
                                        *
                                    </span>
                                </label>
                                <input v-model="userForm.phone" type="phone" placeholder="Введите телефон" required>
                            </div>
                            <div class="basket__input">
                                <label for="">
                                    Email
                                    <span>
                                        *
                                    </span>
                                </label>
                                <input  v-model="userForm.email" type="email" name="email" placeholder="Введите почту" required>
                            </div>
                            <div class="basket__input">
                                <label for="">
                                    Комментарии
                                </label>
                                <textarea  v-model="userForm.comment" name="comment" cols="20" rows="5" placeholder="Комментарий" required></textarea>
                            </div>
                            <button type="submit" class="basket__btn">
                                Отправить
                            </button>
                        </form>
                </div>                              
            </div>
        </div>
    </div>
</section>
</template>

<script>
    import { mapGetters } from 'vuex'

    import MenuMobile from '~/components/Menu/MenuMobile'
    import Menu from '~/components/Menu/Menu'

    export default {
      components: {
        MenuMobile,
        Menu
      },
        head: {
    		bodyAttrs: {
      			class: 'main-page'
    		},
    		title: 'Главная Декор Ретро',
    		meta: [
    		 		
                    // {
                    //     //hid: 'description',
                    //     name: 'description',
                    //     content: this.productData.product.seo.seo_description,
                    // },
                    // {
                    //     //hid: 'keywords',
                    //     name: 'keywords',
                    //     content: this.productData.product.seo.seo_keywords,
                    // },

            ],
  		},
  		  data() {
            return {
                categories: [],
                
                userForm: {},

                loading: false
            };
        },
        computed: {
            ...mapGetters({
                cartData: 'item/cartData'
            }),
        },
  		async fetch() {
             await this.getCategories()
             //await this.getNewProducts()
        },

        methods: {
        	async getCategories() {
                const {data} = await this.$axios.get(
                    `/categories`
                ).catch(() => {
                    //this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
                });
                this.categories = data.data
            },

             order(){
                this.loading = true;
                this.$axios.$post(`/order`, {
                    cartData: this.cartData,
                    userForm: this.userForm
                })
                    .then(response => {
                        let data = response.data;
                        if(data.status === 'success'){
                            alert('Вы успешно оформили заказ!')

                            this.userForm = {}
                            this.$store.dispatch('item/saveCartItem', {
                                cartData: null
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

            removeFromCart() {
                this.$store.dispatch('item/saveCartItem', {
                     cartData: null
                 })
            }
        }
    }
</script>

<style scoped>

</style>
