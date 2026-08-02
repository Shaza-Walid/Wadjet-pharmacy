// ============================================================
// db.js - Frontend Mock Database (Complete Schema - Backend Ready)
// ============================================================
// Tables: admins, customers, categories, products, orders,
//         order_items, availability_requests
// All fields match backend database schema exactly.
// NOTE: Temporary for frontend dev. Will be replaced by API calls.
// ============================================================

// ============================================
// TABLE: admins
// Fields: id, name, email, password, created_at, updated_at
// ============================================
var adminUsers = [
    {
        id: 1,
        name: "admin",
        email: "admin@wedjed.com",
        password: "admin123",
        created_at: "2026-01-01 00:00:00",
        updated_at: "2026-01-01 00:00:00"
    }
];

// ============================================
// TABLE: customers
// Fields: customer_id, name, phone, address, created_at
// ============================================
var customers = [
    {
        customer_id: 1,
        name: "Ahmed Mohamed",
        email: "ahmed.mohamed@email.com",
        phone: "01012345678",
        address: "Cairo, Nasr City",
        created_at: "2026-07-01 10:00:00"
    },
    {
        customer_id: 2,
        name: "Sara Ali",
        email: "sara.ali@email.com",
        phone: "01098765432",
        address: "Giza, Dokki",
        created_at: "2026-07-05 14:30:00"
    },
    {
        customer_id: 3,
        name: "Mohamed Hassan",
        email: "mohamed.hassan@email.com",
        phone: "01055556666",
        address: "Alexandria, Gleem",
        created_at: "2026-07-10 09:15:00"
    }
];

// ============================================
// TABLE: categories
// Fields: category_id, name, description, created_at, updated_at
// ============================================
var categories = [
    {
        category_id: 1,
        name: "Pain Relief",
        description: "Medicines for pain and fever relief",
        created_at: "2026-01-01 00:00:00",
        updated_at: "2026-01-01 00:00:00"
    },
    {
        category_id: 2,
        name: "Cold & Flu",
        description: "Cold and flu treatments",
        created_at: "2026-01-01 00:00:00",
        updated_at: "2026-01-01 00:00:00"
    },
    {
        category_id: 3,
        name: "Vitamins",
        description: "Vitamins and supplements",
        created_at: "2026-01-01 00:00:00",
        updated_at: "2026-01-01 00:00:00"
    },
    {
        category_id: 4,
        name: "Baby Care",
        description: "Baby care products and milk",
        created_at: "2026-01-01 00:00:00",
        updated_at: "2026-01-01 00:00:00"
    },
    {
        category_id: 5,
        name: "Skin Care",
        description: "Skin care and beauty products",
        created_at: "2026-01-01 00:00:00",
        updated_at: "2026-01-01 00:00:00"
    }
];

