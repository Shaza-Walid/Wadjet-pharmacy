// ============================================================
// checkout.js - Checkout Page Logic (Complete & Backend Ready)
// ============================================================

document.addEventListener('DOMContentLoaded', function() {

// Load cart from localStorage
var cart = JSON.parse(localStorage.getItem("wedjedCart")) || [];

// Calculate total with offer discounts
var total = 0;
var subtotal = 0;
cart.forEach(function(item) {
    subtotal += (item.final_price || item.price || 0) * (item.quantity || 1);
});

// Apply 20% discount if over 1000 EGP
var discount = 0;
if (subtotal >= 1000) {
    discount = Math.round(subtotal * 0.20);
}
total = subtotal - discount;

// Display total
var checkoutTotalEl = document.getElementById("checkoutTotal");
if (checkoutTotalEl) {
    checkoutTotalEl.innerHTML = total + " EGP";
    if (discount > 0) {
        checkoutTotalEl.innerHTML += ' <span style="color:#27ae60;font-size:0.9rem;">(20% OFF applied!)</span>';
    }
}

// Handle order submission
var checkoutForm = document.getElementById("checkoutForm");
if (checkoutForm) {
    checkoutForm.addEventListener("submit", function(event) {
        event.preventDefault();

        var customerNameInput = document.getElementById("customerName");
        var customerPhoneInput = document.getElementById("customerPhone");
        var customerAddressInput = document.getElementById("customerAddress");
        var notesInput = document.getElementById("orderNotes");

        if (!customerNameInput || !customerPhoneInput || !customerAddressInput) {
            alert("Form elements not found. Please refresh the page.");
            return;
        }

        var customerName = customerNameInput.value.trim();
        var customerPhone = customerPhoneInput.value.trim();
        var customerAddress = customerAddressInput.value.trim();
        var notes = notesInput ? notesInput.value.trim() : "";

        // Validate
        if (!customerName || !customerPhone || !customerAddress) {
            alert("Please fill in all required fields.");
            return;
        }

        // Validate phone (Egyptian format)
        var phoneRegex = /^01[0-2,5]{1}[0-9]{8}$/;
        if (!phoneRegex.test(customerPhone)) {
            alert("Please enter a valid Egyptian phone number (e.g., 01012345678).");
            return;
        }

        // Create order object to send to backend
        var orderData = {
            customer_name: customerName,
            phone: customerPhone,
            address: customerAddress,
            notes: notes,
            items: cart.map(function(item) {
                return {
                    product_id: item.product_id,
                    quantity: item.quantity || 1
                };
            })
        };

        // Submit to Laravel backend via fetch
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear cart
                localStorage.removeItem("wedjedCart");
                // Redirect to dashboard with success message
                window.location.href = '/dashboard';
            } else {
                alert("Error placing order: " + (data.message || "Unknown error"));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while placing the order.");
        });
    });
}

}); // end DOMContentLoaded