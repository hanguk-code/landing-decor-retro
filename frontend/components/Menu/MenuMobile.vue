<template>
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
                <n-link to="/about">
                  О нас
                </n-link >
              </li>
              <li>
                <a href="#" class="menu__dropdown">
                  Категории
                  <img src="/img/minus.png" alt="">
                </a>
                <ul>
<!--                  <li v-for="cat, index in categories">-->
<!--                    <n-link :to="cat.url" class="menu__dropdown">-->
<!--                      {{cat.name}}-->
<!--                      <img src="/img/minus.png" alt="">-->
<!--                    </n-link>-->
<!--                    <ul>-->
<!--                      <li v-for="catChild, indexChild in cat.children">-->
<!--                        <n-link :to="catChild.url" >-->
<!--                           {{catChild.name}}-->
<!--                        </n-link>-->
<!--                      </li>-->
<!--                    </ul>-->
<!--                  </li>-->
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
</template>

<script>
    export default {
        data() {
            return {

            };
        },
    }
</script>

<style scoped>

</style>
