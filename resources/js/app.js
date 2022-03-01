require('./bootstrap');

//tambahan
window.Vue = require('vue');

Vue.component('front-page', require('./front.vue').default);

const app = new Vue({
    el: '#app',
});
