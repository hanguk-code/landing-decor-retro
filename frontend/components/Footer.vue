<template>
    <footer class="footer" id="footer">
        <div class="container">
            <div class="row">
                <ul class="footer-mobile">
                    <li>
                        <n-link to="/about">
                            О нас
                        </n-link>
                    </li>
                    <li>
                        <n-link to="/products/new">
                            Новинки
                        </n-link>
                    </li>
<!--                    <li>-->
<!--                        <n-link to="/archive">-->
<!--                            Архив-->
<!--                        </n-link>-->
<!--                    </li>-->
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
                <div class="col-12">
                    <p>
                        Интернет-магазин ДЕКОР-РЕТРО © 2014<br>Все права защищены
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            year: new Date().getFullYear(),
        };
    },
}
</script>

<style scoped>

</style>
