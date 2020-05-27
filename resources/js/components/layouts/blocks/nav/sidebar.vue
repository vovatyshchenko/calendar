<template>
    <nav id="sidebar" :class="sidebarOpen ? 'sidebar-open' : ''">
        <div class="navbar-brand">
            <img src="/img/logo.png" alt="logo">
        </div>
        <div @click="sidebarOpen = !sidebarOpen" ><div class="toggle_sidebar" :class="sidebarOpen ? 'toggled' : ''"></div></div>
        <ul id="side_menu" class="list-unstyled components">
            <li>
                <a href="#">
                    <img src="/img/ic_home.png" alt="logo">
                    <span>Главная страница</span>
                </a>
            </li>
            <li>
                <div @click="redirect('http://it20tools-disk.dtdgma.org.ua/')">
                    <img src="/img/ic_cloud_download.png" alt="logo">
                    <span>Диск</span>
                </div>
            </li>
            <li>
                <a href="#">
                    <img src="/img/ic_email.png" alt="logo">
                    <span>Почта</span>
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <img src="/img/ic_today_hover.png" alt="logo">
                    <span>Календарь</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/ic_camera_alt.png" alt="logo">
                    <span>Фотографии</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/ic_people.png" alt="logo">
                    <span>Контакты</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="/img/ic_business_center.png" alt="logo">
                    <span>Управление</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script >
    export default {
        data: () => ({
            sidebarOpen : false,
        }),
        methods:{
            redirect()
            {

            }
        },
        created() {
            axios.get('/user/getInfo')
                .then(response => {
                    console.log(response.data)
                })
                .catch(function (error) {

                });
        }
    }
</script>

<style>

</style>
