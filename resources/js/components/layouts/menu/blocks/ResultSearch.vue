<template>
    <div class="search-result">
        <div class="header d-flex">
            <div class="date d-flex">дата</div>
            <div class="time d-flex">время</div>
<!--            <span>Дата</span>-->
<!--            <span>Время</span>-->
        </div>
        <div class="pin-search d-flex"  v-for="(item,index) in searchEvent">
            <span class="date-pin d-flex">{{ item.date_start|dateParse('YYYY-MM-DD') |dateFormat('DD MMMM YYYY,dd') }}</span>
            <span class="time-pin d-flex">{{ item.time_start}} {{ item.name}},{{item.description?item.description:''}}</span>
        </div>
        <div v-if="searchEvent.length==0">
            Данных,к сожелению нет
        </div>
    </div>
</template>

<script>
    export default {
        name: "ResultSearch",
       data(){
            return{
            }
       },
        computed:{
            searchEvent()
            {
                return this.$store.getters.searchEvent
            }
        }
    }
</script>

<style scoped>
   .date,.date-pin{
       width:30%;
       justify-content: flex-end;
       padding-right: 10px;
   }

   .pin-search{

   }
   .time-pin{
       padding-left: 0;
   }
   .time,.time-pin{
       width:70%;
       justify-content: flex-start;

   }
    .time{
        padding-left: 10px;
   }

.search-result{
    width:700px;
}
</style>
