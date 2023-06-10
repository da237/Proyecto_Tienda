/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs';


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.use(LaravelPermissionToVueJS)


import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);
import Paginator from './components/Paginator.vue';
app.component('paginator',Paginator);
import Productos from './components/products/Productos.vue';
app.component('productos',Productos);
import CreateProduct from './components/products/CreateProduct.vue';
app.component('product-create',CreateProduct)
// import Hola from './components/products/Hola.vue';
// app.component('hola',Hola)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
