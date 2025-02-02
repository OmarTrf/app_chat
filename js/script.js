// Password Icons & Password Input
let iconsPassword = document.querySelector('.field_input .eye_password');
if(iconsPassword){
    iconsPassword.addEventListener('click', function(){
        // this.parentNode.querySelector('input').setAttribute('type', this.parentNode.querySelector('input').getAttribute('type') === 'password'? 'text' : 'password');
        if(this.parentNode.querySelector('input').getAttribute('type') === 'password'){
            this.parentNode.querySelector('input').setAttribute('type', 'text');
            this.className = 'fas fa-eye-slash eye_password';
        }else{
            this.parentNode.querySelector('input').setAttribute('type', 'password');
            this.className = 'fas fa-eye eye_password';
        }
    });
}


// ----------- Sing Up Page -------------
let  form_singup = document.querySelector('.singup.form form');
if(form_singup){
    let  button_submit = form_singup.querySelector('button.btn');
    let errorText = form_singup.querySelector('.error_text');
    console.log(errorText);
    
    form_singup.addEventListener('submit', function(e){
        e.preventDefault();
    });
    
    button_submit.addEventListener('click', function(){
        let xhr = new XMLHttpRequest();
        xhr.open('POST','functions/singup.php',true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                let response = JSON.parse(xhr.responseText);
                console.log(response);
                if(response.success){
                    window.location.href = 'user.php';
                }else{ 
                    errorText.style.display = "block";
                    errorText.textContent = response.message;
                }
            }
        }
        let formData = new FormData(form_singup);
        xhr.send(formData);
    });
}

// ----------- Login Page -------------
let form_login = document.querySelector('.login.form form');
if(form_login){
    let button_submit = form_login.querySelector('button.btn');
    let errorText = form_login.querySelector('.error_text');
    
    form_login.addEventListener('submit', function(e){
        e.preventDefault();
    });

    button_submit.addEventListener('click',function(){
        let xhr = new XMLHttpRequest();
        xhr.open('POST','functions/login.php',true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                let response = JSON.parse(xhr.responseText);
                if(response.success){
                    window.location.href = 'user.php'
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = response.message;
                }
            }
        }
        let formData = new FormData(form_login);
        xhr.send(formData);
    });
}

// ----------- User Page -------------
let user_page = document.querySelector('section.users');
if(user_page){
    // Toggle Button & Input Search
    let search_items = user_page.querySelector('.search');
    let text_span = search_items.querySelector('.text');
    let input_field = search_items.querySelector('input');
    let toggle_button = user_page.querySelector('button');
    let user_list = user_page.querySelector('.users_list');
    console.log('hi');

    toggle_button.addEventListener('click', function(){
        input_field.classList.toggle('show');
        text_span.classList.toggle('hide');
        if(input_field.classList.contains('show')){
            toggle_button.querySelector('i').className = 'fas fa-times';
            input_field.focus();
            input_field.value = '';
        }else{
            toggle_button.querySelector('i').className = 'fas fa-search';
        }
    });

    // Search By Value
    input_field.addEventListener('keyup',function(){
        let value = input_field.value;
        if(value != ''){
            let xhr = new XMLHttpRequest();
            xhr.open('POST','functions/search_user.php',true);
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    user_list.innerHTML = xhr.responseText;

                }
            }
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.send('search_value='+value);
        }else{
            user_list.innerHTML = '';
        }
    }); 

}

// ----------- User Chat Page -------------

let user_chat = document.querySelector('.content.user_chat');
if(user_chat){
    let chat_box = user_chat.querySelector('.chat_box');
    let form = user_chat.querySelector('form.typing_area');
    let incoming_id = form.querySelector('input.incoming_id');
    let input_field = form.querySelector('input.input_field');
    let button_send = form.querySelector('button.send');

    form.onsubmit = (e) => {
        e.preventDefault();
    }
    // input_field.focus();
    input_field.onkeyup = () =>{
        if(input_field.value != ""){
            button_send.removeAttribute('disabled');
            button_send.classList.add('active');
        }else{
            button_send.setAttribute('disabled','disabled');
            button_send.classList.remove('active');
        }
    }

    button_send.addEventListener('click',function(){
        let xhr = new XMLHttpRequest();
        xhr.open('POST','functions/send_message.php',true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                input_field.value = '';
                // chat_box.innerHTML = xhr.responseText;
                chat_box.scrollTop = chat_box.scrollHeight;
                get_chat();
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    });
    get_chat();
    function get_chat(){
        // Get Chat 
        let xhr = new XMLHttpRequest();
        xhr.open('POST','functions/get_chat.php?incoming_id='+incoming_id.value,true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                let data = xhr.response;
                chat_box.innerHTML = data;
                chat_box.scrollTop = chat_box.scrollHeight;
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    
}