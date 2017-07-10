import Vue from 'vue';
import VueClip from 'vue-clip';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueNotifications from 'vue-notifications';
import miniToastr from 'mini-toastr'
import VueCookie from 'vue-cookie';

const toastTypes = {
    success: 'success',
    error: 'error',
    info: 'info',
    warn: 'warn'
};



miniToastr.init({
    types: toastTypes,
    /*
     style: {
     'mini-toastr__notification': {
     'mini-toastr-notification__message': {
     'border-radius': '0px',
     color: 'red',
     width: '25%',
     'background-color': "blue"
     }
     }
     }
     */
});
function toast ({title, message, type, timeout, cb}) {
    return miniToastr[type](message, title, timeout, cb)
}

const options = {
    success: toast,
    error: toast,
    info: toast,
    warn: toast,
    closeButton: true
};

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(VueClip);
window.axios = axios;
Vue.prototype.$http = axios;
Vue.use(VueNotifications, options);
Vue.use(VueCookie);
/*
 window.axios.defaults.headers.common = {
 'X-Requested-With' : 'XMLHttpRequest'
 };
 window.axios.defaults.headers.common = {
 'X-Requested-With': 'XMLHttpRequest',
 'X-CSRF-TOKEN': Laravel.csrfToken
 };
 */
axios.defaults.headers.common['Authorization'] = VueCookie.get('api_token');
