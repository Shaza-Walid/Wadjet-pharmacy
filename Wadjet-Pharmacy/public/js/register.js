// ============================================================
// register.js - Customer Registration Logic (Complete & Backend Ready)
// ============================================================

document.addEventListener('DOMContentLoaded', function() {

// Password toggle
var toggleBtn = document.getElementById("toggleRegPassword");
var passInput = document.getElementById("regPassword");
if (toggleBtn && passInput) {
    toggleBtn.onclick = function() {
        if (passInput.type === "password") {
            passInput.type = "text";
            toggleBtn.innerHTML = "&#128584;";
        } else {
            passInput.type = "password";
            toggleBtn.innerHTML = "&#128065;";
        }
    };
}



}); // end DOMContentLoaded