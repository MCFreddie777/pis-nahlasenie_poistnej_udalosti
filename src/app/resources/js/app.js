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
import DatePicker from "./components/Ui/Datepicker";
import Checkbox from "./components/Ui/Checkbox";
import ReasonReview from "./components/ReasonReview"

Vue.component('ui-datepicker', DatePicker);
Vue.component('ui-checkbox', Checkbox);
Vue.component('reason-review', ReasonReview);

const app = new Vue({
    el: '#app',
});
