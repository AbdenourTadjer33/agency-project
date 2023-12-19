const assetsInput = document.querySelector("#trip-assets #assets");
const imagesTarget = document.querySelector("#trip-assets div#target");

const MAXFILE = 6;
let isAlert = false;

assetsInput.onchange = (event) => {
    event.stopPropagation();
    const assets = assetsInput.files;
    if (assets.length > MAXFILE) {
        assetsInput.value = null;
        isAlert = true;
        alert("maximum file upload is " + MAXFILE);
    }
    imagesTarget.innerHTML = "";
    let index = 0;
    while (!isAlert && index < assets.length) {
        const path = URL.createObjectURL(assets[index]);
        // container Div
        const containerImgBg = document.createElement("div");

        containerImgBg.setAttribute("data-file", assets[index].name);

        containerImgBg.classList.add(
            "relative",
            "img-editor",
            "w-28",
            "h-28",
            "bg-center",
            "bg-no-repeat",
            "bg-cover",
            "transition",
            "duration-100"
        );
        containerImgBg.style.backgroundImage = `url(${path})`;
        // removerSpan
        const remover = document.createElement("span");
        remover.classList.add(
            "z-50",
            "absolute",
            "cursor-pointer",
            "img-remove"
        );
        remover.setAttribute("title", "supprimer l'image");
        remover.style.top = "3px";
        remover.style.right = "3px";
        remover.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-300  shadow-2xl" fill="currentColor"><path d="m12,0C5.383,0,0,5.383,0,12s5.383,12,12,12,12-5.383,12-12S18.617,0,12,0Zm3.707,14.293c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293,2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l2.293,2.293,2.293-2.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414l-2.293,2.293,2.293,2.293Z"/></svg>`;

        containerImgBg.append(remover);

        const overlay = document.createElement("div");
        overlay.classList.add("overlay");
        const editIconSpan = document.createElement("span");
        editIconSpan.innerText = "✎";
        editIconSpan.classList.add("edit-icon");

        overlay.append(editIconSpan);
        containerImgBg.append(overlay);

        imagesTarget.append(containerImgBg);
        index++;
    }
    isAlert = false;
};

// remove image
document.onclick = (event) => {
    const target = event.target.closest(".img-remove");

    if (target) {
        const fileName = target.parentNode.getAttribute("data-file");
        const files = assetsInput.files;
        const filesArray = Array.from(files);
        const index = filesArray.indexOf(
            filesArray.find((file) => file.name == fileName)
        );

        if (index > -1) {
            filesArray.splice(index, 1);
            const newFileList = createFileList(filesArray);
            assetsInput.files = newFileList;
            target.parentNode.remove();
        }
    }
};

function createFileList(array) {
    const dataTransfer = new DataTransfer();

    array.forEach((file) => {
        dataTransfer.items.add(file);
    });

    return dataTransfer.files;
}

//  add date & delete them & add new category script
const datesContainer = document.querySelector("#dates-container");
const addBtn = document.querySelector("#add-date");

