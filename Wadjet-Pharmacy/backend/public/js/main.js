// ============================================================
// main.js - Core Application Logic (Complete & Backend Ready)
// ============================================================
// Contains: Cart, Search, Filter, Display, Admin, Dashboard
// All text in English for backend compatibility.
// Uses: var, function declarations, getElementById, inline onclick
// Compatible with DB Schema: products, orders, availability_requests
// ============================================================

var cart = [];
var currentCategory = "all";
var currentProductForRequest = null;
var currentEditingProduct = null;

// ============================================
// localStorage - Cart & Admin persistence
// ============================================

function loadCart() {
    var savedCart = localStorage.getItem("wedjedCart");
    if (savedCart) {
        try {
            cart = JSON.parse(savedCart);
            updateCartCount();
        } catch (e) {
            cart = [];
            localStorage.removeItem("wedjedCart");
        }
    }
}

function saveCart() {
    localStorage.setItem("wedjedCart", JSON.stringify(cart));
}

function updateCartCount() {
    var countElement = document.getElementById("cartCount");
    if (countElement) {
        var totalQty = 0;
        for (var i = 0; i < cart.length; i++) {
            totalQty += cart[i].quantity || 1;
        }
        countElement.textContent = totalQty;
    }
}

// ============================================
// User Authentication
// ============================================
function isUserLoggedIn() {
    return localStorage.getItem("wedjedUser") !== null;
}

function getUserEmail() {
    return localStorage.getItem("wedjedUser") || "";
}

function logoutUser() {
    localStorage.removeItem("wedjedUser");
    localStorage.removeItem("wedjedCustomerId");
    localStorage.removeItem("wedjedCustomerName");
    localStorage.removeItem("wedjedCustomerPhone");
    localStorage.removeItem("wedjedCustomerAddress");
    window.location.href = "/";
}

// ============================================
// Admin Authentication
// ============================================
function isAdminLoggedIn() {
    return localStorage.getItem("wedjedAdmin") === "true";
}

function loginAdmin(username, password) {
    var admin = adminUsers.find(function(a) {
        return a.name === username && a.password === password;
    });
    if (admin) {
        localStorage.setItem("wedjedAdmin", "true");
        localStorage.setItem("wedjedAdminName", admin.name);
        localStorage.setItem("wedjedAdminId", admin.id);
        return true;
    }
    return false;
}

function logoutAdmin() {
    localStorage.removeItem("wedjedAdmin");
    localStorage.removeItem("wedjedAdminName");
    localStorage.removeItem("wedjedAdminId");
    localStorage.removeItem("wedjedAdminToken");
    window.location.href = "/";
}

function getAdminName() {
    return localStorage.getItem("wedjedAdminName") || "Admin";
}

function getAdminId() {
    return parseInt(localStorage.getItem("wedjedAdminId")) || 1;
}

// ============================================
// Highlight search text in product names
// ============================================
function highlightText(text, query) {
    if (!query || query.trim() === "") return text;
    var regex = new RegExp("(" + query.replace(/[.*+?^${}()|[\]\\]/g, "\\$&") + ")", "gi");
    return text.replace(regex, '<span class="search-highlight">$1</span>');
}

