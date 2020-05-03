require('./bootstrap');

$(window).on('load', function () {
    // Remove alert after clicking close
    const alert = document.querySelector('#alert');
    const closeBtn = document.querySelector('.close-btn');

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            setTimeout(() => {
                alert.remove();
            }, 250);
        });
    }
});

import Vue from 'vue'
import DatePicker from "./components/DatePicker";
import ReasonReview from "./components/ReasonReview"

Vue.component('datepicker', DatePicker);
Vue.component('reason-review', ReasonReview);

const app = new Vue({
    el: '#app',
});
