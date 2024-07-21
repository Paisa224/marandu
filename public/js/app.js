require('./bootstrap');

window.Vue = require('vue').default;

// Importar componentes de Vue
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
