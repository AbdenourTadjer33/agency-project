const selectedServices = document.querySelector("#selected-services");

function addInput(value) {
    const input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "services[]");
    input.setAttribute("value", value);
    selectedServices.appendChild(input);
}

function removeInput(value) {
    selectedServices.querySelector(`[value='${value}']`).remove();
}




