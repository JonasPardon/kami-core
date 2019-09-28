/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import VCalendar from 'v-calendar';
import Datetime from 'vue-datetime';
import ToggleButton from 'vue-js-toggle-button'
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Toasted from 'vue-toasted';

import 'vue-datetime/dist/vue-datetime.css';

library.add(fas);

Vue.use(InertiaApp);
Vue.use(VCalendar);
Vue.use(Datetime);
Vue.use(ToggleButton);
Vue.use(Toasted);

Vue.component('layout', require('./shared/Layout').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('data-table', require('./components/Datatable').default);
Vue.component('custom-form', require('./components/Form').default);
Vue.component('custom-btn', require('./components/Button').default);
Vue.component('tooltip', require('./components/Tooltip').default);

const app = document.getElementById('app');

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`./pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app);
