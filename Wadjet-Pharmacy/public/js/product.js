console.log("product.js loaded");


// Get product id from URL
let params = new URLSearchParams(window.location.search);
let productId = Number(params.get("id"));


// Find product
let product = products.find(p => p.product_id === productId);


if(product){

    // Image
    document.getElementById("detailsImage").src = product.image;
    document.getElementById("detailsImage").alt = product.name;


    // Name
    document.getElementById("detailsName").innerHTML = product.name;


    // Description
    document.getElementById("detailsDescription").innerHTML =
    product.description;


    // Category
    let category = categories.find(
        c => c.category_id === product.category_id
    );

    if(category){
        document.getElementById("detailsCategory").innerHTML =
        category.name;
    }


    // Price
    document.getElementById("detailsPrice").innerHTML =
    product.price + " EGP";


    // Offer
    if(product.has_offer == 1){

        document.getElementById("detailsOldPrice").innerHTML =
        (product.price + product.offer_value) + " EGP";

        document.getElementById("detailsPrice").innerHTML =
        (product.price - product.offer_value) + " EGP";

    }else{

        document.getElementById("detailsOldPrice").style.display="none";

    }



    // Status
    let status = document.getElementById("detailsStatus");


    if(product.status === "available"){

        status.innerHTML = "Available";
        status.className="available";

    }else{

        status.innerHTML = "Out Of Stock";
        status.className="out-stock";

    }



    // Add To Cart Button

    document.getElementById("addCartBtn").onclick = function(){

        if(product.status === "available"){

            addToCart(product.product_id);

        }else{

            alert("Product is out of stock");

        }

    }



    // Show Alternatives
    showAlternatives(product.category_id, product.product_id);


}else{

    document.querySelector(".product-details-container").innerHTML =
    "<h2>Product Not Found</h2>";

}




// Alternatives

function showAlternatives(categoryId,currentId){


    let container =
    document.getElementById("relatedProducts");


    let alternatives = products.filter(product =>

        product.category_id === categoryId &&
        product.product_id !== currentId

    );



    container.innerHTML="";


    alternatives.forEach(item=>{


      container.innerHTML += `
<div class="product-card">

    <img src="${item.image}"
         alt="${item.name}"
         onclick="openProduct(${item.product_id})">

    <h3>${item.name}</h3>

    <p>${item.price} EGP</p>

    <button class="product-btn"
            onclick="addToCart(${item.product_id})">
        Add To Cart
    </button>

</div>
`;
    });


}




// Open product details

function openProduct(id){

    window.location.href =
    "/products?id=" + id;

}