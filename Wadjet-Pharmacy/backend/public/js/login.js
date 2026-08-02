// ============================================================
// login.js - Customer Login Page Logic (Complete & Backend Ready)
// ============================================================

document.addEventListener('DOMContentLoaded', function() {

var form = document.getElementById("loginForm");
var emailInput = document.getElementById("email");
var passwordInput = document.getElementById("password");
var toggleBtn = document.getElementById("togglePassword");

// Password visibility toggle
if (toggleBtn && passwordInput) {
    toggleBtn.onclick = function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleBtn.innerHTML = "&#128584;"; // See-no-evil monkey
        } else {
            passwordInput.type = "password";
            toggleBtn.innerHTML = "&#128065;"; // Eye
        }
    };
}



}); // end DOMContentLoaded