// ============================================
// TABLE: products
// Fields: product_id, category_id, name, description, image,
//         price, quantity, status, has_offer, offer_value,
//         created_at, updated_at
// NOTE: status is auto-set based on quantity
// ============================================
var products = [
    {
        product_id: 1,
        category_id: 1,
        name: "Panadol",
        description: "Pain reliever and fever reducer",
        image: "img/panadol.jpg",
        price: 20.00,
        quantity: 50,
        status: "available",
        has_offer: 1,
        offer_value: 5.00,
        created_at: "2026-01-15 10:00:00",
        updated_at: "2026-07-01 12:00:00"
    },
    {
        product_id: 2,
        category_id: 5,
        name: "Vitamin C Serum",
        description: "Brightening serum with vitamin C",
        image: "img/serum.jpg",
        price: 150.00,
        quantity: 0,
        status: "out_of_stock",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-02-01 11:00:00",
        updated_at: "2026-07-10 09:00:00"
    },
    {
        product_id: 3,
        category_id: 3,
        name: "Vitamin D3",
        description: "Bone health supplement",
        image: "img/vitamin-d3.jpg",
        price: 45.00,
        quantity: 30,
        status: "available",
        has_offer: 1,
        offer_value: 10.00,
        created_at: "2026-02-10 14:00:00",
        updated_at: "2026-06-20 16:00:00"
    },
    {
        product_id: 4,
        category_id: 4,
        name: "Baby Shampoo",
        description: "Gentle baby shampoo",
        image: "img/baby-shampoo.jpg",
        price: 35.00,
        quantity: 25,
        status: "available",
        has_offer: 1,
        offer_value: 5.00,
        created_at: "2026-03-01 09:00:00",
        updated_at: "2026-06-15 10:00:00"
    },
    {
        product_id: 5,
        category_id: 5,
        name: "Moisturizing Cream",
        description: "Daily moisturizing cream",
        image: "img/moisturizer.jpg",
        price: 65.00,
        quantity: 40,
        status: "available",
        has_offer: 1,
        offer_value: 15.00,
        created_at: "2026-03-15 13:00:00",
        updated_at: "2026-06-10 11:00:00"
    },
    {
        product_id: 6,
        category_id: 1,
        name: "Antibiotic",
        description: "Broad spectrum antibiotic",
        image: "img/antibiotic.jpg",
        price: 55.00,
        quantity: 0,
        status: "out_of_stock",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-04-01 10:00:00",
        updated_at: "2026-07-05 08:00:00"
    },
    {
        product_id: 7,
        category_id: 4,
        name: "Baby Milk",
        description: "Infant formula milk",
        image: "img/baby-milk.jpg",
        price: 85.00,
        quantity: 20,
        status: "available",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-04-10 15:00:00",
        updated_at: "2026-06-25 14:00:00"
    },
    {
        product_id: 8,
        category_id: 3,
        name: "Omega 3",
        description: "Fish oil supplement",
        image: "img/omega3.jpg",
        price: 120.00,
        quantity: 35,
        status: "available",
        has_offer: 1,
        offer_value: 20.00,
        created_at: "2026-05-01 11:00:00",
        updated_at: "2026-06-18 12:00:00"
    },
    {
        product_id: 9,
        category_id: 1,
        name: "Tooth Pain Reliever",
        description: "Fast tooth pain relief",
        image: "img/pain-relief.jpg",
        price: 18.00,
        quantity: 60,
        status: "available",
        has_offer: 1,
        offer_value: 3.00,
        created_at: "2026-05-10 09:00:00",
        updated_at: "2026-06-22 10:00:00"
    },
    {
        product_id: 10,
        category_id: 5,
        name: "Sunscreen",
        description: "SPF 50 sun protection",
        image: "img/sunscreen.jpg",
        price: 95.00,
        quantity: 0,
        status: "out_of_stock",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-05-20 14:00:00",
        updated_at: "2026-07-08 09:00:00"
    },
    {
        product_id: 11,
        category_id: 4,
        name: "Baby Diapers",
        description: "Soft baby diapers pack",
        image: "img/diapers.jpg",
        price: 55.00,
        quantity: 100,
        status: "available",
        has_offer: 1,
        offer_value: 10.00,
        created_at: "2026-06-01 10:00:00",
        updated_at: "2026-06-28 11:00:00"
    },
    {
        product_id: 12,
        category_id: 3,
        name: "Zinc Supplement",
        description: "Immune support zinc",
        image: "img/zinc.jpg",
        price: 40.00,
        quantity: 45,
        status: "available",
        has_offer: 1,
        offer_value: 8.00,
        created_at: "2026-06-05 13:00:00",
        updated_at: "2026-06-30 15:00:00"
    },
    {
        product_id: 13,
        category_id: 2,
        name: "Congestal",
        description: "Nasal decongestant",
        image: "img/congestal.jpg",
        price: 30.00,
        quantity: 55,
        status: "available",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-06-10 11:00:00",
        updated_at: "2026-07-02 10:00:00"
    },
    {
        product_id: 14,
        category_id: 2,
        name: "Flurest",
        description: "Flu relief capsules",
        image: "img/flurest.jpg",
        price: 25.00,
        quantity: 48,
        status: "available",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-06-15 09:00:00",
        updated_at: "2026-07-03 11:00:00"
    },
    {
        product_id: 15,
        category_id: 2,
        name: "Triminic",
        description: "Cough syrup for kids",
        image: "img/trimenic.jpg",
        price: 40.00,
        quantity: 38,
        status: "available",
        has_offer: 0,
        offer_value: 0.00,
        created_at: "2026-06-20 14:00:00",
        updated_at: "2026-07-04 12:00:00"
    }
];

// ============================================
// TABLE: orders
// Fields: order_id, customer_id, customer_name, phone, address,
//         notes, status, pending, cancelled, created_at
// ============================================
var orders = [
    {
        order_id: 1,
        customer_id: 1,
        customer_name: "Ahmed Mohamed",
        email: "ahmed.mohamed@email.com",
        phone: "01012345678",
        address: "Cairo, Nasr City",
        notes: "Payment: Cash",
        status: "pending",
        pending: 1,
        cancelled: 0,
        created_at: "2026-07-15 10:30:00"
    },
    {
        order_id: 2,
        customer_id: 2,
        customer_name: "Sara Ali",
        email: "sara.ali@email.com",
        phone: "01098765432",
        address: "Giza, Dokki",
        notes: "Payment: Visa",
        status: "delivered",
        pending: 0,
        cancelled: 0,
        created_at: "2026-07-14 16:45:00"
    },
    {
        order_id: 3,
        customer_id: 3,
        customer_name: "Mohamed Hassan",
        email: "mohamed.hassan@email.com",
        phone: "01055556666",
        address: "Alexandria, Gleem",
        notes: "Payment: Cash",
        status: "pending",
        pending: 1,
        cancelled: 0,
        created_at: "2026-07-16 09:20:00"
    }
];