// ============================================
// renderProducts: Display products grid
// Uses product_id (matches DB schema)
// ============================================
// console.log(document.getElementById(gridId));
function renderProducts(list, gridId, titleId, titleText, searchQuery) {
    var grid = document.getElementById(gridId);
    var title = titleId ? document.getElementById(titleId) : null;

    if (title && titleText) {
        title.textContent = titleText;
    }

    if (!grid) return;

    if (list.length === 0) {
        grid.innerHTML = `
            <div class="no-results" style="grid-column: 1 / -1;">
                <svg viewBox="0 0 24 24" width="80" height="80"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <h3>No Results Found</h3>
                <p>Try searching with different keywords</p>
            </div>
        `;
        return;
    }

    var html = "";
    var isAdmin = isAdminLoggedIn();

    list.forEach(function(product) {
        var btnHtml = "";
        var adminBtns = "";
        var offerBadge = "";
        var priceDisplay = "";

        // Calculate final price with offer
        var finalPrice = product.price;
        if (product.has_offer === 1 && product.offer_value > 0) {
            finalPrice = product.price - product.offer_value;
            if (finalPrice < 0) finalPrice = 0;
        }

        // Show offer badge
        if (product.has_offer === 1) {
            offerBadge = '<span class="offer-badge">Special Offer</span>';
        }

        // Price display
        if (product.has_offer === 1 && product.offer_value > 0) {
            priceDisplay = `
                <div class="product-price">
                    <span style="text-decoration: line-through; color: #999; font-size: 0.9rem;">${product.price}</span>
                    <span style="color: #24B1B1; font-weight: bold;">${finalPrice}</span>
                    <span>EGP</span>
                </div>
            `;
        } else {
            priceDisplay = `<div class="product-price">${product.price} <span>EGP</span></div>`;
        }

        if (isAdmin) {
            // Admin buttons: Edit + Delete
            adminBtns = `
                <div class="admin-card-btns">
                    <button class="admin-btn edit-btn" onclick="openEditModal(${product.product_id})">
                        <svg viewBox="0 0 24 24" width="16" height="16"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit
                    </button>
                    <button class="admin-btn delete-btn" onclick="deleteProduct(${product.product_id})">
                        <svg viewBox="0 0 24 24" width="16" height="16"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                        Delete
                    </button>
                </div>
            `;
        } else {
       if (product.status === "available" && product.quantity > 0) {

    btnHtml = `
    <button class="product-btn add-to-cart" onclick="event.stopPropagation(); addToCart(${product.product_id})">
        <svg viewBox="0 0 24 24" width="20" height="20">
            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        Add to Cart
    </button>`;
    
} else {

    btnHtml = `
    <button class="product-btn request-stock" onclick="event.stopPropagation(); openRequestModal(${product.product_id})">
        Request Stock
    </button>`;

}
    }

        html += `
<div class="product-card"
     onclick="window.location='/products?id=${product.product_id}'">
                     <div class="product-image">
                    ${offerBadge}
                    <img src="${product.image || "img/placeholder.jpg"}" alt="${product.name}" loading="lazy" onerror="this.src='img/placeholder.jpg'">
                    <span class="status-badge ${product.status}">${product.status === "available" ? "Available" : "Out of Stock"}</span>
                </div>
                <div class="product-info">
                    <div class="product-category">${getCategoryName(product.category_id)}</div>
                    <h3 class="product-name">${highlightText(product.name, searchQuery)}</h3>
                    ${priceDisplay}
                    ${btnHtml}
                    ${adminBtns}
                </div>
            </div>
        `;
    });

    grid.innerHTML = html;
}

// ============================================
// Helper: Get category name by ID
// ============================================
function getCategoryName(categoryId) {
    var cat = categories.find(function(c) { return c.category_id === categoryId; });
    return cat ? cat.name : "Unknown";
}

// ============================================
// renderOffers: Display special offers
// ============================================
function renderOffers() {
    var offers = products.filter(function(product) {
        return product.has_offer === 1;
    });
    renderProducts(offers, "offersGrid", null, null);
}

// ============================================
function goToProductsSearch(event) {

    if (event.key === "Enter") {

        var value = document.getElementById("searchInput").value.trim();

        if (value !== "") {
            window.location.href = "/products?search=" + encodeURIComponent(value);
        } else {
            window.location.href = "/products";
        }
    }

}
// initSearch: Live search with instant filtering & highlighting
// ============================================
function initSearch(inputId) {

    var searchInput = document.getElementById(inputId);
    var searchGrid = document.getElementById("searchResults");
    var productsSection = document.querySelector(".products-section");

    if (!searchInput || !searchGrid) return;

    searchInput.addEventListener("input", function (e) {

        var query = e.target.value.toLowerCase().trim();

        if (query === "") {
            searchGrid.style.display = "none";
            searchGrid.innerHTML = "";
            productsSection.style.display = "block";
            return;
        }

        var filtered = products.filter(function (p) {
            return p.name.toLowerCase().includes(query);
        });

        searchGrid.style.display = "grid";
        productsSection.style.display = "none";

        renderProducts(filtered, "searchResults", null, null, query);
    });
}
// ============================================
// initFilters: Category filter buttons
// ============================================
function initFilters(categoriesGridId, productsGridId, productsTitleId) {
    var categoriesGrid = document.getElementById(categoriesGridId);
    if (!categoriesGrid) return;

    var html = "";

    categoriesList.forEach(function(cat) {
        if (cat.name === "All") {
            html += `
            <div class="category-card active"
                 onclick="showAllProducts(this)">
                <img src="${cat.image}" alt="${cat.name}">
                <div class="category-overlay">
                    <h3>${cat.name}</h3>
                </div>
            </div>
            `;
        } else {
            html += `
            <div class="category-card"
                 onclick="filterByCategory('${cat.name}','${categoriesGridId}','${productsGridId}','${productsTitleId}',this)">
                <img src="${cat.image}" alt="${cat.name}">
                <div class="category-overlay">
                    <h3>${cat.name}</h3>
                </div>
            </div>
            `;
        }
    });

    categoriesGrid.innerHTML = html;
}

