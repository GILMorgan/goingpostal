<template>
    <div>
        <input :name="inputName" v-model="searchText"/>
        <ul>
            <li v-for="(result, i) in results" :key="i" :item="result"> {{ result }} </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'autocomplete',
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
}
</script>