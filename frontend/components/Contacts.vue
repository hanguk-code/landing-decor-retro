<template>
    <div>
        <div class="row d-none d-lg-flex">
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
                <h1>Связаться с нами</h1>
                <h2>Наше местонахождение</h2>
                <div class="contact-info">
                    <div class="content">
                        <b>Адрес: </b>127018, Москва, 3-й проезд Марьиной рощи, дом 40, строение 1.
                        <br><b>Телефон: </b>+7(985) 272-77-80<br>
                        <b>Email:</b>
                        enot70@yandex.ru
                        <br><br><b>График работы:</b><br>Наши сотрудники будут рады ответить на любой
                        интересующий Вас вопрос по телефону <b>с 8-00 до 22-00</b><br>
                        <h1 style="color: #4C2011;
    font-family: Georgia;
    font-size: 30px;
    font-style: italic;
    font-weight: normal;">В связи с отсутствием торговых плошадей визит в шоурум-склад возможен только по
                            предварительной договоренности!</h1><br>
                        <b>Проезд городским транспортом:</b><br>
                        Станция метро <b>"Марьина Роща"</b>, первый вагон из центра, выход к театру "Сатирикон",
                        перейти через улицу Шереметьевская,
                        далее идти вдоль 3-го проезда Марьиной Рощи 300 метров, пересекая улицу Октябрьская.
                        Справа высотное здание д.40, стр.1, проходная (для ориентира напротив, через дорогу
                        Медицинский центр «СМ-Клиника»)<br><br>
                        <b>Схема проезда:</b><br>
                        <img :src="apiWebUrl+'/image/map.jpg'" alt="">
                    </div>
                </div>
                <!--                    <form action="" method="post" enctype="multipart/form-data">-->
                <h2>Написать нам</h2>
                <div class="content">
                    <b>Ваше имя:</b><br>
                    <input type="text" name="name" value="">
                    <br>
                    <br>
                    <b>Ваш E-Mail:</b><br>
                    <input type="text" name="email" value="">
                    <br>
                    <br>
                    <b>Ваш вопрос:</b><br>
                    <textarea name="enquiry" cols="40" rows="10"></textarea>
                    <br>
                    <br>
                    <b>Введите код, указанный на картинке:</b><br>
                    <input type="text" name="captcha" value="">
                    <br>
                    <img src="index.php?route=information/contact/captcha" alt="">
                </div>
                <div class="buttons">
                    <div class="right">
                        <input type="submit" value="Отправить" class="button_contact_submit">
                    </div>
                </div>
                <!--                    </form>-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
        };
    },
}
</script>

<style scoped>

</style>
