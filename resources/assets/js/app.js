require('./bootstrap');
import router from './routes';
window.Vue = require('vue');




new Vue({
    el: '#app',
    router
});
