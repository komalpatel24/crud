const asignInPass = document.getElementById("asignInPass");
const apass = document.getElementById("apassword");
asignInPass.addEventListener("click", () => {
    if (apass.type == "password") {
        apass.type = "text";
    } else {
        apass.type = "password";
    }

});