/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



Vue.component('region', require('./components/Regions.vue'));
Vue.component('municipalities', require('./components/Municipalities.vue'));
Vue.component('ports', require('./components/Ports.vue'));
Vue.component('autofisher', require('./components/ZoneAutoFishers.vue'));
Vue.component('flags', require('./components/Flags.vue'));
Vue.component('docks', require('./components/Docks.vue'));
Vue.component('zarpe', require('./components/Zarpe.vue'));
Vue.component('arrival', require('./components/Arrivals.vue'));
Vue.component('checkdetinch', require('./components/CheckDetInch.vue'));
Vue.component('checkdetflap', require('./components/CheckDetFlap.vue'));
Vue.component('presenverific', require('./components/PresenVerific.vue'));
Vue.component('nationality', require('./components/Nationality.vue'));
Vue.component('companies', require('./components/Companies.vue'));
// Vue.component('regional', require('./components/Regionals.vue'));
Vue.component('donations', require('./components/DonationCertificates.vue'));
Vue.component('confiscations', require('./components/ConfiscationCertificates.vue'));
Vue.component('inspectioncargos', require('./components/InspectionBoatCargo.vue'));
Vue.component('certificationtuna', require('./components/CertificationDisembTuna.vue'));


const app = new Vue({
    el: '#app',

    data: {
        menu: 0
    }
});