function verifyStuff() {
    let pValue = document.getElementById("password").value;
    let vpValue = document.getElementById("v-password").value;
    if (pValue == vpValue) {
        document.getElementById("confirm-password").innerText =
            "Password Confirmed";
    } else {
        document.getElementById("confirm-password").innerText =
            "Password Does Not Match";
    }
}