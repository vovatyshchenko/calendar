<template>
    <div class="footer_wrapper">
        <footer class="container">
            <ul class="row">
                <li class="col-lg-4 col-md-6 col-sm-12 pl-sm-3">
                    <ul>
                        <li>
                            <img src="/img/logo.png"  alt="logo">
                        </li>
                        <li class="pl-5">Все права защищены</li>
                        <li class="pl-5">© OOO «IT 2.0»</li>
                    </ul>
                </li>
                <li class="col-lg-4 col-md-6 col-sm-12 pl-sm-3">
                    <h4 class="text">Инструменты</h4>
                    <ul>
                        <li><a :href="'http://it20tools-disk.dtdgma.org.ua/token?access_token='+(user?user.token:'')">Диск</a></li>
                        <li> <router-link to="/">Календарь</router-link></li>
                        <li><a :href="'https://contacts-it.s-host.net/'+(user?user.token:'')">Контакты</a></li>
                        <li><a :href="'http://cu66460.tmweb.ru/token?access_token='+(user?user.token:'')">Почта</a></li>
                        <li><a :href="'https://it20-tools-photogallery.azurewebsites.net'+(user?user.token:'')">Фото</a></li>
                    </ul>
                </li>
                <li class="col-lg-4 offset-md-6 offset-sm-0 offset-lg-0 col-md-6 col-sm-12 pl-sm-3">
                    <h4 class="text">Контакты</h4>
                    <ul>
                        <li>+38095 900 38 00 </li>
                        <li>mail@aiti20.com</li>
                    </ul>

                    <ul class="social_block">
                        <li>
                            <a href="http://facebook.com/" target="_blank">
                                <img src="/img/facebook.png" alt="logo">
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <img src="/img/twitter.png" alt="logo">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <img src="/img/instagram.png" alt="logo">
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </footer>
    </div>
</template>

<script>
export default {

    data: () => ({
        user:null
    }),
    created() {
        axios.get('/user/getInfo')
            .then(response => {
                this.user=response.data;
            })
            .catch(function (error) {

            });
    }
}
</script>

<style>

</style>