// ============================================
// Filter by category
// ============================================
function filterByCategory(categoryName, categoriesGridId, productsGridId, productsTitleId, element) {
    var allCards = document.querySelectorAll(".category-card");
    for (var i = 0; i < allCards.length; i++) {
        allCards[i].classList.remove("active");
    }

    if (element) {
        element.classList.add("active");
    }

    var filtered = products.filter(function(product) {
        var catName = getCategoryName(product.category_id);
        return catName === categoryName;
    });

    console.log("Category:", categoryName);
    console.log("Filtered:", filtered.length, "products");

    renderProducts(filtered, productsGridId, productsTitleId, categoryName, "");
}

function showAllProducts(element) {
    var allCards = document.querySelectorAll(".category-card");
    for (var i = 0; i < allCards.length; i++) {
        allCards[i].classList.remove("active");
    }
    if (element) {
        element.classList.add("active");
    }
    var title = document.getElementById("productsTitle");
    if (title) title.style.display = "block";
    renderProducts(products, "productsGrid", "productsTitle", "All Products", "");
}

// ============================================
// Request Stock Modal
// ============================================
function openRequestModal(productId) {
    var product = products.find(function(p) { return p.product_id === productId; });
    if (!product) return;

    currentProductForRequest = product;
    var modalName = document.getElementById("modalProductName");
    if (modalName) {
        modalName.textContent = "Product: " + product.name + " - We will notify you when available";
    }
    var modal = document.getElementById("requestModal");
    if (modal) {
        modal.classList.add("show");
        document.body.style.overflow = "hidden";
    }
}

function closeModal() {
    var modal = document.getElementById("requestModal");
    if (modal) {
        modal.classList.remove("show");
        document.body.style.overflow = "";
    }
    currentProductForRequest = null;
}

document.addEventListener("click", function(e) {
    var modal = document.getElementById("requestModal");
    if (e.target === modal) {
        closeModal();
    }
});

// ============================================
// Cart - with localStorage & Quantity
// ============================================
function addToCart(productId) {
    var product = products.find(function(p) { return p.product_id === productId; });
    if (!product) return;

    if (product.status !== "available" || product.quantity <= 0) {
        showToast("This product is out of stock!");
        return;
    }

    // Check if already in cart
    var existingItem = cart.find(function(item) {
        return item.product_id === productId;
    });

    if (existingItem) {
        if (existingItem.quantity >= product.quantity) {
            showToast("Maximum available quantity reached!");
            return;
        }
        existingItem.quantity += 1;
        showToast(product.name + " quantity updated! (" + existingItem.quantity + ")");
    } else {
        var finalPrice = product.price;
        if (product.has_offer === 1 && product.offer_value > 0) {
            finalPrice = product.price - product.offer_value;
            if (finalPrice < 0) finalPrice = 0;
        }

        cart.push({
            product_id: product.product_id,
            name: product.name,
            category: getCategoryName(product.category_id),
            image: product.image,
            quantity: 1,
            unit_price: product.price,
            offer_value: product.offer_value || 0,
            final_price: finalPrice
        });
        showToast(product.name + " added to cart!");
    }

    saveCart();
    updateCartCount();
}

