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
		<div class="row">
			<Menu />
			<div class="col-12">
				<div class="bread">
					<ul>
						<li v-for="bc, i in product.breadcrumbs">
							<n-link :to="bc.url"  v-html="bc.name"></n-link>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="product-select">
					<div class="slider">
						<div class="slider__zoom">
								<img id="img_01" :src="'http://193.169.179.233/image/'+product.image_url"/>
							
						</div>
						<div class="swiper-container gallery-thumbs">
							<img v-for="image, i in product.gallery" style="width: 98px; margin-left: 3px;" :src="'http://193.169.179.233/image/'+image.image_url" :alt="image.name">
						</div>
						<!-- <div class="swiper-container gallery-thumbs">
							<div class="swiper-wrapper" id="swiper-wrapper">
								<a href="#" data-image="img/slider-main.jpg" data-zoom-image="img/slider-main.jpg" class="swiper-slide">
								    <img id="img_01" src="/img/slider-main.jpg" />
								  </a>

								  <a href="#" data-image="img/slider-1.jpg" data-zoom-image="img/slider-1.jpg" class="swiper-slide">
								    <img id="img_01" src="/img/slider-1.jpg" />
								  </a>

								  <a href="#" data-image="img/slider-2.jpg" data-zoom-image="img/slider-2.jpg" class="swiper-slide">
								    <img id="img_01" src="/img/slider-2.jpg" />
								  </a>

								  <a href="#" data-image="img/slider-3.jpg" data-zoom-image="img/slider-3.jpg" class="swiper-slide">
								    <img id="img_01" src="/img/slider-3.jpg" />
								  </a>
								  <a href="#" data-image="img/slider-4.jpg" data-zoom-image="img/slider-4.jpg" class="swiper-slide">
								    <img id="img_01" src="/img/slider-4.jpg" />
								  </a>
								  <a href="#" data-image="img/slider-5.jpg" data-zoom-image="img/slider-5.jpg" class="swiper-slide">
								    <img id="img_01" src="/img/slider-5.jpg" />
								  </a>
							</div>
							
							 Add Arrows
							<div class="swiper-button-next swiper-button-white"></div>
							<div class="swiper-button-prev swiper-button-white"></div>
						</div> -->
					</div>
					<div class="product-select__content">
						<div class="article">
							<p>
								Артикул: {{product.article}}
							</p>
						</div>
						<h2 v-html="product.name">
							
						</h2>
						<span class="product-select__price">
							{{product.price}} руб.
						</span>
						<a href="#" class="product-select__link" @click="addToCart">
							Добавить в корзину
						</a>
						<table class="attribute">
							<tbody>
								<tr v-for="attribute, i in product.attributes">
									<td>{{attribute.name}}</td>
									<td>{{attribute.description}}</td>
								</tr>
							</tbody>
			          	</table>
			          	<div v-html="product.description" style="color: #000000;">
			          	</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-12">
				<div class="slider-inner">
					<div class="slider-inner-swiper swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-1.png" alt=""  >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-2.png" alt="" >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-3.png" alt="" >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-4.png" alt=""  >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-5.png" alt="" >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-6.png" alt="" >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-1.png" alt="" >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
							<div class="swiper-slide">
								<a href="#">
									<img src="/img/catalog-2.png" alt="" >
								</a>
								<a href="#">
									Фарфоровая Сухарница - Корзинка для выпечки - Вазочка - Конфетница APPONYI GREEN, HEREND, Венгрия.
								</a>
							</div>
						</div>
						

					</div>
					  Add Arrows 
						    <div class="swiper-button-next"></div>
						    <div class="swiper-button-prev"></div>
				</div>
			</div> -->
		</div>
	</div>
</section>
</template>

<script>
	import { mapGetters } from 'vuex'

    import MenuMobile from './Menu/MenuMobile'
    import Menu from './Menu/Menu'

    export default {
      components: {
        MenuMobile,
        Menu
      },
         props: ['product'],

        computed: {
            ...mapGetters({
                cartData: 'item/cartData'
            }),
        },
        mounted() {
        	// console.log('wefwef')
        	// console.log(this.cartData)
        },
         methods: {
         	addToCart() {
         		this.$store.dispatch('item/saveCartItem', {
                     cartData: this.product
                 })
         	}
         }
    }


</script>

<style scoped>

</style>