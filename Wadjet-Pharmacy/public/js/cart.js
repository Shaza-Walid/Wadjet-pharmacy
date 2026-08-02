// ============================================================
// cart.js - Shopping Cart Page Logic (Redesigned & Backend Ready)
// ============================================================
// Displays cart items with new card design, calculates total with offers,
// handles quantity updates, checkout redirect, offer progress bar.
// ============================================================

var cart = [];
var OFFER_THRESHOLD = 1000;
var OFFER_PERCENT = 0.20;

function loadCart() {
    var savedCart = localStorage.getItem("wedjedCart");
    if (savedCart) {
        try {
            cart = JSON.parse(savedCart);
        } catch (e) {
            cart = [];
            localStorage.removeItem("wedjedCart");
        }
    }
}

function renderCart() {
    var container = document.getElementById("cartItems");
    if (!container) return;

    container.innerHTML = "";
    var subtotal = 0;

    console.log("Cart items:", cart.length);

    if (cart.length === 0) {
        container.innerHTML = `
            <div class="cart-empty">
                <svg viewBox="0 0 24 24" width="80" height="80" style="stroke: #24B1B1; fill: none; stroke-width: 1.5; margin-bottom: 20px; opacity: 0.5;">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <h3>Your cart is empty</h3>
                <p>Browse our products and add items to your cart</p>
                <a href="/products" class="shop-btn">
                    <svg viewBox="0 0 24 24" width="18" height="18" style="stroke: currentColor; fill: none; stroke-width: 2;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                    Shop Now
                </a>
            </div>
        `;
        updateSummary(0);
        return;
    }

    cart.forEach(function(item, index) {
        // Sync with fresh database data if available
        var freshProduct = products.find(function(p) { return p.product_id === item.product_id; });
        if (freshProduct) {
            item.name = freshProduct.name;
            item.image = freshProduct.image;
            item.unit_price = freshProduct.price;
            
            var finalPrice = freshProduct.price;
            if (freshProduct.has_offer === 1 && freshProduct.offer_value > 0) {
                finalPrice = freshProduct.price - freshProduct.offer_value;
                if (finalPrice < 0) finalPrice = 0;
            }
            item.final_price = finalPrice;
            item.offer_value = freshProduct.offer_value || 0;
        }

        var itemTotal = item.final_price * item.quantity;
        subtotal += itemTotal;

        var originalPriceHtml = "";
        if (item.offer_value > 0) {
            originalPriceHtml = `<span class="original">${item.unit_price} EGP</span>`;
        }

        container.innerHTML += `
            <div class="cart-item">
                <div class="cart-left">
                    <img src="${item.image || "img/placeholder.jpg"}" alt="${item.name}" onerror="this.src='img/placeholder.jpg'">
                    <div class="cart-info">
                        <h3>${item.name}</h3>
                        <p class="cart-category">${item.category}</p>
                        <p class="cart-price">
                            ${item.final_price} EGP ${originalPriceHtml}
                        </p>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(${index}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateQuantity(${index}, 1)">+</button>
                        </div>
                    </div>
                </div>
                <div class="cart-right">
                    <span class="cart-item-total">${itemTotal} EGP</span>
                    <button class="remove-btn" onclick="removeItem(${index})">
                        <svg viewBox="0 0 24 24" width="14" height="14" style="stroke: currentColor; fill: none; stroke-width: 2;"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                        Remove
                    </button>
                </div>
            </div>
        `;
    });

    updateSummary(subtotal);
}

// Update order summary with offer logic
function updateSummary(subtotal) {
    var summarySubtotal = document.getElementById("summarySubtotal");
    var summaryDiscount = document.getElementById("summaryDiscount");
    var summaryTotal = document.getElementById("summaryTotal");
    var discountRow = document.getElementById("discountRow");
    var progressFill = document.getElementById("progressFill");
    var progressText = document.getElementById("progressText");
    var offerProgress = document.getElementById("offerProgress");

    var discount = 0;
    var total = subtotal;

    // Calculate discount if over threshold
    if (subtotal >= OFFER_THRESHOLD) {
        discount = Math.round(subtotal * OFFER_PERCENT);
        total = subtotal - discount;

        if (discountRow) discountRow.style.display = "flex";
        if (summaryDiscount) summaryDiscount.textContent = "-" + discount + " EGP";
        if (progressFill) progressFill.style.width = "100%";
        if (progressText) {
            progressText.innerHTML = "<strong>Congratulations!</strong> You got 20% OFF!";
        }
        if (offerProgress) offerProgress.classList.add("achieved");
    } else {
        if (discountRow) discountRow.style.display = "none";
        var remaining = OFFER_THRESHOLD - subtotal;
        var progressPercent = Math.min((subtotal / OFFER_THRESHOLD) * 100, 100);
        if (progressFill) progressFill.style.width = progressPercent + "%";
        if (progressText) {
            progressText.innerHTML = "Add <strong>" + remaining + " EGP</strong> more to get 20% OFF!";
        }
        if (offerProgress) offerProgress.classList.remove("achieved");
    }

    if (summarySubtotal) summarySubtotal.textContent = subtotal + " EGP";
    if (summaryTotal) summaryTotal.textContent = total + " EGP";
}

// Update quantity with limits
function updateQuantity(index, change) {
    var item = cart[index];
    if (!item) return;

    var product = products.find(function(p) { return p.product_id === item.product_id; });
    var maxQty = product ? product.quantity : 99;

    var newQty = item.quantity + change;

    if (newQty < 1) {
        removeItem(index);
        return;
    }

    if (newQty > maxQty) {
        showToast("Maximum available quantity reached!");
        return;
    }

    item.quantity = newQty;
    localStorage.setItem("wedjedCart", JSON.stringify(cart));
    renderCart();
    updateCartCount();
    showToast(item.name + " quantity updated to " + newQty);
}

function goToCheckout() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    window.location.href = "/checkout";
}

function removeItem(index) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this item from your cart?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#bdc3c7',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var itemName = cart[index].name;
            cart.splice(index, 1);
            localStorage.setItem("wedjedCart", JSON.stringify(cart));
            renderCart();
            updateCartCount();
            
            Swal.fire({
                title: 'Removed!',
                text: itemName + ' has been removed from your cart.',
                icon: 'success',
                confirmButtonColor: '#24B1B1',
                timer: 2000
            });
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    renderCart();
});

function clearCart() {
    if (cart.length === 0) {
        showToast("Your cart is already empty!");
        return;
    }
    
    Swal.fire({
        title: 'Clear entire cart?',
        text: "Are you sure you want to remove all items from your cart?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#bdc3c7',
        confirmButtonText: 'Yes, clear it!'
    }).then((result) => {
        if (result.isConfirmed) {
            cart = [];
            localStorage.setItem("wedjedCart", JSON.stringify(cart));
            renderCart();
            updateCartCount();
            
            Swal.fire({
                title: 'Cleared!',
                text: 'Your cart has been emptied.',
                icon: 'success',
                confirmButtonColor: '#24B1B1',
                timer: 2000
            });
        }
    });
}