function showCart() {
    window.location.href = "/cart";
}

// ============================================
// Toast Notification
// ============================================
function showToast(message) {
    var toast = document.getElementById("toast");
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add("show");
    setTimeout(function() {
        toast.classList.remove("show");
    }, 3000);
}

// ============================================
// Focus search input
// ============================================
function focusSearch() {
    var input = document.getElementById("searchInput");
    if (input) {
        input.focus();
        input.scrollIntoView({ behavior: "smooth", block: "center" });
    }
}

// ============================================
// Submit stock request
// Matches DB schema: availability_requests table
// ============================================
function handleRequestSubmit(event) {
    event.preventDefault();

    var nameInput = document.getElementById("reqName");
    var phoneInput = document.getElementById("reqPhone");
    var addressInput = document.getElementById("reqAddress");
    var notesInput = document.getElementById("reqNotes");

    if (!currentProductForRequest) {
        closeModal();
        return;
    }

    var requestData = {
        request_id: getNextId(availabilityRequests, "request_id"),
        product_id: currentProductForRequest.product_id,
        product_name: currentProductForRequest.name,
        customer_name: nameInput ? nameInput.value.trim() : "",
        phone: phoneInput ? phoneInput.value.trim() : "",
        address: addressInput ? addressInput.value.trim() : "",
        notes: notesInput ? notesInput.value.trim() : "",
        status: "pending",
        pending: 1,
        cancelled: 0,
        created_at: getCurrentDateTime()
    };

    // Save to availabilityRequests array
    availabilityRequests.push(requestData);

    // Save to localStorage for persistence
    localStorage.setItem("wedjedAvailabilityRequests", JSON.stringify(availabilityRequests));

    // TODO: Send to backend API
    // apiCreateAvailabilityRequest(requestData, function(response) {
    //     console.log("Request created:", response);
    // });

    console.log("Stock Request saved:", requestData);
    showToast("Request for " + currentProductForRequest.name + " sent successfully!");

    closeModal();
    event.target.reset();
}

// ============================================
// Submit contact form
// ============================================
function handleContactSubmit(event) {
    event.preventDefault();
    // TODO: Send to backend API
    // apiSendContact(formData, function(response) { ... });
    showToast("Your message has been sent successfully! We will contact you soon.");
    event.target.reset();
}

// ============================================
// Admin Login
// ============================================
function handleAdminLogin(event) {
    event.preventDefault();
    var usernameInput = document.getElementById("adminUsername");
    var passwordInput = document.getElementById("adminPassword");

    if (!usernameInput || !passwordInput) return;

    var username = usernameInput.value.trim();
    var password = passwordInput.value;

    if (loginAdmin(username, password)) {
        showToast("Welcome back, " + getAdminName() + "!");
        setTimeout(function() {
            window.location.href = "/dashboard";
        }, 1000);
    } else {
        showToast("Invalid username or password!");
    }
}

// ============================================
// Admin CRUD Operations
// ============================================

// Delete product
function deleteProduct(productId) {
    if (!confirm("Are you sure you want to delete this product?")) return;

    var index = products.findIndex(function(p) { return p.product_id === productId; });
    if (index > -1) {
        var name = products[index].name;
        products.splice(index, 1);
        showToast(name + " deleted successfully!");

        renderProducts(products, "productsGrid", "productsTitle", "All Products", "");

        var dashGrid = document.getElementById("dashboardProductsGrid");
        if (dashGrid) {
            renderProducts(products, "dashboardProductsGrid", null, null);
        }

        updateDashboardStats();
    }
}

// Open edit modal
function openEditModal(productId) {
    var product = products.find(function(p) { return p.product_id === productId; });
    if (!product) return;

    currentEditingProduct = product;

    var editId = document.getElementById("editId");
    var editName = document.getElementById("editName");
    var editCategory = document.getElementById("editCategory");
    var editPrice = document.getElementById("editPrice");
    var editQuantity = document.getElementById("editQuantity");
    var editStatus = document.getElementById("editStatus");
    var editImg = document.getElementById("editImg");
    var editModal = document.getElementById("editModal");

    if (editId) editId.value = product.product_id;
    if (editName) editName.value = product.name;
    if (editCategory) editCategory.value = getCategoryName(product.category_id);
    if (editPrice) editPrice.value = product.price;
    if (editQuantity) editQuantity.value = product.quantity;
    if (editStatus) editStatus.value = product.status;
    if (editImg) editImg.value = product.image || "";

    if (editModal) {
        editModal.classList.add("show");
        document.body.style.overflow = "hidden";
    }
}

