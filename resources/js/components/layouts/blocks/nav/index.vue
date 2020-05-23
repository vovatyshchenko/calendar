<template>
    <div>
        <div class="wrapper">
            <sidebar-block></sidebar-block>
            <div class="main_content">
                <nav class="navbar navbar-light">
                    <div class="user_block">
                        <div class="user_menu-wrapper"
                            :class="userMenuOpen ? 'user_menu-opened' : ''">
                            <ul class="user_menu">
                                <li>
                                    <b-btn @click="logout()">Выход</b-btn>
                                </li>
                            </ul>
                        </div>
                        <a href="#">
                            {{ name }}
                            <img :src="'/img/' + avatar">
                        </a>
                        <div @click.stop="userMenuOpen = !userMenuOpen" class="toggle_user-menu"></div>
                    </div>
                </nav>
                 <v-app id="inspire">
                    <menu-calendar></menu-calendar>
                    <div class="content-block">
                        <sidebar-calendar v-if="drawer"></sidebar-calendar>
                        <div align="center" class="calendar-block">
                            <create-modal></create-modal>
                            <v-content>
                                <router-view></router-view>
                            </v-content>
                        </div>
                    </div>
                </v-app>
            </div>
        </div>
        <footer-block></footer-block>
    </div>
</template>

<script >
    export default {
        data: function () {
            return {
                name : 'Анна Кононенко',
                avatar : 'user.png',
                userMenuOpen : false,
            }
        },
         computed: {
            drawer() {
                return this.$store.getters.drawer;
            }
        },
        methods: {
            closeMenu() {
                this.userMenuOpen = false;
            },
            logout()
            {
                axios.post('/logout');

                axios.get('https://team1-group-project.azurewebsites.net/api/client_logout' , { headers: {Authorization: "Bearer "+'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiNDk4M2RkMWUxMzNlZTVhNWYwNjdiNmYzMjg0YTkyODNmNGUwZjM0ZjRhNjI5ZmZiYTgxYmNjMGUyODM1M2FmMWM1MTFjMDg0NGEyMjdjY2EiLCJpYXQiOjE1OTAyNjk4OTYsIm5iZiI6MTU5MDI2OTg5NiwiZXhwIjoxNjIxODA1ODk2LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.aWDzeY5Ta31Nmz8GWlPWqvjBl-yeDJLfdfj2ZYMeUx0gAV0FKW0oEeHVoQgvd1Yu6qVA5OEGMOANzrXBiOMBHn5WZWyre3sWi_js97Bhbe7E0niIEoqzJxL0zix8IDh7fnS854awJVIzU_bJIXj095O0lO_b2VMR6ap5Nn47OOf63FZH9QcDs7349F1b1vwX-XzKJB6iopbCgGuTNoPdBJmi90rB2M6aXscO9z7YNDTLPsAg1kZQLingBsdoExrXpPbaf0ovk9sHQsWn5N20cHt_7zm-KeKZjIqKQp4_Z5XIZV6liyj_8dH0ib4SWaB75zjX8ToFTKDG3FzPQ5JYjHDJ2FEDfkqxPUWarOOPLpCLMJYHqY_qKYVuBArDUErqN6Bj13hBe3gD2K9vM2iqMDd0W3B4VowOoYZdfXm6-ULOhoxn5SrtdTIaE-h5zyV7-1woNYns9Ngh79VJVBWJTpsQSU7vCQNuavnCltKapTaMP0JAMe-WoMl5EjDX-mHSb8r_s_aSvdzgXEfxG5LWM6zjuk2LYmZ2MfRaIl3XGvNR50CNZzBxxz5K_nQbjABDOx7PTHJxsZd9U9rcNzVsucCfwYQQHROe1a6Yjj6VU6OM0YNY5oay2zo8fVDEMygA7eX4F77d0v-SHK5MVAZmtnihvfnAocAtHwaQavwGXu0'}})
                    .then(r => location.href= r.data)
            }
        }
    }
</script>


<style>

</style>
