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


