const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

// The following code is used to prevent the form from submitting when the user clicks the submit button.
// This is because we are using AJAX to submit the form.
// AJAX is used to submit the form without reloading the page.
// This is because we want to show the error message without reloading the page.
// If we don't prevent the form from submitting, the page will reload and the error message will not be shown.
form.onsubmit = (e)=>{
    e.preventDefault();
}
// The following code is used to send AJAX request to php/signup.php file.
// The AJAX request is sent when the user clicks the submit button.
// The AJAX request is sent to php/signup.php file with the form data.
// The AJAX request is sent to php/signup.php file using POST method.
// The AJAX request is sent to php/signup.php file asynchronously (true).
// The AJAX request is sent to php/signup.php file when the user clicks the submit button.
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest(); // Creating XML object
    xhr.open("POST", "php/signup.php", true); 
    xhr.onload = ()=>{ 
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){ 
              let data = xhr.response;
              if(data === "success"){
                location.href="users.php";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    // The following code is used to send the form data to php/signup.php file.
    // The form data is sent to php/signup.php file using AJAX request.
    let formData = new FormData(form);
    xhr.send(formData);
}