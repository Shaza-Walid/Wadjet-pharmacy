// ============================================================
// api.js - Backend API Integration Layer
// ============================================================
// All API calls for backend integration.
// Replace API_BASE_URL with your backend URL.
// All functions use XMLHttpRequest (as per Dr style).
// ============================================================

var API_BASE_URL = "http://localhost:8000/api";

// ============================================
// Helper: Create XMLHttpRequest
// ============================================
function createXHR(method, url, callback, errorCallback) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Add auth token if admin is logged in
    var token = localStorage.getItem("wedjedAdminToken");
    if (token) {
        xhr.setRequestHeader("Authorization", "Bearer " + token);
    }

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    callback(response);
                } catch (e) {
                    callback(xhr.responseText);
                }
            } else {
                console.error("API Error:", xhr.status, xhr.statusText);
                if (errorCallback) errorCallback(xhr);
            }
        }
    };

    xhr.onerror = function() {
        console.error("Network Error");
        if (errorCallback) errorCallback(xhr);
    };

    return xhr;
}

// ============================================
// PRODUCTS API
// ============================================

// GET /api/products - Get all products
function apiGetProducts(callback, errorCallback) {
    var xhr = createXHR("GET", API_BASE_URL + "/products", callback, errorCallback);
    xhr.send();
}

// GET /api/products/:id - Get single product
function apiGetProduct(productId, callback, errorCallback) {
    var xhr = createXHR("GET", API_BASE_URL + "/products/" + productId, callback, errorCallback);
    xhr.send();
}

// POST /api/products - Add new product (Admin only)
function apiAddProduct(productData, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/products", callback, errorCallback);
    xhr.send(JSON.stringify(productData));
}

// PUT /api/products/:id - Update product (Admin only)
function apiUpdateProduct(productId, productData, callback, errorCallback) {
    var xhr = createXHR("PUT", API_BASE_URL + "/products/" + productId, callback, errorCallback);
    xhr.send(JSON.stringify(productData));
}

// DELETE /api/products/:id - Delete product (Admin only)
function apiDeleteProduct(productId, callback, errorCallback) {
    var xhr = createXHR("DELETE", API_BASE_URL + "/products/" + productId, callback, errorCallback);
    xhr.send();
}

// ============================================
// CATEGORIES API
// ============================================

// GET /api/categories - Get all categories
function apiGetCategories(callback, errorCallback) {
    var xhr = createXHR("GET", API_BASE_URL + "/categories", callback, errorCallback);
    xhr.send();
}

// ============================================
// ORDERS API
// ============================================

// GET /api/orders - Get all orders (Admin only)
function apiGetOrders(callback, errorCallback) {
    var xhr = createXHR("GET", API_BASE_URL + "/orders", callback, errorCallback);
    xhr.send();
}

// POST /api/orders - Create new order
function apiCreateOrder(orderData, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/orders", callback, errorCallback);
    xhr.send(JSON.stringify(orderData));
}

// PUT /api/orders/:id/status - Update order status (Admin only)
// pending: default 0, admin hits delivered → pending=1
// cancelled: default 0, admin hits rejected → cancelled=1
function apiUpdateOrderStatus(orderId, status, callback, errorCallback) {
    var xhr = createXHR("PUT", API_BASE_URL + "/orders/" + orderId + "/status", callback, errorCallback);
    xhr.send(JSON.stringify({
        status: status,
        pending: status === "delivered" ? 1 : (status === "pending" ? 1 : 0),
        cancelled: status === "cancelled" ? 1 : 0
    }));
}

// ============================================
// AVAILABILITY REQUESTS API
// ============================================

// GET /api/availability-requests - Get all requests (Admin only)
function apiGetAvailabilityRequests(callback, errorCallback) {
    var xhr = createXHR("GET", API_BASE_URL + "/availability-requests", callback, errorCallback);
    xhr.send();
}

// POST /api/availability-requests - Create new request
function apiCreateAvailabilityRequest(requestData, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/availability-requests", callback, errorCallback);
    xhr.send(JSON.stringify(requestData));
}

// PUT /api/availability-requests/:id/status - Update request status (Admin only)
function apiUpdateAvailabilityRequestStatus(requestId, status, callback, errorCallback) {
    var xhr = createXHR("PUT", API_BASE_URL + "/availability-requests/" + requestId + "/status", callback, errorCallback);
    xhr.send(JSON.stringify({
        status: status,
        pending: status === "pending" ? 1 : 0,
        cancelled: status === "cancelled" ? 1 : 0
    }));
}

// ============================================
// CUSTOMERS API
// ============================================

// POST /api/customers/register - Register new customer
function apiRegisterCustomer(customerData, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/customers/register", callback, errorCallback);
    xhr.send(JSON.stringify(customerData));
}

// POST /api/customers/login - Customer login
function apiLoginCustomer(email, password, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/customers/login", callback, errorCallback);
    xhr.send(JSON.stringify({ email: email, password: password }));
}

// ============================================
// ADMINS API
// ============================================

// POST /api/admins/login - Admin login
function apiLoginAdmin(username, password, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/admins/login", callback, errorCallback);
    xhr.send(JSON.stringify({ username: username, password: password }));
}

// GET /api/admins - Get all admins (Admin only)
function apiGetAdmins(callback, errorCallback) {
    var xhr = createXHR("GET", API_BASE_URL + "/admins", callback, errorCallback);
    xhr.send();
}

// POST /api/admins - Add new admin (Admin only)
function apiAddAdmin(adminData, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/admins", callback, errorCallback);
    xhr.send(JSON.stringify(adminData));
}

// DELETE /api/admins/:id - Delete admin (Admin only)
function apiDeleteAdmin(adminId, callback, errorCallback) {
    var xhr = createXHR("DELETE", API_BASE_URL + "/admins/" + adminId, callback, errorCallback);
    xhr.send();
}

// ============================================
// CONTACT API
// ============================================

// POST /api/contact - Send contact message
function apiSendContact(contactData, callback, errorCallback) {
    var xhr = createXHR("POST", API_BASE_URL + "/contact", callback, errorCallback);
    xhr.send(JSON.stringify(contactData));
}

console.log("=== api.js loaded - Backend API Layer Ready ===");
console.log("API Base URL:", API_BASE_URL);
console.log("Using XMLHttpRequest for all API calls");