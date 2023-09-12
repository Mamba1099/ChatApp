// password show hide functionality
const pswrdField = document.querySelector(".form input[type='password']");
const toggleBtn = document.querySelector(".field.input i.fas.fa-eye");

toggleBtn.addEventListener("click", () => {
    if (pswrdField.type === "password") {
        pswrdField.type = "text";
        toggleBtn.parentElement.classList.add("active");
    } else {
        pswrdField.type = "password";
        toggleBtn.parentElement.classList.remove("active");
    }
});