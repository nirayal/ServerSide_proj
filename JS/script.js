function sign_up() {
    var request = new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200)
        {
            console.log(request);
            var response = JSON.parse(this.responseText);
            console.log(response['error']['response']);
            if(Object.keys(response["error"]["response"]).length > 0)
                error = response["error"]["response"];
                if("error_username" in error){
                    document.getElementById("username_error").innerHTML = error["error_username"];
                if("error_fullname" in error)
                    document.getElementById("fullname_error").innerHTML = error["error_fullname"];
                if("error_password" in error)
                    document.getElementById("password_error").innerHTML = error["error_password"];
                if("error_password_reapet" in error)
                    document.getElementById("password-repeat_error").innerHTML = error["error_password_reapet"];
                if("error_email" in error)
                    document.getElementById("email_error").innerHTML = error["error_email"];
                if("error_phone" in error)
                    document.getElementById("phone_error").innerHTML = error["error_phone"];
                if("error_birth_day" in error)
                    document.getElementById("birthday_error").innerHTML = error["error_birth_day"];
                console.log("error");
                }
            else
                document.getElementById("success-response").innerHTML = response['success']['response'];
                window.alert(response['success']['response']);
        }
    }
    request.open("POST","sign_up.php",true);
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    var data = JSON.stringify(
        {
            "user_name":document.getElementById("user_name").value,
            "full_name":document.getElementById("full_name").value,
            "password":document.getElementById("password").value,
            "password-repeat":document.getElementById("password-repeat").value,
            "email":document.getElementById("email").value,
            "phone_num":document.getElementById("phone_num").value,
            "birth_day":document.getElementById("birth_day").value
        })
    request.send(data);
}
