import Vue from "vue";
import VueFilterDateFormat from 'vue-filter-date-format'
Vue.filter('cutText', function (value, symbolsCount){
    return value.length > symbolsCount
        ? value.slice(0, symbolsCount - 3) + '...'
        : value;
})

Vue.use(VueFilterDateFormat, {
    dayOfWeekNames: [
        'Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг',
        'Пятница', 'Суббота'
    ],
    dayOfWeekNamesShort: [
        'ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'
    ],
    monthNames: [
        'Января', 'Декабря', 'Марта', 'Апреля', 'Мая', 'Июня',
        'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'
    ],
    monthNamesShort: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ]
});