// ============================================
// TABLE: order_items
// Fields: item_id, order_id, product_id, quantity, unit_price, subtotal
// ============================================
var orderItems = [
    { item_id: 1, order_id: 1, product_id: 1, quantity: 1, unit_price: 20.00, subtotal: 20.00 },
    { item_id: 2, order_id: 1, product_id: 3, quantity: 1, unit_price: 45.00, subtotal: 45.00 },
    { item_id: 3, order_id: 2, product_id: 5, quantity: 1, unit_price: 65.00, subtotal: 65.00 },
    { item_id: 4, order_id: 3, product_id: 8, quantity: 1, unit_price: 120.00, subtotal: 120.00 },
    { item_id: 5, order_id: 3, product_id: 12, quantity: 1, unit_price: 40.00, subtotal: 40.00 }
];

// ============================================
// TABLE: availability_requests
// Fields: request_id, product_id, product_name, customer_name,
//         phone, address, notes, status, pending, cancelled, created_at
// ============================================
var availabilityRequests = [
    {
        request_id: 1,
        product_id: 2,
        product_name: "Vitamin C Serum",
        customer_name: "Fatima",
        phone: "01011112222",
        address: "Cairo",
        notes: "Please notify when available",
        status: "pending",
        pending: 1,
        cancelled: 0,
        created_at: "2026-07-10 11:00:00"
    },
    {
        request_id: 2,
        product_id: 6,
        product_name: "Antibiotic",
        customer_name: "Khaled",
        phone: "01033334444",
        address: "Giza",
        notes: "Urgent need",
        status: "pending",
        pending: 1,
        cancelled: 0,
        created_at: "2026-07-12 14:30:00"
    },
    {
        request_id: 3,
        product_id: 10,
        product_name: "Sunscreen",
        customer_name: "Nour",
        phone: "01055557777",
        address: "Alexandria",
        notes: "For summer vacation",
        status: "pending",
        pending: 1,
        cancelled: 0,
        created_at: "2026-07-16 09:00:00"
    }
];

// ============================================
// Categories list for frontend filters
// ============================================
var categoriesList = [
    { name: "All", image: "img/all.jpg" },
    { name: "Pain Relief", image: "img/pain (1).jpg" },
    { name: "Cold & Flu", image: "img/img.jpg" },
    { name: "Vitamins", image: "img/vaitamin.jpg" },
    { name: "Baby Care", image: "img/baby.jpg" },
    { name: "Skin Care", image: "img/skin.jpg" }
];

// ============================================
// API Configuration (Ready for backend)
// ============================================
var API_BASE_URL = "http://localhost:8000/api";

// ============================================
// Helper: Get next ID for a table
// ============================================
function getNextId(array, idField) {
    if (!array || array.length === 0) return 1;
    var maxId = 0;
    for (var i = 0; i < array.length; i++) {
        var currentId = array[i][idField] || 0;
        if (currentId > maxId) maxId = currentId;
    }
    return maxId + 1;
}

// ============================================
// Helper: Format date for DB
// ============================================
function getCurrentDateTime() {
    var now = new Date();
    return now.getFullYear() + "-" +
        String(now.getMonth() + 1).padStart(2, "0") + "-" +
        String(now.getDate()).padStart(2, "0") + " " +
        String(now.getHours()).padStart(2, "0") + ":" +
        String(now.getMinutes()).padStart(2, "0") + ":" +
        String(now.getSeconds()).padStart(2, "0");
}

function getCurrentDate() {
    var now = new Date();
    return now.getFullYear() + "-" +
        String(now.getMonth() + 1).padStart(2, "0") + "-" +
        String(now.getDate()).padStart(2, "0");
}

// ============================================
// Helper: Auto-update product status based on quantity
// ============================================
function updateProductStatus(product) {
    if (product.quantity <= 0) {
        product.status = "out_of_stock";
    } else {
        product.status = "available";
    }
    product.updated_at = getCurrentDateTime();
}

// ============================================
// Console log for debugging
// ============================================
console.log("=== db.js loaded (Complete Schema - Backend Ready) ===");
console.log("Tables: admins, customers, categories, products, orders, order_items, availability_requests");
console.log("Total Products:", products.length);
console.log("Total Categories:", categories.length);
console.log("Total Orders:", orders.length);
console.log("Total Order Items:", orderItems.length);
console.log("Total Stock Requests:", availabilityRequests.length);
console.log("Total Customers:", customers.length);
console.log("Total Admins:", adminUsers.length);
console.log("API Base URL:", API_BASE_URL);
console.log("=== Ready for backend integration ===");