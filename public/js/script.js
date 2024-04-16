let form = document.getElementById("form_input")
let incoming_id = document.getElementById("incoming_id")
let whole_chat = document.querySelector(".chat")
let chat = document.getElementById("chat_box")
let input = document.getElementById("input")
let send_btn = document.getElementById("send_btn")
let all_users = document.querySelector(".all_users")
let outgoing_user_id = ""
let chats_container = document.querySelector(".chats_container")
function getChatMessages() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `../src/get_chat.php?id=${outgoing_user_id}`, true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chat.innerHTML = data;
            if(!chat.classList.contains("active")){

              } else{
                whole_chat.classList.remove("hidden")
                whole_chat.classList.add("flex")
                all_users.classList.remove("flex")
                all_users.classList.add("hidden")
                scrollToBottom();
                chat.classList.remove("active")
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}
setInterval(getChatMessages, 300);
function getAllUsers() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `../src/get_all_users.php`, true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            all_users.innerHTML = data;
            let add_user = document.querySelectorAll(".add_user")
            add_user.forEach(function(add_one_user){
                add_one_user.onsubmit = (event)=>{
                        event.preventDefault();
                        outgoing_user_id = event.target.elements.outgoing_user_id.value
                        incoming_id.value = outgoing_user_id
                        chat.classList.add("active");
                }
            })
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}
setInterval(getAllUsers, 300);
function scrollToBottom(){
    chat.scrollTop = chat.scrollHeight;
  }
form.onsubmit = (e)=>{
    e.preventDefault();
}

send_btn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../src/add_message.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              input.value = "";
              chat.classList.add("active")
          }
      }
    }
    let formData = new FormData(form);;
    xhr.send(formData);
}


function getAllContacts(){  
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../src/get_all_users_contacted.php", true);
    xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
      let data = xhr.response;
      chats_container.innerHTML = data;
      let users_form = document.querySelectorAll(".users_form")
      users_form.forEach(function(user_form){
        user_form.onsubmit = (event)=>{
                event.preventDefault();
                outgoing_user_id = event.target.elements.outgoing_user_id.value
                if(outgoing_user_id == "add_contact"){
                    whole_chat.classList.add("hidden")
                    whole_chat.classList.remove("flex")
                    all_users.classList.add("flex")
                    all_users.classList.remove("hidden")
                } else{
                    chat.classList.add("active");
                }
                incoming_id.value = outgoing_user_id
        }
    })
    }
    }

}
xhr.send();
}
let getcontacts = setInterval(getAllContacts, 300);
let search_form = document.getElementById("search_form");
search_form.addEventListener("input", function(event){
  if(event.target.value != ""){
    clearInterval(getcontacts);
    let all_names = document.querySelectorAll(".full_name");
    all_names.forEach(function(one_name) {
        one_name.classList.add("hidden")
        if (one_name.textContent.toLowerCase().includes(event.target.value.toLowerCase())) {
            one_name.classList.remove("hidden")
    }
});

  } else{
    getcontacts = setInterval(getAllContacts, 300);
  }
})