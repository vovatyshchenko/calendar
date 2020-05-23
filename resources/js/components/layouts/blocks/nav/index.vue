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

                axios.get('https://team1-group-project.azurewebsites.net/api/client_logout' , { headers: {Authorization: "Bearer "+'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiNTg2MjM5YmE5MjFmMWFhZDkyMDc0Y2MwYmEwNTE3OTNmZjk5MWYxZTg2MjliMTc0M2NiYTBkYTlmMTIzYjIwMzdiZDEwNzI5NjIzYjRmYjgiLCJpYXQiOjE1OTAyNzAzNjgsIm5iZiI6MTU5MDI3MDM2OCwiZXhwIjoxNjIxODA2MzY4LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.2CFytnxxWCE3B_JntQpJl8OWueHykGscF4A4HExwSiaxnlARuzscGslMmvlZUcP4l1FaHbS2TigUQMZdBblZ4yeSWHkiVzN8zJTzTNTOzLSkSTxThzME6dWvqXyw-WgFS2WaDZdXYN0ALWXnbUsDY8fxKGRaS0rSIXJ_hjNyglxHlon1y-UsYmS_o6y6aRAY1HIaB4ugSZx1At1iTa9RgUq9li7S0vliTU9dPKsTAjxL_JnD1NyzMbLZF63_tm0nTmqpYuKj4SqPTpd5qe3kCaxkxjtSesUguFdK5VbXVmF4qPWDoe7r6gk-UCMjE9tpVMcavUbpwshR2EcV2GdTuQIlG6epfYu09rjlmYSM3-smaRQMK14584w74zTbGmfJ6lDx-dqT1XC_yFcAfZr4Ep3BzyWe0-O4SuDIsvdoSAJ1ChNwVSim9Ow8brQxmOa2kd5GLCqKJvE0qk6ubynnZ8ypy4dLIUe7jX0hK-_is6kfSDjv2NssAojp9HwZbIAdWU-1fhuKG5sKGbQMvPUsthNF0grD0uXcdtuEWB81_9laNT_jvJYYXm7YRBEvJD0ia6OMNzifH5c54N-vxqFkHVXWxtC29_AK12vzBLSABg8ZBWYIKE3ZYHQI31nD3ySLOSBP83tt0LnP1nhBx3MvZoAtnpchDz7NT5wwnaVFPG8'}})
                    .then(r => location.href= r.data)
            }
        }
    }
</script>


<style>

</style>
