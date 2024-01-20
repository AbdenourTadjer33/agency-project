/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;https://github.com/themesberg/flowbite-datepicker/blob/master/dist/js/locales/de.js#L6

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
import "flowbite";
import Datepicker from "flowbite-datepicker/Datepicker";
import DateRangePicker from "flowbite-datepicker/DateRangePicker";
import fr from "flowbite-datepicker/locales/fr";
import Chart from "chart.js/auto";

import { Dropdown } from "flowbite";

window.Dropdown = Dropdown;
window.Chart = Chart;

document.querySelectorAll("[datepicker]").forEach((datepickerEl) => {
    Object.assign(Datepicker.locales, fr);
    const datePicker = new Datepicker(datepickerEl, {
        language: "fr",
        format: "yyyy-mm-dd",
        datepickerAutohide: true,
    });
});

document.querySelectorAll("[date-rangepicker]").forEach((datePickerRangeEL) => {
    const dateRangePicker = new DateRangePicker(datePickerRangeEL, {
        language: "fr",
        format: "yyyy-mm-dd",
        datepickerAutohide: true,
    });
});

document.addEventListener("new-datepicker", (event) => {
    Object.assign(Datepicker.locales, fr);
    const datePicker = new Datepicker(event.detail.element, {
        language: "fr",
        format: "yyyy-mm-dd",
        datepickerAutohide: true,
    });
});

document.addEventListener("new-daterangepicker", (event) => {
    Object.assign(Datepicker.locales, fr);
    const datePicker = new DateRangePicker(event.detail.element, {
        language: "fr",
        format: "yyyy-mm-dd",
        datepickerAutohide: true,
    });
});


const $btnNotifTrigger = document.querySelector('#dropdownNotificationButton');
const $dropdownNotif = document.querySelector('#dropdownNotification');
const options = {
    placement: 'bottom',
    triggerType: 'click',
    offsetSkidding: 100,
    offsetDistance: 35,
    delay: 300,
    ignoreClickOutsideClass: false,
};
const instanceOptions = {
    id: 'dropdownMenu',
    override: true
};
const dropdown = new Dropdown($dropdownNotif, $btnNotifTrigger, options, instanceOptions);