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
                <img src="/frontend/static/img/vector-left.png" alt="">
                <img src="/frontend/static/img/vector-right.png" alt="">
                <img src="/frontend/static/img/vector-left-bot.png" alt="">
                <img src="/frontend/static/img/vector-bot-right.png" alt="">
            </div>
            <MenuMobile/>
            <div class="row d-none d-lg-flex">
                <Menu/>
                <div class="col-12">
                    <div class="bread">
                        <ul>
                            <li>
                                <n-link to="/">
                                    Главная
                                </n-link>
                            </li>

                            <li>
                                <n-link to="/products/new">
                                    О нас
                                </n-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <LeftMenu/>
                </div>
                <div class="col-sm-8 col-md-9">
                    <h2 class="catalog-title">
                        О нас
                    </h2>
                    <div class="content-news">
                        <div class="news" style="min-height:100px;">
                            <div class="image">
                                <a href="https://decor-retro.ru/image/cache/data/glavnay/pozdravleniya_s_dnem_kosmonavtiki-800x800.jpg" title="Новость 1 -  «ПОЕХАЛИ»" class="colorbox cboxElement" rel="colorbox"><img src="https://decor-retro.ru/image/cache/data/glavnay/pozdravleniya_s_dnem_kosmonavtiki-100x100.jpg" title="Новость 1 -  «ПОЕХАЛИ»" alt="Новость 1 -  «ПОЕХАЛИ»" id="image"></a>
                            </div>
                            <p>
                                <span style="font-size:16px;"><span style="font-family: arial,helvetica,sans-serif;">&nbsp;&nbsp; Так уж случилось, что день открытия нашего сайта, или по другому интернет-каталога пришёлся на <strong>12 апреля</strong>, и на наш взгляд это очень символично. Мы все хорошо знаем, что этот день в истории запечатлён, как <strong>День космонавтики</strong>. Конечно же, Боже упаси, мы не сравниваем себя с первооткрывателями космоса, хотя на наш взгляд у нас много общего. </span></span></p>
                            <p>
                                <a class="gallerys cboxElement" href="http://decor-retro.ru/image/data/glavnay/3c0edec529c1.jpg" rel="gallerys"><img alt="" src="http://decor-retro.ru/image/data/glavnay/3c0edec529c1.jpg" style="width: 200px; height: 150px;"></a><a class="gallerys cboxElement" href="http://decor-retro.ru/image/data/glavnay/3kpXOUG9TdY.jpg" rel="gallerys"><img alt="" src="http://decor-retro.ru/image/data/glavnay/3kpXOUG9TdY.jpg" style="width: 200px; height: 113px;"></a><a class="gallerys cboxElement" href="http://decor-retro.ru/image/data/glavnay/i.jpg" rel="gallerys"><img alt="" src="http://decor-retro.ru/image/data/glavnay/i.jpg" style="width: 203px; height: 150px;"></a><a class="gallerys cboxElement" href="http://decor-retro.ru/image/data/СССР/ZSP_2729.JPG" rel="gallerys"><img alt="" src="http://decor-retro.ru/image/data/СССР/ZSP_2729.JPG" style="width: 150px; height: 150px;"></a><a class="gallerys cboxElement" href="http://decor-retro.ru/image/data/glavnay/Juriy_Gagarin.jpg" rel="gallerys"><img alt="" src="http://decor-retro.ru/image/data/glavnay/Juriy_Gagarin.jpg" style="width: 200px; height: 149px;"></a><a class="gallerys cboxElement" href="http://decor-retro.ru/image/data/glavnay/370589_original.jpg" rel="gallerys"><img alt="" src="http://decor-retro.ru/image/data/glavnay/370589_original.jpg" style="width: 150px; height: 150px;"></a></p>
                            <p>
                                <span style="font-size:16px;"><span style="font-family: arial,helvetica,sans-serif;">&nbsp;&nbsp; Вы спросите, что тут может быть общего, где Космонавтика и где Коллекционирование, но прошу Вас присмотритесь внимательно, начнём с того, что оба термина даже начинаются на одну и туже букву "К". Вы скажете - это простое совпадение, да наверное. Ну, а если серьёзно, Космонавтика это устремление человечества в будущее, это путешествие к новым мирам полное новых открытий и знаний. Коллекционирование это тоже устремление человечества, но не в будущее, а в прошлое. Это тоже путешествие, в не менее удивительный и многогранный мир, мир вещей и предметов, который так же полон новых открытий и давно забытых знаний, удивительных и невероятных историй, мир наших отцов, дедов, прадедов...</span></span></p>
                            <p>
                                <span style="font-size:16px;"><span style="font-family: arial,helvetica,sans-serif;">&nbsp;&nbsp; Наш интернет-каталог мы решили назвать "Декор-Ретро". Мы – это объединение друзей- единомышленников, коллекционеров уже ни в одном поколении, объединившихся в данном проекте. Целью создания "Декор-Ретро" отнюдь не является получение коммерческой выгоды от продажи предметов старины, как может показаться на первый взгляд. "Декор-Ретро"- это не очередной интернет-магазин. Основные цели и задачи данного интернет- ресурса: - это популяризация коллекционирования, развитие вкуса и понимания красоты великолепия ушедших эпох, по средством предметов бытования наших предков. Это расширение связей и взаимодействий между людьми увлечённых &nbsp;коллекционированием, дизайнерами декорирующими помещения с помощью винтажных предметов старины и просто людьми которым нравиться ретро стиль.&nbsp; В наши планы входит оказание предметной помощи, как в развитии и приумножении существующих коллекций, так и только начинающим, делающим первые, ещё робкие шаги новичкам.</span></span></p>
                            <p>
                                <span style="font-size:16px;"><span style="font-family: arial,helvetica,sans-serif;">&nbsp;&nbsp; Именно исходя из выше изложенных целей и планов "Декор-Ретро", на все антикварные, винтажные, старинные предметы из коллекций в ретро стиле, которые будут представлены в нашем интернет-каталоге, мы договорились и установили приемлемые, демократичные цены, которые Вас приятно удивят и будут способствовать истинно дружескому взаимодействию на данном поприще.</span></span></p>
                            <p>
                                <span style="font-size:16px;"><span style="font-family: arial,helvetica,sans-serif;">&nbsp;&nbsp;&nbsp; Дорогие друзья! "Декор-Ретро" искренне желает Вам приятного путешествия в великолепный мир прошлого! И раз так, что все таким чудесным образом совпало с <strong>12 апреля</strong>, хочется по Гагарински лаконично сказать: <strong>ПОЕХАЛИ!!!</strong></span></span></p>
                        </div>
                        <div class="addthis">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import MenuMobile from './Menu/MenuMobile'
import Menu from './Menu/Menu'
import LeftMenu from './Menu/LeftMenu'

export default {
    components: {
        MenuMobile,
        Menu,
        LeftMenu
    },
    data() {
        return {
            wChildren: 'display: block;',

        };
    },
    methods: {}
}
</script>

<style scoped>

</style>