window.onload = function () {
    // adding date inputs
    addBtn.onclick = (event) => {
        event.stopPropagation();
        // Create the main container div
        const dateRangePickerContainer = document.createElement("div");
        dateRangePickerContainer.setAttribute("date-rangepicker", "");
        dateRangePickerContainer.classList.add("flex", "items-center", "mb-1");

        const len = parseInt(datesContainer.getAttribute('data-len'));

        // Create the first date input container
        const startDateContainer = createInputContainer(
            `dates[${len+1}][departure]`,
            "Sélectionnez la date de début"
        );

        // Create the "to" span
        const toSpan = document.createElement("span");
        toSpan.classList.add("mx-4", "text-gray-500");
        toSpan.textContent = "au";

        // Create the second date input container
        const endDateContainer = createInputContainer(
            `dates[${len+1}][return]`,
            "Sélectionnez la date de fin",
        );

        // create the "delete" btn
        const deleteBtn = document.createElement("span");
        deleteBtn.classList =
            "flex delete-btn disabled:bg-slate-200 disabled:border-red-400 disabled:cursor-not-allowed disabled:shadow-none cursor-pointer shadow-md ms-4 bg-red-100 text-red-800 font-medium px-2 py-2 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400";
        deleteBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-red-400" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                </path>
                                </svg>`;

        // Append elements to the main container
        dateRangePickerContainer.appendChild(startDateContainer);
        dateRangePickerContainer.appendChild(toSpan);
        dateRangePickerContainer.appendChild(endDateContainer);
        dateRangePickerContainer.appendChild(deleteBtn);

        datesContainer.setAttribute('data-len', len+1)
        datesContainer.appendChild(dateRangePickerContainer);

        const customEvent = new CustomEvent("new-daterangepicker", {
            detail: {
                element: dateRangePickerContainer,
            },
        });

        document.dispatchEvent(customEvent);
    };

    // delete date inputs
    document.onclick = (event) => {
        const deleteBtn = event.target.closest(".delete-btn");
        if (deleteBtn) {
            deleteBtn.parentNode.remove();
        }
    };

    // adding new categories
    const formCategory = document.querySelector("form#new-category");
    const btnSubmit = formCategory.querySelector("button[type=submit]");
    formCategory.onsubmit = async (event) => {
        event.preventDefault();
        const categoryName = document.querySelector(
            "input[name=category-name]#category-name"
        ).value;
        try {
            btnSubmit.querySelector("[role=status]").classList.remove("hidden");
            const response = await axios.post("/api/admin/trips/add-category", {
                name: categoryName,
            });
            const dataCategories = response.data.categories;
            const categoriesContainer =
                formCategory.parentNode.querySelector(".categories");
            categoriesContainer.innerHTML = "";
            dataCategories.forEach((item) => {
                categoriesContainer.innerHTML += `<span
                                class="bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300 text-xs font-medium m-0.5 px-2.5 py-1 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                ${item.name}
                            </span>`;
            });

            const categoryOptionContainer = document.querySelector("#category");
            categoryOptionContainer.innerHTML = "";
            dataCategories.forEach((item) => {
                categoryOptionContainer.innerHTML += `<option value="${item.id}">${item.name} </option>`;
            });
            btnSubmit.querySelector("[role=status]").classList.add("hidden");
        } catch (error) {
            console.log(error);
        }
    };
};

// Function to create date input container
function createInputContainer(name, placeholder) {
    const inputContainer = document.createElement("div");
    inputContainer.classList.add("relative");

    const iconContainer = document.createElement("div");
    iconContainer.classList.add(
        "absolute",
        "inset-y-0",
        "start-0",
        "flex",
        "items-center",
        "ps-3",
        "pointer-events-none"
    );

    iconContainer.innerHTML = `<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>`;

    const dateInput = document.createElement("input");
    dateInput.setAttribute("name", name);
    dateInput.setAttribute("type", "text");
    dateInput.setAttribute("datepicker", "");
    dateInput.classList.add(
        "bg-gray-50",
        "border",
        "border-gray-300",
        "text-gray-900",
        "text-sm",
        "rounded-lg",
        "focus:ring-blue-500",
        "focus:border-blue-500",
        "block",
        "w-full",
        "ps-10",
        "p-2.5",
        "dark:bg-gray-700",
        "dark:border-gray-600",
        "dark:placeholder-gray-400",
        "dark:text-white",
        "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500"
    );
    dateInput.setAttribute("placeholder", placeholder);

    // Append elements to the input container
    inputContainer.appendChild(iconContainer);
    inputContainer.appendChild(dateInput);

    const customEvent = new CustomEvent("new-datepicker", {
        detail: {
            element: dateInput,
        },
    });
    document.dispatchEvent(customEvent);
    return inputContainer;
}


// add new hotel or select existing one
const checkBox = document.querySelector("#on_my_hotels");
const hotelSlug = document.querySelector("#hotel-slug");
const hotelData = document.querySelector("#hotel-data");

checkBox.onchange = (event) => {
    checkBox.checked
        ? hotelData.classList.add("hidden")
        : hotelData.classList.remove("hidden");
    checkBox.checked
        ? hotelSlug.classList.remove("hidden")
        : hotelSlug.classList.add("hidden");
};

// services
const selectedServices = document.querySelector("#selected-services");

function addInput(value) {
    const input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "hotel[services][]");
    input.setAttribute("value", value);
    selectedServices.appendChild(input);
}

function removeInput(value) {
    selectedServices.querySelector(`[value='${value}']`).remove();
}
