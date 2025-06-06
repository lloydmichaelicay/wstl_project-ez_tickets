// Section groups for each location
const sectionGroups = {
    "disney-front-row": ["Reserved Seating"],
    "disney-svip": ["101", "122"],
    "disney-vip": ["104", "105", "106", "107", "116", "117", "118", "119"],
    "disney-lb-center": ["201", "202", "203", "220", "221", "222"],
    "disney-lb-premium": ["204", "205", "206", "207", "216", "217", "218", "219"],
    "disney-lb-regular": ["203", "204", "205", "206", "207", "216", "217", "218", "219", "220"],
    "disney-ub-center": ["401", "402", "403A", "403B", "404", "405", "406", "407", "408", "409", "416", "417", "418", "419", "420A", "420B", "421", "422"],
    "disney-ub-regular": ["401", "402", "403A", "403B", "420A", "420B", "421", "422"],
    "disney-general-admission": ["501", "502", "503A", "503B", "504", "505", "506", "517", "518", "519", "520A", "520B", "521", "522"],
       
    "jepoy-orch-left": ["Row A", "Row B", "Row C", "Row D", "Row E"],
    "jepoy-orch-center": ["Reserved Seating"],
    "jepoy-orch-right": ["Row A", "Row B", "Row C", "Row D", "Row E"], 
 
    "peta-vip": ["GA", "GB", "GC", "GD", "GE"],
    "peta-orchestra-center": ["OC A", "OC B", "OC C", "OC D", "OC E"],
    "peta-orchestra-side": ["OS A", "OS B", "OS C", "OS D", "OS E"],
    "peta-balcony-center": ["2C A", "2C B", "2C C", "2C D", "2C E"],
    "peta-balcony-side": ["2S A", "2S B", "2S C", "2S D", "2S E"],

    "section-l": ["Row A", "Row B", "Row C"],
    "section-c": ["Row A", "Row B", "Row C", "Row D"],
    "section-r": ["Row A", "Row B", "Row C"],

    "orchestra-center": ["Row A", "Row B", "Row C", "Row D", "Row E", "Row F", "Row G", "Row H", "Row I", "Row J", "Row K", "Row L", "Row M", "Row N", "Row O", "Row P", "Row Q"],
    "orchestra-side": ["Row R", "Row S", "Row T", "Row U", "Row V"],
    "lodge": ["Row A", "Row B", "Row C", "Row D", "Row E", "Row F", "Row G"],
    "balcony-1": ["Row A", "Row B", "Row C", "Row D", "Row E", "Row F"],
    "balcony-2": ["Row G", "Row H", "Row I", "Row J", "Row K", "Row L", "Row M", "Row N"],

    "jokoy-floor-seating": ["Reserved Seating"],
    "jokoy-patron": ["104", "105", "106", "107", "116", "117", "118", "119"],
    "jokoy-lba-premium": ["206", "207", "216", "217"],
    "jokoy-patron-center": ["101", "122"],
    "jokoy-lba-regular": ["201", "202", "203", "204", "205", "218", "219", "220", "221", "222"],
    "jokoy-lbb-premium": ["206", "207", "216", "217"],
    "jokoy-lbb-regular": ["203", "204", "205", "218", "219", "220"],
    "jokoy-ub-premium": ["406", "407", "416", "417"],
    "jokoy-ub-regular": ["401", "402", "403A", "403B", "404", "405", "418", "419", "420A", "420B", "421", "422"],
    "jokoy-general-admission": ["501", "502", "503A", "503B", "504", "505", "506", "517", "518", "519", "520A", "520B", "521", "522"],

    "jpl-hall": ["Reserved Seating"],

    "mini-theater": ["Reserved Seating"],

    "arc-events": ["Free Seating"],

    "marriott-gold": ["Reserved Seating"],
    "marriott-silver": ["Reserved Seating"]

    
};
 

// Initialize the price and sections when the page loads
window.onload = function() {
    filterSections();
    updatePrice();
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
    defaultOption.text = "Select options";
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
