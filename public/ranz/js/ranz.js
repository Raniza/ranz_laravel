const makeElementDisable = () => {
    const elDisable = document.querySelectorAll(".el-disable");

    if (elDisable.length > 0) {
        setTimeout(() => {
            elDisable.forEach((el) => {
                el.disabled = true;
            });
        }, 100);
    }
};

const removeErrorValidation = () => {
    const errorValidation = document.querySelectorAll(".error-validation");
    const isInvalidClass = document.querySelectorAll(".is-invalid");
    const errorSummernote = document.querySelector(".summer");

    if (errorValidation.length > 0) {
        errorValidation.forEach((el) => {
            el.remove();
        });
    }

    if (isInvalidClass.length > 0) {
        isInvalidClass.forEach((el) => {
            el.classList.remove("is-invalid");
        });
    }

    if (errorSummernote) {
        errorSummernote.classList.remove("border");
        errorSummernote.classList.remove("border-danger");
    }
};

const capitalize = (str) => {
    return str
        .split(" ")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
};

const loadingStatus = (className) => {
    const loadingOverlay = document.querySelector(`.${className}`);

    if (loadingOverlay) {
        loadingOverlay.style.display = "flex";
    }
};
