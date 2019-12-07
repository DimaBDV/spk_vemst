/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('offer-form', require('./components/offerForm.vue').default);
Vue.component('waiting-list', require('./components/waiting.vue').default);
Vue.component('waiting-modal', require('./components/waitingModal.vue').default);

Vue.component('user-index', require('./components/user/index.vue').default);
Vue.component('user-module-profile', require('./components/user/modules/profile.vue').default);
Vue.component('user-module-notify', require('./components/user/modules/notify.vue').default);
Vue.component('user-module-settings', require('./components/user/modules/settings.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
