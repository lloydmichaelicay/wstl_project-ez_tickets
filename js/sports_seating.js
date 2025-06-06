// Section groups for each location
const sectionGroups = {
    "filoil-ringside-a": ["Reserved Seating"],
    "filoil-ringside-b": ["Reserved Seating"],
    "filoil-lower-box": ["Free Seating"],
    //"filoil-lower-boxxx": ["Lowerbox A", "Lowerbox B", "Lowerbox C", "Lowerbox D", "Lowerbox E", "Lowerbox F", "Lowerbox G", "Lowerbox H",],//
    "filoil-upper-box": ["Free Seating"],
 
    "moa-courtside": ["Reserved Seating"],
    "moa-patron": ["201", "202", "207", "216", "221", "222"],
    "moa-lower-box-a": ["203", "204", "205", "206", "217", "218", "219", "220",],
    "moa-lower-box-b": ["203", "204", "205", "206", "217", "218", "219", "220",],
    "moa-upper-box": ["401", "402", "403A", "403B", "404", "405", "406", "407", "408", "409", "416", "417", "418", "419", "420A", "420B", "421", "422"],
    "moa-general-admission": ["Free Seating"], 
 
    "araneta-courtside": ["Reserved Seating"],
    "araneta-patron": ["105", "106", "107", "108", "109", "110", "111", "112", "113","114", "115", "116"],
    "araneta-lower-box-a": ["104A", "104B", "105", "106", "107", "108", "109", "110", "111", "112A", "112B", "113", "114", "115", "116", "117"],
    "araneta-lower-box-b": ["200", "201", "202", "203", "204", "205", "206", "207", "208", "209", "210", "211", "212", "213", "214", "215", "216", "217", "218", "219", "220", "221"],
    "araneta-upper-box": ["400", "401", "401", "402", "403", "404", "405", "406", "407", "408", "409", "410", "411", "412", "413", "414", "415", "416", "417", "418","419", "420", "421", "422", "423"],
    "araneta-gen-ad": ["Free Seating"],

    "psa-courtside": ["Reserved Seating"],
    "psa-patron": ["101", "102", "103", "104"],
    "psa-lower-box": ["201", "202", "203", "204", "205", "206", "207", "208", "209", "210", "211", "212", "213", "214"],
    "psa-upper-box": ["Free Seating"],

    "bleachers": ["Free Seating"],
    "lower-grandstand": ["Free Seating"],
    "upper-grandstand": ["Free Seating"],

    "jpl-hall": ["Reserved Seating"],

    "mini-theater": ["Free Seating"],

    "arc-events": ["Free Seating"],

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