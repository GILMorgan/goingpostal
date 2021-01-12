/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import { props } from 'bluebird';
import Vue from 'vue'

Vue.component('autocomplete', {
    data: function () {
        return {
            searchText: '',
            results: [],
        }
    },

    props: ['inputName', 'route'],
    template: '<div><input :name="inputName" v-model="searchText"/><ul><li v-for="(result, i) in results" :key="i" :item="result"> {{ result }} </li></ul></div>',
    watch: {
        searchText: function () {
            this.sendQuery();
        }
    },
    methods: {
        sendQuery: function() {
            let httpRequest = new XMLHttpRequest();
            let _this = this;

            httpRequest.onreadystatechange = function() {
                if (httpRequest.status === 200 && httpRequest.readyState === 4) {
                    _this.results = JSON.parse(httpRequest.response);
                }
            }

            httpRequest.open('GET', this.route + "?q=" + this.searchText, true);
            httpRequest.send();
        }
    }
});

new Vue(
    {
        el: '#app'
    }
);