function closeEditModal() {
    var editModal = document.getElementById("editModal");
    if (editModal) {
        editModal.classList.remove("show");
        document.body.style.overflow = "";
    }
    currentEditingProduct = null;
}

// Save edit - updates DB fields correctly
function handleEditSubmit(event) {
    event.preventDefault();
    if (!currentEditingProduct) return;

    var editName = document.getElementById("editName");
    var editCategory = document.getElementById("editCategory");
    var editPrice = document.getElementById("editPrice");
    var editQuantity = document.getElementById("editQuantity");
    var editStatus = document.getElementById("editStatus");
    var editImg = document.getElementById("editImg");

    if (editName) currentEditingProduct.name = editName.value.trim();
    if (editCategory) {
        var catObj = categories.find(function(c) { return c.name === editCategory.value; });
        currentEditingProduct.category_id = catObj ? catObj.category_id : 1;
    }
    if (editPrice) currentEditingProduct.price = parseFloat(editPrice.value);
    if (editQuantity) currentEditingProduct.quantity = parseInt(editQuantity.value);
    if (editStatus) currentEditingProduct.status = editStatus.value;
    if (editImg) {
        currentEditingProduct.image = editImg.value.trim();
    }

    // Auto-update status based on quantity
    updateProductStatus(currentEditingProduct);

    showToast(currentEditingProduct.name + " updated successfully!");
    closeEditModal();
    renderProducts(products, "productsGrid", "productsTitle", "All Products", "");

    var dashGrid = document.getElementById("dashboardProductsGrid");
    if (dashGrid) {
        renderProducts(products, "dashboardProductsGrid", null, null);
    }

    updateDashboardStats();
}

// Add new product - includes all required DB fields
function handleAddProduct(event) {
    event.preventDefault();

    var addName = document.getElementById("addName");
    var addCategory = document.getElementById("addCategory");
    var addPrice = document.getElementById("addPrice");
    var addQuantity = document.getElementById("addQuantity");
    var addStatus = document.getElementById("addStatus");
    var addImg = document.getElementById("addImg");

    if (!addName || !addCategory || !addPrice || !addQuantity || !addStatus) return;

    var categoryName = addCategory.value;
    var categoryObj = categories.find(function(c) { return c.name === categoryName; });
    var categoryId = categoryObj ? categoryObj.category_id : 1;

    var newProductId = getNextId(products, "product_id");

    var newProduct = {
        product_id: newProductId,
        category_id: categoryId,
        name: addName.value.trim(),
        description: "",
        image: addImg ? (addImg.value.trim() || "img/placeholder.jpg") : "img/placeholder.jpg",
        price: parseFloat(addPrice.value),
        quantity: parseInt(addQuantity.value),
        status: addStatus.value,
        has_offer: 0,
        offer_value: 0.00,
        created_at: getCurrentDateTime(),
        updated_at: getCurrentDateTime()
    };

    // Auto-update status based on quantity
    updateProductStatus(newProduct);

    products.push(newProduct);
    showToast(newProduct.name + " added successfully!");
    event.target.reset();

    var grid = document.getElementById("productsGrid");
    if (grid) {
        renderProducts(products, "productsGrid", "productsTitle", "All Products", "");
    }

    updateDashboardStats();
}

// Add new admin
function handleAddAdmin(event) {
    event.preventDefault();

    var newAdminName = document.getElementById("newAdminName");
    var newAdminEmail = document.getElementById("newAdminEmail");
    var newAdminPassword = document.getElementById("newAdminPassword");

    if (!newAdminName || !newAdminEmail || !newAdminPassword) return;

    var newAdminId = getNextId(adminUsers, "id");

    var newAdmin = {
        id: newAdminId,
        name: newAdminName.value.trim(),
        email: newAdminEmail.value.trim(),
        password: newAdminPassword.value,
        created_at: getCurrentDateTime(),
        updated_at: getCurrentDateTime()
    };

    adminUsers.push(newAdmin);
    showToast("Admin " + newAdmin.name + " added successfully!");
    event.target.reset();
    renderAdminsList();
}

