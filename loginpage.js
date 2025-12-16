function validateLogin() {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMsg = document.getElementById("errorMsg");

 if (username === "" || password === "") {
        errorMsg.textContent = "Ju lutem plotësoni të gjitha fushat!";
        return false;
    }

    if (password.length < 6) {
        errorMsg.textContent = "Password duhet të ketë së paku 6 karaktere!";
        return false;
    }

    return true;
}