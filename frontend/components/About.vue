<template>
    <div class="row">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <LeftMenu/>
            </div>
            <div class="col-sm-8 col-md-9">
                <h2 class="catalog-title">
                    {{ breadcrumbs.slice(-1)[0].title }}
                </h2>
                <div class="content-news">
                    <a data-fancybox="gallery"
                       :href="apiWebUrl + '/image/data/glavnay/pozdravleniya_s_dnem_kosmonavtiki.jpg'">
                        <img :src="apiWebUrl + '/image/data/glavnay/pozdravleniya_s_dnem_kosmonavtiki.jpg'"
                             title="Новость 1 -  «ПОЕХАЛИ»"
                             alt="Новость 1 -  «ПОЕХАЛИ»"
                             class="img-right"
                             style="width: 100px; height: auto;">
                    </a>
                    <p>
                        Так уж случилось, что день открытия нашего сайта, или по другому интернет-каталога пришёлся
                        на <strong>12 апреля</strong>, и на наш взгляд это очень символично. Мы все хорошо знаем,
                        что этот день в истории запечатлён, как <strong>День космонавтики</strong>. Конечно же, Боже
                        упаси, мы не сравниваем себя с первооткрывателями космоса, хотя на наш взгляд у нас много
                        общего.
                    </p>
                    <p>
                        <a data-fancybox="gallery"
                           :href="apiWebUrl + '/image/data/glavnay/3kpXOUG9TdY.jpg'">
                            <img alt=""
                                 :src="apiWebUrl + '/image/data/glavnay/3kpXOUG9TdY.jpg'"
                                 style="width: 200px; height: 113px;">
                        </a>
                        <a data-fancybox="gallery"
                           :href="apiWebUrl + '/image/data/glavnay/i.jpg'">
                            <img alt=""
                                 :src="apiWebUrl + '/image/data/glavnay/i.jpg'"
                                 style="width: 203px; height: 150px;">
                        </a>
                        <a data-fancybox="gallery"
                           :href="apiWebUrl + '/image/data/СССР/ZSP_2729.JPG'">
                            <img alt=""
                                 :src="apiWebUrl + '/image/data/СССР/ZSP_2729.JPG'"
                                 style="width: 150px; height: 150px;">
                        </a>
                        <a data-fancybox="gallery"
                           :href="apiWebUrl + '/image/data/glavnay/Juriy_Gagarin.jpg'">
                            <img
                                alt=""
                                :src="apiWebUrl + '/image/data/glavnay/Juriy_Gagarin.jpg'"
                                style="width: 200px; height: 149px;">
                        </a>
                        <a data-fancybox="gallery"
                           :href="apiWebUrl + '/image/data/glavnay/370589_original.jpg'">
                            <img alt=""
                                 :src="apiWebUrl + '/image/data/glavnay/370589_original.jpg'"
                                 style="width: 150px; height: 150px;">
                        </a>
                    </p>
                    <p>
                        Вы спросите, что тут может быть общего, где Космонавтика и где Коллекционирование, но
                        прошу Вас присмотритесь внимательно, начнём с того, что оба термина даже начинаются на
                        одну и туже букву "К". Вы скажете - это простое совпадение, да наверное. Ну, а если
                        серьёзно, Космонавтика это устремление человечества в будущее, это путешествие к новым
                        мирам полное новых открытий и знаний. Коллекционирование это тоже устремление
                        человечества, но не в будущее, а в прошлое. Это тоже путешествие, в не менее
                        удивительный и многогранный мир, мир вещей и предметов, который так же полон новых
                        открытий и давно забытых знаний, удивительных и невероятных историй, мир наших отцов,
                        дедов, прадедов...
                    </p>
                    <p>
                        Наш интернет-каталог мы решили назвать "Декор-Ретро". Мы – это объединение друзей-
                        единомышленников, коллекционеров уже ни в одном поколении, объединившихся в данном
                        проекте. Целью создания "Декор-Ретро" отнюдь не является получение коммерческой выгоды
                        от продажи предметов старины, как может показаться на первый взгляд. "Декор-Ретро"- это
                        не очередной интернет-магазин. Основные цели и задачи данного интернет- ресурса: - это
                        популяризация коллекционирования, развитие вкуса и понимания красоты великолепия ушедших
                        эпох, по средством предметов бытования наших предков. Это расширение связей и
                        взаимодействий между людьми увлечённых &nbsp;коллекционированием, дизайнерами
                        декорирующими помещения с помощью винтажных предметов старины и просто людьми которым
                        нравиться ретро стиль.&nbsp; В наши планы входит оказание предметной помощи, как в
                        развитии и приумножении существующих коллекций, так и только начинающим, делающим
                        первые, ещё робкие шаги новичкам.
                    </p>
                    <p>
                        Именно исходя из выше изложенных целей и планов "Декор-Ретро", на все антикварные,
                        винтажные, старинные предметы из коллекций в ретро стиле, которые будут представлены в
                        нашем интернет-каталоге, мы договорились и установили приемлемые, демократичные цены,
                        которые Вас приятно удивят и будут способствовать истинно дружескому взаимодействию на
                        данном поприще.
                    </p>
                    <p>
                        Дорогие друзья! "Декор-Ретро" искренне желает Вам приятного путешествия в великолепный
                        мир прошлого! И раз так, что все таким чудесным образом совпало с <strong>12
                        апреля</strong>, хочется по Гагарински лаконично сказать:
                        <strong>ПОЕХАЛИ!!!</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from "~/components/Layouts/Breadcrumbs";

export default {
    components: {
        Breadcrumbs
    },
    data() {
        return {
            apiWebUrl: process.env.apiWebUrl,
            breadcrumbs: [{
                url: '/products/new',
                title: 'О нас'
            }],
        };
    },
    mounted() {
        this.fancy()
    },
    methods: {
        fancy(){
            $('[data-fancybox="gallery"]').fancybox({
                backFocus: false,
                buttons: [
                    "zoom",
                    //"share",
                    // "slideShow",
                    //"fullScreen",
                    //"download",
                    // "thumbs",
                    "close"
                ],
                beforeClose: function () {
                    console.log(111)
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
