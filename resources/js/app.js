
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store.js'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('auth-nav', require('./components/shared/AuthNav.vue'));
Vue.component('no-auth-nav', require('./components/shared/NoAuthNav.vue'));
Vue.component('global-error', require('./components/shared/GlobalError.vue'));

let url = location.href;
if (url.indexOf('/login') !== -1) {
    Vue.component('login', (resolve) => {
        require(['./components/no_auth/Login.vue'],resolve)
    });
}
if (url.indexOf('/register') !== -1) {
    Vue.component('register', (resolve) => {
        require(['./components/no_auth/Register.vue'],resolve)
    });
}
if (url.indexOf('/resend') !== -1) {
    Vue.component('resend-activation', (resolve) => {
        require(['./components/no_auth/ResendActivation.vue'],resolve)
    });
}
if (url.indexOf('/activate/') !== -1) {
    Vue.component('activate-failure', (resolve) => {
        require(['./components/no_auth/ActivateFailure.vue'],resolve)
    });
}
if (url.indexOf('/app') !== -1) {
    Vue.component('app', (resolve) => {
        require(['./components/auth/App.vue'],resolve)
    });
}

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
