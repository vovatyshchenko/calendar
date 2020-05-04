<template>
    <div class="wrapper">
        <nav class="navbar navbar-light">
            <div class="user">
            <a href="#">Анна Кононенко
                <img src="img/user.png" alt="avatar">
            </a>
            <div class="toggle_user-menu"></div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped type="scss">
    .wrapper {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        position: relative;
    }
    .user {
        position: relative;
        display: flex;
        align-items: center;
    }
    .user > a {
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 75px;
        text-align: right;
        color: #999999;
        position: relative;
    }
    .user img {
        margin-left: 20px;
    }
</style>