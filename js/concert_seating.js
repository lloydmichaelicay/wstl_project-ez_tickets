// Section groups for each location
const sectionGroups = {
    "bnb-standing": ["Standing"],
    "bnb-lower-box-p": ["201", "202", "207", "216", "221", "222"],
    "bnb-lower-box-a": ["203", "204", "205", "206", "217", "218", "219", "220"],
    "bnb-lower-box-b": ["203", "204", "205", "206", "217", "218", "219", "220"],
    "bnb-upper-box": ["401", "402", "403A", "403B", "404", "405", "406", "407", "408", "409", "416", "417", "418", "419", "420A", "420B", "421", "422"],
    "bnb-general-admission": ["501", "502", "503A", "503B", "504", "505", "506", "507", "508", "509", "516", "517", "518", "519", "520A", "520B", "521", "522"],
    
    "sb19-vip-standing-mosh": ["Standing"], 
    "sb19-vip-standing": ["Standing"],
    "sb19-vip-seating": ["107", "108", "109"],
    "sb19-lba-p": ["106", "110"],
    "sb19-lba-r": [ "102", "103", "104", "105", "111", "112", "113", "114"],
    "sb19-lbb-p": ["209", "210", "211", "212", "213", "214", "215"],
    "sb19-lbb-r": ["202", "203", "204", "205", "206", "207", "208"],
    "sb19-ub-a": ["406", "407", "416", "417"],
    "sb19-ubb-ga": ["402", "403", "404", "405", "406", "407", "408", "409", "410", "411"],

    "gv-platinum": ["101", "103", "107", "108", "113", "114"],
    "gv-vip": ["104", "105", "106", "115", "116", "117"],
    "gv-patron": ["105", "106", "107", "108", "113","114", "115", "116"],
    "gv-lower-box-a": ["201", "202", "200", "221"],
    "gv-lower-box-b": ["203", "204", "205", "206", "207","216", "217", "218", "219", "220"],
    "gv-upper-box": ["401", "401", "402", "403", "404", "405", "406", "407", "419", "420", "421", "422", "423"],
    "gv-gen-ad": ["Free Seating"], 

    "aura-main-floor": ["Row A", "Row B", "Row C", "Row D", "Row E", "Row F"],
    "aura-balcony": ["Row 2A", "Row 2B", "Row 2C", "Row 2D", "Row 2E", "Row 2F"],

}; 
 
// Function to filter sections based on the selected location
function filterSections() {
    const location = document.getElementById("location").value;
    const sectionSelect = document.getElementById("section");

    // Clear existing options
    sectionSelect.innerHTML = "";

    // Add the default "Select Section" option
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.text = "Section Number";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    sectionSelect.appendChild(defaultOption);

    // Get sections for the selected location
    const sections = sectionGroups[location] || [];

    // Populate the section dropdown with the appropriate sections
    sections.forEach(section => {
        const option = document.createElement("option");
        option.value = section;
        option.text = section;
        sectionSelect.appendChild(option);
    });

    // Update the price since we need to reflect potential changes
    updatePrice();
}


function validateQuantity() {
    const quantityInput = document.getElementById("quantity");
    let quantity = parseInt(quantityInput.value);

    // Check if the quantity is within the valid range
    if (quantity < 1 || quantity > 5 || isNaN(quantity)) {
        // Set to 1 if the input is out of bounds or invalid
        quantityInput.value = 1;
        quantity = 1;
    }

    // Update the price after validation
    updatePrice();
}

/* 
function updatePrice() {
    console.log("updatePrice function called");


    const location = document.getElementById("location");
    const selectedLocation = location.options[location.selectedIndex];
    
    // Check if a location is selected, if not exit early
    if (!selectedLocation || !selectedLocation.getAttribute("data-price")) {
        document.getElementById("total-price").innerText = "0.00";
        document.getElementById("calculated-price").value = "0.00"; // Reset hidden input
        return;
    }
     
    const pricePerTicket = parseInt(selectedLocation.getAttribute("data-price"));
    const quantity = parseInt(document.getElementById("quantity").value);

    // Calculate total price
    const totalPrice = pricePerTicket * quantity;

    // Update the total price in the DOM
    document.getElementById("total-price").innerText = totalPrice.toFixed(2);
    document.getElementById("calculated-price").value = totalPrice.toFixed(2);
    console.log("Hidden Input Updated:", document.getElementById("calculated-price").value);
}
*/
 
function updatePrice() {
    console.log("updatePrice function called");

    const location = document.getElementById("location");
    const selectedLocation = location.options[location.selectedIndex];
    
    if (!selectedLocation || !selectedLocation.getAttribute("data-price")) {
        console.log("No valid location selected");
        document.getElementById("total-price").innerText = "0.00";
        document.getElementById("calculated-price").value = "0.00"; // Reset hidden input
        return;
    }

    const pricePerTicket = parseInt(selectedLocation.getAttribute("data-price"));
    console.log("Price Per Ticket:", pricePerTicket);

    const quantity = parseInt(document.getElementById("quantity").value);
    console.log("Quantity:", quantity);

    if (isNaN(pricePerTicket) || isNaN(quantity)) {
        console.log("Invalid price or quantity");
        document.getElementById("total-price").innerText = "0.00";
        document.getElementById("calculated-price").value = "0.00";
        return;
    }

    const totalPrice = pricePerTicket * quantity;
    console.log("Calculated Total Price:", totalPrice);

    document.getElementById("total-price").innerText = totalPrice.toFixed(2);
    document.getElementById("calculated-price").value = totalPrice.toFixed(2);
    console.log("Hidden Input Updated:", document.getElementById("calculated-price").value);
}





// Initialize the price and sections when the page loads
window.onload = function() {
    pricePreview();
    filterSections();
    updatePrice();
};


function pricePreview() {
    const location = document.getElementById("location");
    const selectedLocation = location.options[location.selectedIndex];

    // Check if a valid location is selected
    if (!selectedLocation || !selectedLocation.hasAttribute("data-price")) {
        document.getElementById("total-price").innerText = "0.00";
        return;
    }

    // Get the price from the selected location
    const pricePerTicket = parseInt(selectedLocation.getAttribute("data-price"), 10);

    // Update the total price in the DOM
    document.getElementById("total-price").innerText = pricePerTicket.toFixed(2);
}


function previewSections() {
    const location = document.getElementById("location").value;
    const sectionSelect = document.getElementById("section");

    // Clear existing options
    sectionSelect.innerHTML = "";

    // Add the default "Select Section" option
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.text = "Select Section";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    sectionSelect.appendChild(defaultOption);

    // Get sections for the selected location
    const sections = sectionGroups[location] || [];

    // Populate the section dropdown with the appropriate sections
    sections.forEach(section => {
        const option = document.createElement("option");
        option.value = section;
        option.text = section;
        sectionSelect.appendChild(option);
    });

    // Update the price since we need to reflect potential changes
    pricePreview();
}
