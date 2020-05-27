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
                                    <button class="logout" @click="logout()">Выход</button>
                                </li>
                            </ul>
                        </div>
                        <a class="user"href="#">
                            {{ user?user.name:''}}
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
                name: 'Анна Кононенко',
                avatar: 'user.png',
                userMenuOpen: false,
                token: null,
                user:null
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
            logout() {
                axios.post('/logout')
                    .then(response => {
                        this.token = response.data;
                        axios.get('https://team1-group-project.azurewebsites.net/api/client_logout' , { headers: {Authorization: "Bearer "+this.token}})
                            .then(r => location.href= r.data)
                    });
            }
        },
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


<style scoped>
  .logout
  {
      font-style: normal;
      font-weight: 500;
      font-size: 14px;
      line-height: 75px;
      text-align: right;
      color: #999999;
      position: relative;
  }
.user_block a:hover,.user_block a:active{
    color: #999999;
}
</style>
