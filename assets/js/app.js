/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)

//https://github.com/symfony/webpack-encore/issues/242#issuecomment-418716800
require('@babel/polyfill');
import Vue from 'vue';
import App from './vue/App';
import store from './vue/store'
// require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

new Vue({
    el: '#app',
    template: '<App />',
    render: h => h(App),
    store
});