<template>
<section class="content" id="content">

  <n-link :to="{ name: 'checkout-cart' }" title="Корзина" v-if="cartData">
    <div class="mycart-container">
      <div class="mycart"></div>
      <div class="mycart-button"> {{cartData.price }} руб.(1)</div>
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
    <MenuMobile />   
    <div class="row d-none d-lg-flex">
       <Menu />
      <div class="col-12">
        <div class="bread">
          <ul>
            <li>
              <n-link to="/">
                Главная
              </n-link>
            </li>

            <li>
              <n-link to="/arhive">
                  Архив
              </n-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
          <h2 class="catalog-title">
           Архив
        </h2>
          <div class="catalog">
            <div class="product" v-for="product, index in products">
            <!-- <div class="product__head">
              <img :src="product.image_url" :alt="product.name">
            </div> -->
            <div class="product__content">
              <img :src="'http://193.169.179.233/image/'+product.image_url" alt="" class="zoom_01" :data-image="'http://193.169.179.233/image/'+product.image_url" :data-zoom-image="'http://193.169.179.233/image/'+product.image_url" >
            </div>
            <div class="product__price">
              <span>
                {{product.price}}Р
              </span>
              <span>
                Арт: {{product.article}}
              </span>
            </div>
            <div class="product__link">
              <n-link :to="product.url" v-html="product.name">
                
              </n-link>
            </div>
          </div>

          <div 
                  v-observe-visibility="pagination.currentPage !== pagination.lastPage ? visibilityChanged : false"
              ></div>
          </div>
        
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
                products: [],

                query: {
                  page: 1
                },

                pagination: {
                    lastPage: '',
                    currentPage: '',
                    total: '',
                    from: '',
                    to: ''
                },
            };
        },
        async fetch() {
             await this.getProducts()
        },

        methods: {
          async getProducts() {
                const {data} = await this.$axios.get(
                    `/new/products/all`, {params: this.query}
                ).catch(() => {
                    //this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
                });
                console.log(data.data.products)
                if(this.products.length > 0) {
                    this.products = this.products.concat(data.data.products)
                } else {
                    this.products = data.data.products
                }
                
                this.configPagination(data.data.pagination); 
            },

            visibilityChanged (e) {
                let vm = this
                vm.query.page = vm.query.page + 1
                if(vm.pagination.currentPage < vm.pagination.lastPage){
                    setTimeout(function(){
                        vm.getProducts()
                    },50);
                }
            },

            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
        }
    }
</script>

<style scoped>

</style>