// Render admins list
function renderAdminsList() {
    var container = document.getElementById("adminsList");
    if (!container) return;

    var html = "";
    adminUsers.forEach(function(admin, index) {
        html += `
            <div class="admin-list-item">
                <span>${admin.name} (${admin.email})</span>
                ${index > 0 ? '<button class="admin-btn delete-btn" onclick="deleteAdmin(' + index + ')">Delete</button>' : '<span style="color: #24B1B1;">(Main Admin)</span>'}
            </div>
        `;
    });
    container.innerHTML = html;
}

function deleteAdmin(index) {
    if (!confirm("Are you sure you want to delete this admin?")) return;
    var name = adminUsers[index].name;
    adminUsers.splice(index, 1);
    showToast("Admin " + name + " deleted");
    renderAdminsList();
}

// ============================================
// Update Dashboard Statistics
// ============================================
function updateDashboardStats() {
    var statProducts = document.getElementById("statProducts");
    var statOrders = document.getElementById("statOrders");
    var statRequests = document.getElementById("statRequests");
    var statAvailable = document.getElementById("statAvailable");

    if (statProducts) statProducts.textContent = products.length;
    if (statOrders) statOrders.textContent = orders.length;
    if (statRequests) statRequests.textContent = availabilityRequests.length;
    if (statAvailable) {
        var availableCount = 0;
        for (var i = 0; i < products.length; i++) {
            if (products[i].status === "available") availableCount++;
        }
        statAvailable.textContent = availableCount;
    }
}

// ============================================
// Render Orders in Dashboard
// Matches DB: orders table (pending, delivered, cancelled)
// pending: default 0, admin hits delivered → pending=1
// cancelled: default 0, admin hits rejected → cancelled=1
// ============================================
function renderOrders() {
    // Load orders from localStorage
    var savedOrders = localStorage.getItem("orders");
    if (savedOrders) {
        try {
            var parsed = JSON.parse(savedOrders);
            parsed.forEach(function(newOrder) {
                var exists = orders.find(function(o) { return o.order_id === newOrder.order_id; });
                if (!exists) {
                    orders.push(newOrder);
                }
            });
        } catch (e) {
            console.log("Error loading orders from localStorage");
        }
    }

    var container = document.getElementById("ordersList");
    if (!container) return;

    if (orders.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #666;">No orders yet</p>';
        return;
    }

    var html = "";

    orders.forEach(function(order) {
        var statusClass = order.status === "pending" ? "status-pending" :
                         (order.status === "delivered" ? "status-delivered" : "status-cancelled");

        var statusText = order.status === "pending" ? "Pending" :
                        (order.status === "delivered" ? "Delivered" : "Cancelled");

        html += `
            <div class="order-card ${statusClass}">
                <div class="order-header">
                    <span class="order-id">#${order.order_id}</span>
                    <span class="order-status ${statusClass}">${statusText}</span>
                </div>
                <div class="order-details">
                    <p><strong>Customer:</strong> ${order.customer_name || "N/A"}</p>
                    <p><strong>Phone:</strong> ${order.phone || "N/A"}</p>
                    <p><strong>Address:</strong> ${order.address || "N/A"}</p>
                    <p><strong>Notes:</strong> ${order.notes || "N/A"}</p>
                    <p><strong>Date:</strong> ${order.created_at}</p>
                </div>
                ${order.status === "pending" ? `
                <div class="order-actions">
                    <button class="order-btn deliver-btn" onclick="updateOrderStatus(${order.order_id},'delivered')">
                        Mark Delivered
                    </button>
                    <button class="order-btn cancel-btn" onclick="updateOrderStatus(${order.order_id},'cancelled')">
                        Cancel
                    </button>
                </div>` : ""}
            </div>
        `;
    });

    container.innerHTML = html;
}

