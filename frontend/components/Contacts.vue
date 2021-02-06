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
              <n-link to="/contacts">
                 Связаться с нами
              </n-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
          


  <h1 style="color: #4C2011;
    font-family: Georgia;
    font-size: 30px;
    font-style: italic;
    font-weight: normal;">Связаться с нами</h1>
    <br>
  <form  method="post" enctype="multipart/form-data">
    <h2 style="color: #000000;
    font-size: 16px;
    margin-top: 0px;
    margin-bottom: 15px;">Наше местонахождение</h2>
    <div class="contact-info" style="    overflow: auto;">
      <div class="content" style="color: #4C2011; padding: 10px;">
        <b>Адрес: </b>127018, Москва, 3-й проезд Марьиной рощи, дом 40, строение 1.
                <br><b>Телефон: </b>+7(985) 272-77-80<br>
                <b>Email:</b>
        enot70@yandex.ru
              <br><br><b>График работы:</b><br>Наши сотрудники будут рады ответить на любой интересующий Вас вопрос по телефону  <b>с 8-00 до 22-00</b><br>
              <h1 style="color: #4C2011;
    font-family: Georgia;
    font-size: 30px;
    font-style: italic;
    font-weight: normal;">В связи с отсутствием торговых плошадей визит в шоурум-склад возможен только по предварительной договоренности!</h1><br>
      <b>Проезд городским транспортом:</b><br>
      Станция метро <b>"Марьина Роща"</b>, первый вагон из центра, выход к театру "Сатирикон", 
перейти через улицу Шереметьевская, 
далее идти вдоль 3-го проезда Марьиной Рощи 300 метров, пересекая улицу Октябрьская. 
Справа высотное здание д.40, стр.1, проходная (для ориентира напротив, через дорогу Медицинский центр «СМ-Клиника»)<br><br>
<b>Схема проезда:</b><br>
<img src="http://193.169.179.233/image/map.jpg" alt="">



    </div>
    </div>
    <br>
    <h2 style="    color: #000000;
    font-size: 16px;
    margin-top: 0px;
    margin-bottom: 15px;
}">Написать нам</h2>
    <div class="content" style="color: #4C2011;">
    <b>Ваше имя:</b><br>
    <input type="text" name="name" value="">
    <br>
        <br>
    <b>Ваш E-Mail:</b><br>
    <input type="text" name="email" value="">
    <br>
        <br>
    <b>Ваш вопрос:</b><br>
    <textarea name="enquiry" cols="40" rows="10" style="width: 99%;"></textarea>
    <br>
        <br>
    <b>Введите код, указанный на картинке:</b><br>
    <input type="text" name="captcha" value="">
    <br>
    <img src="index.php?route=information/contact/captcha" alt="">
        </div>
    <div class="buttons" style="overflow: auto;
    padding: 6px;
    margin-bottom: 20px;">
      <div class="right" style="    float: right;
    text-align: right;">
    
    <input type="submit" value="Отправить" class="button" style="    background: url(https://decor-retro.ru/catalog/view/theme/consta/i/button_buy.png) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: #7A0F0D;
    cursor: pointer;
    font-family: georgia;
    font-size: 24px;
    font-weight: bold;
    height: 57px;
    line-height: 34px;
    padding: 0 0 7px;
    text-shadow: 1px 1px 1px #FFC082;
    width: 161px;"></div>
    </div>
  </form>



        
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
                
            };
        },
    }
</script>

<style scoped>

</style>