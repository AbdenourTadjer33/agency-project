function createInputLabelContainer(placeholder, name, id) {
    // containerEl
    const containerEl = document.createElement("div");

    // labelEl
    const labelEl = document.createElement("label");
    labelEl.classList = "block mb-2 text-sm font-medium text-gray-900";
    labelEl.setAttribute("for", id);
    labelEl.innerText = placeholder;

    // inputEl
    const inputEl = document.createElement("input");
    inputEl.classList =
        "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5";
    inputEl.setAttribute("type", "text");
    inputEl.setAttribute("id", id);
    inputEl.setAttribute("name", name);

    containerEl.append(labelEl, inputEl);
    return containerEl;
}

function createDateInputLabelContainer(placeholder, name) {
    // containerEl
    const containerEl = document.createElement("div");

    // labelEl
    const labelEl = document.createElement("label");
    labelEl.classList = "block mb-2 text-sm font-medium text-gray-900";
    labelEl.innerText = placeholder;

    const div = document.createElement("div");
    div.innerHTML = `<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none"><svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" /></svg></div>`;
    div.classList = "relative";

    const dateInput = document.createElement("input");
    dateInput.classList =
        "bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
    dateInput.setAttribute("datepicker", "");
    dateInput.setAttribute("type", "text");
    dateInput.setAttribute("name", name);
    dateInput.setAttribute('id', name);
    dateInput.setAttribute("placeholder", "Sélectionner une date");

    const customEvent = new CustomEvent("new-datepicker", {
        detail: {
            element: dateInput,
        },
    });
    document.dispatchEvent(customEvent);

    div.append(dateInput);
    containerEl.append(labelEl, div);
    return containerEl;
}

const form = document.querySelector("form#ticketing");
const flightTypeField = form.querySelector("select[name=flight_type]");
const rangeDatesContainer = form.querySelector("#container-range-dates");
const dateDeparture = form.querySelector("#date-departure");
const selectAdultNb = form.querySelector("#nb-adult");
const selectChildNb = form.querySelector("#nb-child");
const selectBabyNb = form.querySelector("#nb-baby");
const checkForMe = form.querySelector("#for_me");

checkForMe.onchange = (event) => {
    const fnameField = document.getElementById("adult[0][fname]");
    const lnameField = document.getElementById("adult[0][lname]");
    const dobField = document.getElementById("adult[0][dob]");
    const idField = document.getElementById("adult[0][passport_id]");

    if (checkForMe.checked) {
        fnameField.value = checkForMe.getAttribute("data-fname");
        lnameField.value = checkForMe.getAttribute("data-lname");
        dobField.value = checkForMe.getAttribute("data-dob");
        idField.value = checkForMe.getAttribute("data-id");
    } else {
        fnameField.value = "";
        lnameField.value = "";
        dobField.value = "";
        idField.value = "";
    }
};

selectAdultNb.onchange = (event) => {
    const len = selectAdultNb.value;
    form.querySelector("#container-info-adult").innerHTML = "";
    for (let i = 0; i < len; i++) {
        const fnameContainer = createInputLabelContainer(
            "Prénom Adulte (*)",
            `adult[${i}][fname]`,
            `adult[${i}][fname]`
        );
        const lnameContainer = createInputLabelContainer(
            "Nom Adulte (*)",
            `adult[${i}][lname]`,
            `adult[${i}][lname]`
        );
        const dobContainer = createDateInputLabelContainer(
            "Date de naissance Adulte (*)",
            `adult[${i}][dob]`
        );
        const idContainer = createInputLabelContainer(
            "Passeport N° (*)",
            `adult[${i}][passport_id]`,
            `adult[${i}][passport_id]`
        );

        form.querySelector("#container-info-adult").append(
            fnameContainer,
            lnameContainer,
            dobContainer,
            idContainer
        );
    }

    if (checkForMe.checked) {
        const fnameField = document.getElementById("adult[0][fname]");
        const lnameField = document.getElementById("adult[0][lname]");
        const dobField = document.getElementById("adult[0][dob]");
        const idField = document.getElementById("adult[0][passport_id]");
        fnameField.value = checkForMe.getAttribute("data-fname");
        lnameField.value = checkForMe.getAttribute("data-lname");
        dobField.value = checkForMe.getAttribute("data-dob");
        idField.value = checkForMe.getAttribute("data-id");
    }
};

selectChildNb.onchange = (event) => {
    const len = selectChildNb.value;
    if (len > 0)
        form.querySelector("#container-info-child").classList.remove("hidden");
    if (len == 0)
        form.querySelector("#container-info-child").classList.add("hidden");
    form.querySelector("#container-info-child").innerHTML = "";
    for (let i = 0; i < len; i++) {
        const fnameContainer = createInputLabelContainer(
            "Prénom Enfant (*)",
            `child[${i}][fname]`,
            `child[${i}][fname]`
        );
        const lnameContainer = createInputLabelContainer(
            "Nom Enfant (*)",
            `child[${i}][lname]`,
            `child[${i}][lname]`
        );
        const dobContainer = createDateInputLabelContainer(
            "Date de naissance Enfant (*)",
            `child[${i}][dob]`
        );
        const idContainer = createInputLabelContainer(
            "Passeport N° (*)",
            `child[${i}][passport_id]`,
            `child[${i}][passport_id]`
        );

        form.querySelector("#container-info-child").append(
            fnameContainer,
            lnameContainer,
            dobContainer,
            idContainer
        );
    }
};

selectBabyNb.onchange = (event) => {
    const len = selectBabyNb.value;
    if (len > 0)
        form.querySelector("#container-info-baby").classList.remove("hidden");
    if (len == 0)
        form.querySelector("#container-info-baby").classList.add("hidden");
    form.querySelector("#container-info-baby").innerHTML = "";
    for (let i = 0; i < len; i++) {
        const fnameContainer = createInputLabelContainer(
            "Prénom Bébe (*)",
            `baby[${i}][fname]`,
            `baby[${i}][fname]`
        );
        const lnameContainer = createInputLabelContainer(
            "Nom Bébe (*)",
            `baby[${i}][lname]`,
            `baby[${i}][lname]`
        );
        const dobContainer = createDateInputLabelContainer(
            "Date de naissance Bébe (*)",
            `baby[${i}][dob]`
        );
        const idContainer = createInputLabelContainer(
            "Passeport N° (*)",
            `baby[${i}][passport_id]`,
            `baby[${i}][passport_id]`
        );
        form.querySelector("#container-info-baby").append(
            fnameContainer,
            lnameContainer,
            dobContainer,
            idContainer
        );
    }
};

flightTypeField.onchange = (event) => {
    if (flightTypeField.value === "AS") {
        // date departure
        dateDeparture.classList.remove("hidden");
        rangeDatesContainer.classList.add("hidden");
    } else if (flightTypeField.value === "AR") {
        // date departure & return
        dateDeparture.classList.add("hidden");
        rangeDatesContainer.classList.remove("hidden");
    }
};
