
 export default {
     data(){
         return{

         }
     },
     computed:{
         holidayTextEventForDay()
         {
             let dateForMonth = this.$store.getters.menuDate;
             if (this.$store.getters.holidays[dateForMonth.getMonth() + 1]) {
                 if (this.$store.getters.holidays[dateForMonth.getMonth() + 1][dateForMonth.getDate()]) {

                     return  this.$store.getters.holidays[dateForMonth.getMonth() + 1][dateForMonth.getDate()].localName;
                 }
             }
         },
         holidayTextEvent()
         {
             let parseDate = this.date.split("-");

             if(this.$store.getters.holidays[parseDate[1]])
             {
                 if(this.$store.getters.holidays[parseDate[1]][parseDate[2]])
                 {
                     return this.$store.getters.holidays[parseDate[1]][parseDate[2]].localName;
                 }
             }
         }
     }
 }
