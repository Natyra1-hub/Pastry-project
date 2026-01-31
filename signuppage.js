function validateSignup() {
    const email = document.getElementById("email").value.trim();
    const username = document.getElementById("username").value.trim();
    const dob = document.getElementById("dob").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMsg = document.getElementById("errorMsg");

    errorMsg.textContent = "";

    if (email === "" || username === "" || dob === "" || password === "") {
        errorMsg.textContent = "Please fill all fields!";
        return false;
    }

    
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorMsg.textContent = "Invalid email format!";
        return false;
    }

    if (username.length < 3) {
        errorMsg.textContent = "Username must be at least 3 characters!";
        return false;
    }
    
    if (password.length < 6) {
        errorMsg.textContent = "Password must be at least 6 characters!";
        return false;
    }

    return true;
}