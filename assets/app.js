/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import { props } from 'bluebird';
import Vue from 'vue'

import autocomplete from './js/components/autocomplete';

Vue.component('autocomplete', autocomplete);

new Vue(
    {
        el: '#app'
    }
);

