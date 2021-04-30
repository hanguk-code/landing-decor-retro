<template>
    <div class="col-12">
        <ul class="menu">
            <li>
                <n-link :to="{name: 'index'}">
                    Главная
                </n-link>
            </li>
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
<!--            <li>-->
<!--                <n-link to="/archive">-->
<!--                    Архив-->
<!--                </n-link>-->
<!--            </li>-->
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
</template>

<script>
export default {
    data() {
        return {};
    },
}
</script>

<style scoped>

</style>
