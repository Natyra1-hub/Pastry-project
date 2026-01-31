function validateLogin() {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMsg = document.getElementById("errorMsg");

    errorMsg.textContent = "";

 if (username === "" || password === "") {
        errorMsg.textContent = "Please fill all fields!";
        return false;
    }
    

    if (password.length < 6) {
        errorMsg.textContent = "Password must be at least 6 characters!";
        return false;
    }

    return true;
}