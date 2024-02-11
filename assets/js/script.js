
// CONTACT
function contactPopUp() {
    const editButtons = document.querySelectorAll(".button-edit");
    const addButton = document.querySelector(".button-add");
    const addPopup = document.querySelector(".popup-add");
    const editPopup = document.querySelector(".popup-edit");
    const closeButtons = document.querySelectorAll(".btn-close");

    // Add Contact
    addButton.addEventListener("click", function () {
        document.getElementById("add-id-input").value = "";
        document.getElementById("add-number-input").value = "";
        addPopup.style.display = "flex";
    });

    // Edit Contact
    editButtons.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            const id = editButton.getAttribute("data-id");
            const number = editButton.getAttribute("data-number");
            document.getElementById("edit-id-input").value = id;
            document.getElementById("edit-number-input").value = number;
            editPopup.style.display = "flex";
        });
    });

    // Close
    closeButtons.forEach(function (closeButton) {
        closeButton.addEventListener("click", function () {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target === addPopup || event.target === editPopup) {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        }
    });
}

// Address
function addressPopUp() {
    const editButtons = document.querySelectorAll(".button-edit");
    const addButton = document.querySelector(".button-add");
    const addPopup = document.querySelector(".popup-add");
    const editPopup = document.querySelector(".popup-edit");
    const closeButtons = document.querySelectorAll(".btn-close");

    // Add Address
    addButton.addEventListener("click", function () {
        document.getElementById("add-id-input").value = "";
        document.getElementById("add-city-input").value = "";
        document.getElementById("add-state-input").value = "";
        document.getElementById("add-country-input").value = "";
        addPopup.style.display = "flex";
    });

    // Edit Address
    editButtons.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            const id = editButton.getAttribute("data-id");
            const city = editButton.getAttribute("data-city");
            const state = editButton.getAttribute("data-state");
            const country = editButton.getAttribute("data-country");
            document.getElementById("edit-id-input").value = id;
            document.getElementById("edit-city-input").value = city;
            document.getElementById("edit-state-input").value = state;
            document.getElementById("edit-country-input").value = country;
            editPopup.style.display = "flex";
        });
    });

    // Close
    closeButtons.forEach(function (closeButton) {
        closeButton.addEventListener("click", function () {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target === addPopup || event.target === editPopup) {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        }
    });
}

// Customer
function customerPopUp() {
    const editButtons = document.querySelectorAll(".button-edit");
    const addButton = document.querySelector(".button-add");
    const addPopup = document.querySelector(".popup-add");
    const editPopup = document.querySelector(".popup-edit");
    const closeButtons = document.querySelectorAll(".btn-close");

    // Add Customer
    addButton.addEventListener("click", function () {
        document.getElementById("add-code-input").value = "";
        document.getElementById("add-name-input").value = "";
        document.getElementById("add-contact_id-input").value = "";
        document.getElementById("add-address_id-input").value = "";
        addPopup.style.display = "flex";
    });

    // Edit Customer
    editButtons.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            const code = editButton.getAttribute("data-code");
            const name = editButton.getAttribute("data-name");
            const contact_id = editButton.getAttribute("data-contact_id");
            const address_id = editButton.getAttribute("data-address_id");
            document.getElementById("edit-code-input").value = code;
            document.getElementById("edit-name-input").value = name;
            document.getElementById("edit-contact_id-input").value = contact_id;
            document.getElementById("edit-address_id-input").value = address_id;
            editPopup.style.display = "flex";
        });
    });

    // Close
    closeButtons.forEach(function (closeButton) {
        closeButton.addEventListener("click", function () {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target === addPopup || event.target === editPopup) {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        }
    });
}

// Supplier
function supplierPopUp() {
    const editButtons = document.querySelectorAll(".button-edit");
    const addButton = document.querySelector(".button-add");
    const addPopup = document.querySelector(".popup-add");
    const editPopup = document.querySelector(".popup-edit");
    const closeButtons = document.querySelectorAll(".btn-close");

    // Add Supplier
    addButton.addEventListener("click", function () {
        document.getElementById("add-code-input").value = "";
        document.getElementById("add-name-input").value = "";
        document.getElementById("add-email-input").value = "";
        document.getElementById("add-contact_id-input").value = "";
        document.getElementById("add-address_id-input").value = "";
        addPopup.style.display = "flex";
    });

    // Edit Supplier
    editButtons.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            const code = editButton.getAttribute("data-code");
            const name = editButton.getAttribute("data-name");
            const email = editButton.getAttribute("data-email");
            const contact_id = editButton.getAttribute("data-contact_id");
            const address_id = editButton.getAttribute("data-address_id");
            document.getElementById("edit-code-input").value = code;
            document.getElementById("edit-name-input").value = name;
            document.getElementById("edit-email-input").value = email;
            document.getElementById("edit-contact_id-input").value = contact_id;
            document.getElementById("edit-address_id-input").value = address_id;
            editPopup.style.display = "flex";
        });
    });

    // Close
    closeButtons.forEach(function (closeButton) {
        closeButton.addEventListener("click", function () {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target === addPopup || event.target === editPopup) {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        }
    });
}

// item
function itemPopUp() {
    const editButtons = document.querySelectorAll(".button-edit");
    const addButton = document.querySelector(".button-add");
    const addPopup = document.querySelector(".popup-add");
    const editPopup = document.querySelector(".popup-edit");
    const closeButtons = document.querySelectorAll(".btn-close");

    // Add Supplier
    addButton.addEventListener("click", function () {
        document.getElementById("add-code-input").value = "";
        document.getElementById("add-name-input").value = "";
        document.getElementById("add-price-input").value = "";
        document.getElementById("add-stock-input").value = "";
        document.getElementById("add-category-input").value = "";
        addPopup.style.display = "flex";
    });

    // Edit Supplier
    editButtons.forEach(function (editButton) {
        editButton.addEventListener("click", function () {
            const code = editButton.getAttribute("data-code");
            const name = editButton.getAttribute("data-name");
            const price = editButton.getAttribute("data-price");
            const stock = editButton.getAttribute("data-stock");
            const category = editButton.getAttribute("data-category");
            document.getElementById("edit-code-input").value = code;
            document.getElementById("edit-name-input").value = name;
            document.getElementById("edit-price-input").value = price;
            document.getElementById("edit-stock-input").value = stock;
            document.getElementById("edit-category-input").value = category;
            editPopup.style.display = "flex";
        });
    });

    // Close
    closeButtons.forEach(function (closeButton) {
        closeButton.addEventListener("click", function () {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target === addPopup || event.target === editPopup) {
            addPopup.style.display = "none";
            editPopup.style.display = "none";
        }
    });
}