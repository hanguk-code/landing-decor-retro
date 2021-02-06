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
		<div class="row d-flex d-lg-none">
			<div class="col-12">
				<div class="menu-mobile">
					<div class="menu-mobile__top">
						<p>
							Меню
						</p>
						<a href="#" class="gamburger-link">
							<img src="/img/hamburgermenu.svg" alt="Gamb" class="gumb">
							<img src="/img/Exit.png" alt="Exit" class="exit">
						</a>
					</div>
					<nav class="menu-collapse">
						<ul class="menu">
							<li>
								<n-link :to="{name: 'index'}">
									Главная
								</n-link>
							</li>
							<li>
								<n-link to="/catalog">
									Каталог
								</n-link >
							</li>
							<li>
								<a href="#" class="menu__dropdown">
									Категории
									<img src="/img/minus.png" alt="">
								</a>
								<ul>
									<li v-for="cat, index in categories">
										<n-link :to="cat.url" class="menu__dropdown">
											{{cat.name}}
											<img src="/img/minus.png" alt="">
										</n-link>
										<ul>
											<li v-for="catChild, indexChild in cat.children">
												<n-link :to="catChild.url" >
													 {{catChild.name}}
												</n-link>
											</li>
										</ul>
									</li>
								</ul>
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
		<div class="row d-none d-lg-flex">
			<div class="col-12">
				<ul class="menu">
					<li>
						<n-link :to="{name: 'index'}">
							Главная
						</n-link>
					</li>
					<li>
						<n-link to="/catalog">
							Каталог
						</n-link>
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
			</div>
			<div class="col-12">
				<div class="bread">
					<ul>
						<li v-for="b, i in breadcrumbs" v-if="breadcrumbs">
							<n-link :to="b.url">
								{{b.name}}
							</n-link>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-md-9">
				<form action="" class="range" v-if="products.length > 0">
					<h3>
						Выбор по параметрам
					</h3>
					<div class="range__select">
						<div class="range__top">
							<div class="range__title">
								Материал:	
							</div>
							<select name="" id="">
								<option value="">Выбрать</option>
								<option value="">Майолика</option>
								<option value="">Металл / Эмаль</option>
								<option value="">Фарвор</option>
								<option value="">Фарфар</option>
								<option value="">Фарфор</option>
								<option value="">фарфор / металл</option>
								<option value="">Фаянс</option>
							</select>
						</div>
						<div class="range__top">
							<div class="range__title">
								Страна:	
							</div>
							<select name="" id="">
								<option value="">Выбрать</option>
								<option value="">Англия</option>
								<option value="">Бельгия</option>
								<option value="">Венгрия</option>
								<option value="">Германия</option>
								<option value="">Голландия</option>
								<option value="">Дания</option>
								<option value="">Италия</option>
								<option value="">Китай</option>
								<option value="">Португалия</option>
								<option value="">СССР</option>
								<option value="">Франция</option>
								<option value="">Чехословакия</option>
								<option value="">Япония</option>
							</select>
						</div>
						
					</div>
					<div class="range__slider">
						<div class="range__top">
								<div class="range__title">
									Изготовитель:	
								</div>
								<select name="" id="">
									<option value="">Выбрать</option>
									<option value="">Майолика</option>
									<option value="">Металл / Эмаль</option>
									<option value="">Фарвор</option>
									<option value="">Фарфар</option>
									<option value="">Фарфор</option>
									<option value="">фарфор / металл</option>
									<option value="">Фаянс</option>
								</select>
							</div>
						<div class="range__price d-none d-lg-flex">
							<div class="polzunok-container-6">
								<div class="range__title">
									Цена:	
								</div>
								<p>
									от
								</p>
							    <input type="text" v-model="query.price_min" class="polzunok-input-6-left" />
							    <p>
							    	до
							    </p>
							    <input type="text" v-model="query.price_max" class="polzunok-input-6-right "/>
							    
							</div>
							<div class="polzunok-6"></div>
						</div>
						<div class="range__top d-flex d-lg-none">
							<div class="polzunok-container-6">
								<div>
									<div class="range__title">
										Цена:	
									</div>
									<div class="polzunok-6"></div>
								</div>
								<div class="d-flex justify-content-between align-items-center w-100">
									<p>
										от
									</p>
								    <input type="text" v-model="query.price_min" class="polzunok-input-6-left" />
								    <p>
								    	до
								    </p>
								    <input type="text" v-model="query.price_max" class="polzunok-input-6-right "/>
								</div>
								
							    
							</div>
							
						</div>
					</div>
					<div class="range__btn">
						<a href="#" @click="queryProducts()">
							Отфильтровать
						</a>
						<a href="#" @click="clearQuery()">
							Сбросить параметры
						</a>
					</div>
				</form>
				<h2 class="catalog-title">
					{{category.name}}
				</h2>
				<div class="catalog">
					
					<div class="product" v-for="subCategory, index in subCategories">
						<!-- <div class="product__head">
							<img :src="subCategory.image_url" :alt="subCategory.name">
						</div> -->
						<div class="product__content">
							<img :src="'http://193.169.179.233/image/'+subCategory.image_url" alt="" class="zoom_01" :data-image="'http://193.169.179.233/image/'+subCategory.image_url" :data-zoom-image="'http://193.169.179.233/image/'+subCategory.image_url" >
						</div>
						<div class="product__link">
							<n-link :to="subCategory.url">
								{{subCategory.name}}
							</n-link>
						</div>
					</div>

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
             			v-observe-visibility="currentPage !== lastPage ? visibilityChanged : false"
        			></div>

				</div>
			</div>
		</div>
	</div>
</section>
</template>

<script>
	import { mapGetters } from 'vuex'

    export default {

        computed: {
            ...mapGetters({
                cartData: 'item/cartData'
            }),
        },

          data() {
            return {
            	products: [],
                breadcrumbs: [],

            	query: {
            		page: 1,
            		price_min: '',
                	price_max: '',
            	},
            	showChildren: 'display: block;'
            	 
            };
        },
        methods: {
            	clearQuery() {
            		this.query = {
            			price_min: '',
                		price_max: '',
            		}
            		
            		$emit('queryProducts', this.query)
            	},

            async getProducts() {
                const {data} = await this.$axios.get(
                    `/p/products/`, {params: this.query}
                ).catch(() => {
                    //this.$nuxt.error({statusCode: 404, message: 'Oops! Something went wrong!'})
                });
                if(this.products.length > 0) {
                    this.products = this.products.concat(data.data.products)
                } else {
                    this.products = data.data.products
                }
                
                this.breadcrumbs = data.data.breadcrumbs
                
                this.configPagination(data.data.pagination); 
                
                
            },
            queryProducts(e) {
                this.query.page = 1
                this.query.price_min = e.price_min
                this.query.price_max = e.price_max

                this.getProducts()
            },

            visibilityChanged (e) {
                let vm = this
                vm.query.page = vm.query.page + 1
                if(vm.pagination.currentPage < vm.pagination.lastPage){
                    setTimeout(function(){
                        vm.checkType()
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