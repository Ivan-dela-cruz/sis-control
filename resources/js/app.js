
require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('nuevo-usuario', require('./components/nuevoUser.vue').default);
Vue.component('gestio-equipos', require('./components/equipos.vue').default);

const app = new Vue({
    el: '#app',
});
