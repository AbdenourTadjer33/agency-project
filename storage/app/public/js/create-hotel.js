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

const assetsInput = document.querySelector("#assets");
const imagesTarget = document.querySelector("div#target");

const MAXFILE = 5;
let isAlert = false;

assetsInput.onchange = (event) => {
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