function updateOrderStatus(orderId, newStatus) {
    var order = orders.find(function(o) { return o.order_id === orderId; });
    if (order) {
        order.status = newStatus;
        // pending: default 0, admin hits delivered → pending=1
        // cancelled: default 0, admin hits rejected → cancelled=1
        order.pending = newStatus === "delivered" ? 1 : (newStatus === "pending" ? 1 : 0);
        order.cancelled = newStatus === "cancelled" ? 1 : 0;

        localStorage.setItem("orders", JSON.stringify(orders));

        var msg = newStatus === "delivered" ? "Order marked as delivered" : "Order cancelled";
        showToast(msg);
        renderOrders();
        updateDashboardStats();
    }
}

// ============================================
// Render Availability Requests in Dashboard
// Matches DB: availability_requests table
// ============================================
function renderAvailabilityRequests() {
    // Load from localStorage
    var savedRequests = localStorage.getItem("wedjedAvailabilityRequests");
    if (savedRequests) {
        try {
            var parsed = JSON.parse(savedRequests);
            parsed.forEach(function(newReq) {
                var exists = availabilityRequests.find(function(r) { return r.request_id === newReq.request_id; });
                if (!exists) {
                    availabilityRequests.push(newReq);
                }
            });
        } catch (e) {
            console.log("Error loading availability requests from localStorage");
        }
    }

    var container = document.getElementById("requestsList");
    if (!container) return;

    if (availabilityRequests.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #666;">No availability requests</p>';
        return;
    }

    var html = "";
    availabilityRequests.forEach(function(req) {
        var statusClass = req.status === "pending" ? "status-pending" : "status-delivered";
        var statusText = req.status === "pending" ? "Pending" : "Fulfilled";

        html += `
            <div class="order-card ${statusClass}">
                <div class="order-header">
                    <span class="order-id">#${req.request_id}</span>
                    <span class="order-status ${statusClass}">${statusText}</span>
                </div>
                <div class="order-details">
                    <p><strong>Product:</strong> ${req.product_name || "N/A"}</p>
                    <p><strong>Customer:</strong> ${req.customer_name || "N/A"}</p>
                    <p><strong>Phone:</strong> ${req.phone || "N/A"}</p>
                    <p><strong>Address:</strong> ${req.address || "N/A"}</p>
                    <p><strong>Notes:</strong> ${req.notes || "N/A"}</p>
                    <p><strong>Date:</strong> ${req.created_at}</p>
                </div>
                ${req.status === "pending" ? `
                <div class="order-actions">
                    <button class="order-btn deliver-btn" onclick="updateAvailabilityRequestStatus(${req.request_id},'fulfilled')">
                        <svg viewBox="0 0 24 24" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
                        Mark Fulfilled
                    </button>
                </div>` : ""}
            </div>
        `;
    });

    container.innerHTML = html;
}

function updateAvailabilityRequestStatus(reqId, newStatus) {
    var req = availabilityRequests.find(function(r) { return r.request_id === reqId; });
    if (req) {
        req.status = newStatus;
        req.pending = newStatus === "pending" ? 1 : 0;

        localStorage.setItem("wedjedAvailabilityRequests", JSON.stringify(availabilityRequests));

        showToast("Request #" + req.request_id + " marked as fulfilled");
        renderAvailabilityRequests();
        updateDashboardStats();
    }
}

