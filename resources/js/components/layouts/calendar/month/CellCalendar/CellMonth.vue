<template>
    <div>
        <div class="Cell">
            <div class="d-flex flex-column">
                <span class="date"><span>{{date}}</span></span>
                <ul class="d-flex align-center flex-column">
                    <li :style="{background:item.background}" :class="'event'+index" v-for="(item, index) in Events">
                        <span>{{item.text|cutText(21)}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                day:["апвпвп", "укеукеуке","кеукеуеуе","кеуеуеуе","кеуеуеу","укеуеуе", "кеукеуеуеуеуе"],
                date:29
                ,
                Events:[
                    {text:'Удивительный хаббл1222' ,background:'#F5E3F9'},
                    {text:'Брендинг знаете ли вы2',background: "#FEEACC"}
                ]
            }
        },
        filters: {
            cutText(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
    }
</script>

<style scoped>
    .Cell{
        min-height: 118px;
        background: red;
        /*background: #FFFFFF;*/
        min-width: 158px;
    }
    .Cell .date{
        text-align: end;
    }
    .Cell .date span
    {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 30px;
        color: #808080;
        padding:10px 9px;
    }
    .Cell .event0 {
        /*background: #F5E3F9;*/
        margin-bottom: 5px;
    }
    .Cell .event1 {
        /*background: #FEEACC;*/
    }
    .Cell .event0, .Cell .event1 {
        text-align: center;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    ul li span {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        line-height: 30px;
    }
    ul li :hover{

    }
    .der{
        width: 1000px;
        height: 1000px;
    }
    ul li {
        list-style: none;
        min-width: 150px;
        min-height: 30px;
        border-radius: 4px;
    }
</style>
