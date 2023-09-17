const form = document.querySelector(".typing-area"), // Getting form element
incoming_id = form.querySelector(".incoming_id").value, // Getting incoming_id value
inputField = form.querySelector(".input-field"), // Getting input-field element
sendBtn = form.querySelector("button"), // Getting button element
chatBox = document.querySelector(".chat-box"); // Getting chat-box element

form.onsubmit = (e)=>{ // The following code is used to prevent the form from submitting when the user clicks the submit button.
    e.preventDefault(); // This is because we are using AJAX to submit the form.
    // AJAX is used to submit the form without reloading the page.
}

inputField.focus(); // The following code is used to focus the input-field element when the page loads.
inputField.onkeyup = ()=>{ // The following code is used to check if the user is typing something.
    if(inputField.value != ""){
        sendBtn.classList.add("active"); // If the user is typing something, the sendBtn element will have active class.
    }else{
        sendBtn.classList.remove("active"); // If the user is not typing anything, the sendBtn element will not have active class.
    }
}

sendBtn.onclick = ()=>{ // The following code is used to send the message to php/insert-chat.php file.
    let xhr = new XMLHttpRequest(); // Creating XML object
    xhr.open("POST", "php/insert-chat.php", true); // The AJAX request is sent to php/insert-chat.php file with the form data.
    xhr.onload = ()=>{ // The AJAX request is sent to php/insert-chat.php file using POST method.
      if(xhr.readyState === XMLHttpRequest.DONE){ // The AJAX request is sent to php/insert-chat.php file asynchronously (true).
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom(); // The AJAX request is sent to php/insert-chat.php file when the user clicks the submit button.
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{ // The following code is used to show the chat-box element when the user hovers over the chat-box element.
    chatBox.classList.add("active"); // The following code is used to hide the chat-box element when the user hovers out of the chat-box element.
}

chatBox.onmouseleave = ()=>{ // The following code is used to hide the chat-box element when the user hovers out of the chat-box element.
    chatBox.classList.remove("active"); // The following code is used to show the chat-box element when the user hovers over the chat-box element.
}

setInterval(() =>{ // The following code is used to send AJAX request to php/get-chat.php file.
    let xhr = new XMLHttpRequest(); // The AJAX request is sent to php/get-chat.php file every 500ms.
    xhr.open("POST", "php/get-chat.php", true); // The AJAX request is sent to php/get-chat.php file with the form data.
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // The AJAX request is sent to php/get-chat.php file using POST method.
    xhr.send("incoming_id="+incoming_id); // The AJAX request is sent to php/get-chat.php file asynchronously (true).
}, 500);

function scrollToBottom(){ // The following code is used to scroll the chat-box element to the bottom.
    chatBox.scrollTop = chatBox.scrollHeight; 
  }