// ============================================
// Hero Slider Auto-rotation
// ============================================
window.addEventListener("DOMContentLoaded", function () {

    var slides = document.querySelectorAll(".slider img");

    if (slides.length === 0) return;

    var current = 0;

    setInterval(function () {
        slides[current].classList.remove("active");

        current = (current + 1) % slides.length;

        slides[current].classList.add("active");
    }, 3000);

});
// ============================================
// Render Customers List in Dashboard
// ============================================
function renderCustomersList() {
    var tbody = document.getElementById("customersTableBody");
    var statsContainer = document.getElementById("customersStats");
    if (!tbody) return;

    // Load customers from localStorage (registered users)
    var savedCustomers = JSON.parse(localStorage.getItem("wedjedCustomers")) || [];
    var allCustomers = customers.concat(savedCustomers);

    // Remove duplicates by customer_id
    var uniqueCustomers = [];
    var seenIds = {};
    allCustomers.forEach(function(c) {
        if (!seenIds[c.customer_id]) {
            seenIds[c.customer_id] = true;
            uniqueCustomers.push(c);
        }
    });

    if (uniqueCustomers.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="no-customers">
                    <svg viewBox="0 0 24 24" width="60" height="60"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    <h3>No customers yet</h3>
                    <p>Customers will appear here when they register</p>
                </td>
            </tr>
        `;
        if (statsContainer) statsContainer.innerHTML = "";
        return;
    }

    var html = "";
    uniqueCustomers.forEach(function(customer) {
        html += `
            <tr>
                <td>#${customer.customer_id}</td>
                <td>${customer.name}</td>
                <td>${customer.phone}</td>
                <td>${customer.address || "N/A"}</td>
                <td>${customer.created_at ? customer.created_at.split(" ")[0] : "N/A"}</td>
            </tr>
        `;
    });

    tbody.innerHTML = html;

    // Stats
    if (statsContainer) {
        statsContainer.innerHTML = `
            <div class="customer-stat-card">
                <h4>${uniqueCustomers.length}</h4>
                <p>Total Customers</p>
            </div>
            <div class="customer-stat-card">
                <h4>${uniqueCustomers.filter(function(c) { return c.created_at && c.created_at.includes("2026-07"); }).length}</h4>
                <p>New This Month</p>
            </div>
        `;
    }
}

// ============================================
// Console log
// ============================================
console.log("=== main.js loaded (Complete & Backend Ready) ===");
console.log("Total Products:", products.length);
console.log("Categories:", categoriesList.map(function(c) { return c.name; }));
console.log("App Status: Ready for Backend Integration!");
////////////////////////////////
initSearch("searchInput", "productsGrid", "productsTitle");
//////////////////////////////////////////
window.addEventListener("DOMContentLoaded", function () {

    var params = new URLSearchParams(window.location.search);

    var search = params.get("search");

    if (search) {

        var input = document.getElementById("searchInput");

        if (input) {
            input.value = search;
        }

        var filtered = products.filter(function (p) {

            return p.name.toLowerCase().includes(search.toLowerCase()) ||
                   getCategoryName(p.category_id).toLowerCase().includes(search.toLowerCase());

        });

        renderProducts(filtered, "productsGrid", "productsTitle", "Search Results", search);

    }

});
////////////////////////////////
// ============================================
// Hero Slider
// ============================================

function initSlider() {
    const slides = document.querySelectorAll(".slider img");

    if (slides.length === 0) return;

    let current = 0;

    setInterval(function () {
        slides[current].classList.remove("active");

        current = (current + 1) % slides.length;

        slides[current].classList.add("active");
    }, 3000);
}
//////////////////////////////////////
// ==============================
// Suppliers
// ==============================

let suppliers = [
    {
        name: "Ahmed Ali",
        phone: "01012345678",
        email: "ahmed@eva.com",
        address:"Al-Qawmia District, Zagazig, Sharqia, Egypt"
       
    },
    {
        name: "Sara Mohamed",
        phone: "01198765432",
        email: "sara@eipico.com",
         address:"Al-Mahatta Street, Zagazig, Sharqia, Egypt"
    },
    {
        name: "Omar Hassan",
        phone: "01234567890",
        email: "omar@pharco.com",
         address:"Tolba Ewida Street, Zagazig, Sharqia, Egypt"
    }
];

function renderSuppliers() {

    let table = document.getElementById("suppliersTableBody");

    if (!table) return;

    table.innerHTML = "";

    suppliers.forEach(function(supplier){

        table.innerHTML += `
            <tr>
                <td>${supplier.name}</td>
                <td>${supplier.phone}</td>
                <td>${supplier.email}</td>
                <td>${supplier.address}</td>
            </tr>
        `;
    });
}

function deleteSupplier(id){

    suppliers = suppliers.filter(function(s){
        return s.id !== id;
    });

    renderSuppliers();
}

// function editSupplier(id){
//     alert("Edit Supplier " + id);
// }

// function openAddSupplierModal(){
//     alert("Add Supplier");
// }
