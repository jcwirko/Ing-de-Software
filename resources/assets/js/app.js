
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('data-ema', require('./components/Tables.vue'));

const app = new Vue({
    el: '#app'
});



//var data = [
//    ['ar-tf', 0, 'wea'],
//    ['ar-ba', 26, 8],
////    ['ar-sj', 2, 'wea'],
////    ['ar-mz', 3, 'wea'],
////    ['ar-nq', 4, 'wea'],
////    ['ar-lp', 5, 'wea'],
////    ['ar-rn', 6, 'wea'],
////    ['ar-sl', 7, 'wea'],
////    ['ar-cb', 8, 'wea'],
////    ['ar-ct', 9, 'wea'],
////    ['ar-lr', 10, 'wea'],
////    ['ar-sa', 11, 'wea'],
////    ['ar-se', 12, 'wea'],
////    ['ar-tm', 13, 'wea'],
////    ['ar-cc', 14, 'wea'],
////    ['ar-fm', 15, 'wea'],
////    ['ar-cn', 16, 'wea'],
////    ['ar-er', 17, 'wea'],
////    ['ar-ch', 18, 'wea'],
////    ['ar-sf', 19, 'wea'],
////    ['ar-mn', 41, 'wea'],
////    ['ar-df', 21, 'wea'],
////    ['ar-sc', 22, 'wea'],
////    ['ar-jy', 23, 'wea']
//];


// Create the chart
