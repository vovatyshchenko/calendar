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
                axios.get('/logout');
                axios.get('https://team1-group-project.azurewebsites.net/api/client_logout' , { headers: {Authorization: "Bearer "+'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiOGVmYmE2NDBmNTY5MTdkMTkxMmQzNzM5NTNiNzQ1MzIxMWZhNzA1MDYxNGUxNTc3NjlhYWFiNDBiMmQxMGYxZDBiMTg0OGE0YjZmZjNhMDkiLCJpYXQiOjE1OTAyMzc4ODMsIm5iZiI6MTU5MDIzNzg4MywiZXhwIjoxNjIxNzczODgzLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.bZEl04ofzzf4ovv47l5X57jFz5SdwGk-o2AFKQFGAKqKxkXW1-LU9xjvF0xBxk_rkahzS3_RWUzYxybnMh7AWvPqnQoQZuO5yaPbK0nQ_-fw8kFUuUFPbfm4JTSsgbSs7-UXrj2fwmc9iSH2rBhokyMNMsDAtAaqCP_-2PWqGVR2fUWCPBckUM6xJPslmCiGoaLJU5YBaXIdaIL9w2Q2KIoL94AT9IjzHNfFcBKD7Lop-qvwf9zRRAUDu4YfZTBjesIVbY5VEyz_iZCYZut5qsr4FqPCf34nceDdMWwZvWCgcJYLyTQ6RbWR7EOuBdX5JGogoJ5eVYlmWQB4xnAFqZl6a2No0w1Ifwg7HSOuYqP9JQnrpGN2ArO8yhEle8sQHbGSY7WLI4UK7erEdIHXgBGns8it37eL1PtM79kaxZiXxSE0yBpCmMA89PFKtUUb-lyOlMmA4LKERLpe8OFGFoPwWFz4uf4w21Y9EtlK6EkFYeXX6j5h6FhiYIcRszbrgURxFNw10t_s4EBKMWvXWMlDFQGMhuUWrZwCObdxeRmdiURLsyZuukq-n4N43K9uiq37zLfnIsAQ1OlLzL95YmRMqm5Q3sMBdmASgOnNMRu1pUhKDO0Iw8hoycZ4knKqlVIrkWzKrbeNaMOWhTgf6QSBkUzw7auFd4nV6wotHHA'}})
                    .then(r => location.href= '/')
            }
        }
    }
</script>


<style>

</style>
