function validateSignup() {
    const email = document.getElementById("email").value.trim();
    const username = document.getElementById("username").value.trim();
    const dob = document.getElementById("dob").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMsg = document.getElementById("errorMsg");

    errorMsg.textContent = "";

    if (email === "" || username === "" || dob === "" || password === "") {
        errorMsg.textContent = "Ju lutem plotësoni të gjitha fushat!";
        return false;
    }

    
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorMsg.textContent = "Email i pa saktë!";
        return false;
    }

    if (username.length < 3) {
        errorMsg.textContent = "Username duhet të ketë së paku 3 karaktere!";
        return false;
    }
    
    if (password.length < 6) {
        errorMsg.textContent = "Password duhet të ketë së paku 6 karaktere!";
        return false;
    }

    alert("Regjistrimi u krye me sukses!");
    return true;
}