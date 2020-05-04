<template>
  <div>
    <user-block></user-block>
    <div class="container">
      <router-view></router-view>
    </div> 
  </div>
</template>

<script>
  export default {
    data: () => ({}),
    /*created() {
      if (localStorage.hasOwnProperty('token')){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        this.$store.dispatch("state_change");
      }
    }*/
  }
</script>
